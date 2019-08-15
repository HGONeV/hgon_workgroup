<?php
defined('TYPO3_MODE') || die('Access denied.');
// extend tx_news
$tempColumns = [
    "tx_hgon_workgroup_wgevent" => [
        "exclude" => 1,
        "label" => "LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_rkwevents_domain_model_event.tx_hgon_workgroup_wgevent",
        "config" => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_hgonworkgroup_domain_model_workgroup',
            'foreign_table_where' => 'AND tx_hgonworkgroup_domain_model_workgroup.deleted = 0 AND tx_hgonworkgroup_domain_model_workgroup.hidden = 0 ORDER BY tx_hgonworkgroup_domain_model_workgroup.title ASC',
            'maxitems'      => 9999,
            'minitems' 		=> 0,
            'size'          => 5,
        ]
    ],
    "tx_hgon_workgroup_stdevent" => [
        "exclude" => 1,
        "label" => "LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_rkwevents_domain_model_event.tx_hgon_workgroup_stdevent",
        "config" => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_hgonworkgroup_domain_model_workgroup',
            'foreign_table_where' => 'AND tx_hgonworkgroup_domain_model_workgroup.deleted = 0 AND tx_hgonworkgroup_domain_model_workgroup.hidden = 0 ORDER BY tx_hgonworkgroup_domain_model_workgroup.title ASC',
            'maxitems'      => 9999,
            'minitems' 		=> 0,
            'size'          => 5,
        ]
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("tx_rkwevents_domain_model_event", $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("tx_rkwevents_domain_model_event","tx_hgon_workgroup_wgevent,tx_hgon_workgroup_stdevent;;;;1-1-1");
