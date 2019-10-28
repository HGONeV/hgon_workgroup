<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tempCols = [
	'tx_hgonworkgroup_workgroup' => [
		'label'=>'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_be_groups_workgroup',
		'exclude' => 0,
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => [
				['', '0']
			],
			'foreign_table' => 'tx_hgonworkgroup_domain_model_workgroup',
			'foreign_table_where' => ' ORDER BY tx_hgonworkgroup_domain_model_workgroup.title',
			'minitems' => 0,
			'maxitems' => 1,
			'appearance' => [
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1
			],
		],
	],
	'tx_hgonworkgroup_admingroup' => [
		'label'=>'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_be_groups_admingroup',
		'exclude' => 0,
		'config' => [
			'type' => 'check',
			'default' => 0,
		],
	],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('be_groups', $tempCols);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_groups', 'tx_hgonworkgroup_workgroup');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_groups', 'tx_hgonworkgroup_admingroup');
