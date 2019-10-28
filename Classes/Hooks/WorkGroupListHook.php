<?php
declare(strict_types=1);
namespace HGON\HgonWorkgroup\Hooks;

use TYPO3\CMS\Backend\RecordList\RecordListGetTableHookInterface;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Modify the TYPO3 List view so that workgroup users can only see their own workgroups
 */
class WorkGroupListHook implements RecordListGetTableHookInterface
{
	/**
	 * modifies the DB list query
	 *
	 * @param string $table The current database table
	 * @param int $pageId The record's page ID
	 * @param string $additionalWhereClause An additional WHERE clause
	 * @param string $selectedFieldsList Comma separated list of selected fields
	 * @param \TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList $parentObject Parent \TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList object
	 */
	public function getDBlistQuery($table, $pageId, &$additionalWhereClause, &$selectedFieldsList, &$parentObject)
	{
		// tx_hgonworkgroup_domain_model_workgroup
		if ($table == 'tx_hgonworkgroup_domain_model_workgroup') {
			if ($this->getBackendUserAuthentication()->isAdmin()) {
				return;
				//===
			}
			$workGroupUids = [];
			foreach ($this->getBackendUserAuthentication()->userGroups as $userGroup) {
				// this feature does not exists in the new easylife relaunch
				//if ((bool)$userGroup['tx_easylifepackage_access_all_locations'] === true) {
				//    return;
				//}
                
				if ((int)$userGroup['tx_hgonworkgroup_admingroup'] > 0) {
					$workGroupUids = [];

					return;
				}

				if ((int)$userGroup['tx_hgonworkgroup_workgroup'] > 0) {
					$workGroupUids[] = (int)$userGroup['tx_hgonworkgroup_workgroup'];
				}
			}

			if (\count($workGroupUids)) {
				// Hint: Normally we would add this string to the query (and not replace). But is does not work this way
				$additionalWhereClause = ' AND uid IN (' . implode(',', $workGroupUids) . ')';
			} else {
				$additionalWhereClause .= ' AND uid = 0';
			}
		}



		// tx_news_domain_model_news
		if ($table == 'tx_news_domain_model_news') {
			if ($this->getBackendUserAuthentication()->isAdmin()) {
				return;
				//===
			}
			$workGroupUids = [];
			foreach ($this->getBackendUserAuthentication()->userGroups as $userGroup) {
				if ((int)$userGroup['tx_hgonworkgroup_admingroup'] > 0) {
					$workGroupUids = [];

					return;
				}

				if ((int)$userGroup['tx_hgonworkgroup_location'] > 0) {
					$workGroupUids[] = (int)$userGroup['tx_hgonworkgroup_location'];
				}
			}

			if (\count($workGroupUids)) {
				// Hint: Normally we would add this string to the query (and not replace). But is does not work this way
				$additionalWhereClause = ' AND uid IN(SELECT uid_foreign FROM tx_hgonworkgroup_domain_model_workgroup_news_mm WHERE uid_local IN (' . implode(',', $workGroupUids) . '))';
			} else {
				//$additionalWhereClause .= ' AND location = 0';
			}
		}


	}

	protected function getBackendUserAuthentication(): BackendUserAuthentication
	{
		return $GLOBALS['BE_USER'];
	}
}
