<?php

declare(strict_types=1);

namespace HGON\HgonWorkgroup\Updates;

use Doctrine\DBAL\ParameterType;
use RuntimeException;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\ReferenceIndex;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('hgonWorkgroupEventRelationMigration')]
final class HgonWorkgroupEventRelationMigration implements UpgradeWizardInterface, RepeatableInterface
{
    private const TABLE = 'tx_sfeventmgt_domain_model_event';
    private const TARGET_FIELD = 'tx_hgon_workgroup';
    private const LEGACY_FIELDS = [
        'tx_hgon_workgroup_stdevent',
        'tx_hgon_workgroup_wgevent',
    ];

    public function getTitle(): string
    {
        return 'HGON Workgroup: Event-Arbeitsgruppen zusammenführen';
    }

    public function getDescription(): string
    {
        return 'Führt die bisherigen Zuordnungen für Standard- und Workgroup-Events verlustfrei im neuen Feld '
            . '„Zugeordnete Arbeitsgruppe(n)“ zusammen und leert anschließend die beiden Alt-Felder. '
            . 'Die Kategorie „Arbeitskreistreffen“ bleibt unverändert.';
    }

    public function executeUpdate(): bool
    {
        $columns = $this->getColumnNames();
        if (!isset($columns[self::TARGET_FIELD])) {
            throw new RuntimeException(sprintf(
                'Das Zielfeld %s.%s fehlt trotz ausgeführter Datenbank-Schemamigration.',
                self::TABLE,
                self::TARGET_FIELD
            ));
        }

        $legacyFields = array_values(array_filter(
            self::LEGACY_FIELDS,
            static fn(string $field): bool => isset($columns[$field])
        ));
        if ($legacyFields === []) {
            return true;
        }

        $connection = $this->getConnection();
        $rows = $connection->createQueryBuilder()
            ->select('uid', self::TARGET_FIELD, ...$legacyFields)
            ->from(self::TABLE)
            ->orderBy('uid')
            ->executeQuery()
            ->fetchAllAssociative();

        $changedUids = [];
        $connection->transactional(function (Connection $connection) use ($rows, $legacyFields, &$changedUids): void {
            foreach ($rows as $row) {
                $values = [(string)($row[self::TARGET_FIELD] ?? '')];
                foreach ($legacyFields as $legacyField) {
                    $values[] = (string)($row[$legacyField] ?? '');
                }

                $mergedValue = $this->mergeUidLists(...$values);
                $legacyValuesAreEmpty = true;
                foreach ($legacyFields as $legacyField) {
                    if ($this->mergeUidLists((string)($row[$legacyField] ?? '')) !== '') {
                        $legacyValuesAreEmpty = false;
                        break;
                    }
                }
                if (
                    $legacyValuesAreEmpty
                    && $mergedValue === $this->mergeUidLists((string)($row[self::TARGET_FIELD] ?? ''))
                ) {
                    continue;
                }

                $uid = (int)$row['uid'];
                $updateData = [self::TARGET_FIELD => $mergedValue];
                $types = [self::TARGET_FIELD => ParameterType::STRING, 'uid' => ParameterType::INTEGER];
                foreach ($legacyFields as $legacyField) {
                    $updateData[$legacyField] = '';
                    $types[$legacyField] = ParameterType::STRING;
                }
                $connection->update(
                    self::TABLE,
                    $updateData,
                    ['uid' => $uid],
                    $types
                );
                $changedUids[] = $uid;
            }
        });

        $referenceIndex = GeneralUtility::makeInstance(ReferenceIndex::class);
        foreach ($changedUids as $uid) {
            $referenceIndex->updateRefIndexTable(self::TABLE, $uid);
        }

        return true;
    }

    public function updateNecessary(): bool
    {
        $columns = $this->getColumnNames();
        $legacyFields = array_values(array_filter(
            self::LEGACY_FIELDS,
            static fn(string $field): bool => isset($columns[$field])
        ));
        if ($legacyFields === []) {
            return false;
        }
        if (!isset($columns[self::TARGET_FIELD])) {
            return true;
        }

        $rows = $this->getConnection()->createQueryBuilder()
            ->select(self::TARGET_FIELD, ...$legacyFields)
            ->from(self::TABLE)
            ->executeQuery()
            ->fetchAllAssociative();

        foreach ($rows as $row) {
            $values = [(string)($row[self::TARGET_FIELD] ?? '')];
            foreach ($legacyFields as $legacyField) {
                $values[] = (string)($row[$legacyField] ?? '');
                if ($this->mergeUidLists((string)($row[$legacyField] ?? '')) !== '') {
                    return true;
                }
            }
            if ($this->mergeUidLists(...$values) !== $this->mergeUidLists((string)($row[self::TARGET_FIELD] ?? ''))) {
                return true;
            }
        }

        return false;
    }

    public function getPrerequisites(): array
    {
        return [DatabaseUpdatedPrerequisite::class];
    }

    private function mergeUidLists(string ...$values): string
    {
        $uids = [];
        foreach ($values as $value) {
            foreach (GeneralUtility::intExplode(',', $value, true) as $uid) {
                if ($uid > 0) {
                    $uids[$uid] = $uid;
                }
            }
        }

        return implode(',', array_values($uids));
    }

    /**
     * @return array<string, true>
     */
    private function getColumnNames(): array
    {
        $connection = $this->getConnection();
        $schemaManager = $connection->createSchemaManager();
        if (!$schemaManager->tablesExist([self::TABLE])) {
            return [];
        }

        $columns = [];
        foreach ($schemaManager->listTableColumns(self::TABLE) as $column) {
            $columns[$column->getName()] = true;
        }

        return $columns;
    }

    private function getConnection(): Connection
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable(self::TABLE);
    }
}
