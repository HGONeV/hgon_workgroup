<?php
defined('TYPO3') or die("Access denied.");

$tempColumns = [
    "tx_hgon_workgroup" => [
        "exclude" => 1,
        "label" => "LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_sfeventmgt_domain_model_event.tx_hgon_workgroup",
        "config" => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_hgonworkgroup_domain_model_workgroup',
            'foreign_table_where' => 'AND tx_hgonworkgroup_domain_model_workgroup.deleted = 0 AND tx_hgonworkgroup_domain_model_workgroup.hidden = 0 ORDER BY tx_hgonworkgroup_domain_model_workgroup.title ASC',
            'maxitems' => 9999,
            'minitems' => 0,
            'size' => 5,
        ]
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("tx_sfeventmgt_domain_model_event", $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    "tx_sfeventmgt_domain_model_event",
    "tx_hgon_workgroup",
    "",
    "after:tx_hgontemplate_eventculinary"
);
