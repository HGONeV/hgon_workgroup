<?php

declare(strict_types=1);

namespace HGON\HgonWorkgroup\EventListener;

use TYPO3\CMS\Backend\View\Event\ModifyDatabaseQueryForRecordListingEvent;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Database\Connection;

#[AsEventListener(
    identifier: 'hgon-workgroup/modify-record-list-query',
    event: ModifyDatabaseQueryForRecordListingEvent::class
)]
final class ModifyRecordListQueryEventListener
{
    public function __invoke(ModifyDatabaseQueryForRecordListingEvent $event): void
    {
        $table = $event->getTable();
        if ($table !== 'tx_hgonworkgroup_domain_model_workgroup' && $table !== 'tx_news_domain_model_news') {
            return;
        }

        $beUser = $this->getBackendUserAuthentication();
        if (!$beUser || $beUser->isAdmin()) {
            return;
        }

        $queryBuilder = $event->getQueryBuilder();
        $expr = $queryBuilder->expr();

        if ($table === 'tx_hgonworkgroup_domain_model_workgroup') {
            $workGroupUids = $this->collectWorkgroupUids($beUser, 'tx_hgonworkgroup_workgroup');
            if ($workGroupUids === null) {
                return;
            }
            if ($workGroupUids === []) {
                $queryBuilder->andWhere('1=0');
                return;
            }
            $queryBuilder->andWhere(
                $expr->in(
                    $queryBuilder->quoteIdentifier('uid'),
                    $queryBuilder->createNamedParameter($workGroupUids, Connection::PARAM_INT_ARRAY)
                )
            );
            return;
        }

        if ($table === 'tx_news_domain_model_news') {
            $locationUids = $this->collectWorkgroupUids($beUser, 'tx_hgonworkgroup_location');
            if ($locationUids === null || $locationUids === []) {
                return;
            }

            $subQueryBuilder = $queryBuilder->getConnection()->createQueryBuilder();
            $subQueryBuilder
                ->select('uid_foreign')
                ->from('tx_hgonworkgroup_domain_model_workgroup_news_mm')
                ->where(
                    $subQueryBuilder->expr()->in(
                        'uid_local',
                        $subQueryBuilder->createNamedParameter($locationUids, Connection::PARAM_INT_ARRAY)
                    )
                );

            $queryBuilder->andWhere(
                $expr->in('uid', $subQueryBuilder->getSQL())
            );
            $queryBuilder->setParameters(
                array_merge($queryBuilder->getParameters(), $subQueryBuilder->getParameters()),
                array_merge($queryBuilder->getParameterTypes(), $subQueryBuilder->getParameterTypes())
            );
        }
    }

    private function collectWorkgroupUids(BackendUserAuthentication $beUser, string $field): ?array
    {
        $uids = [];
        foreach ($beUser->userGroups as $userGroup) {
            if (!empty($userGroup['tx_hgonworkgroup_admingroup'])) {
                return null;
            }
            if (!empty($userGroup[$field])) {
                $uids[] = (int)$userGroup[$field];
            }
        }
        return array_values(array_unique(array_filter($uids)));
    }

    private function getBackendUserAuthentication(): ?BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'] instanceof BackendUserAuthentication
            ? $GLOBALS['BE_USER']
            : null;
    }
}
