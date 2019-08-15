<?php
defined('TYPO3_MODE') || die('Access denied.');
// extend tx_news
$tempColumns = [
    "tx_hgon_workgroup" => [
        "exclude" => 1,
        "label" => "LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_news.tx_hgon_workgroup",
        "config" => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_hgonworkgroup_domain_model_workgroup',
            //'foreign_table_where' => 'AND tx_hgonworkgroup_domain_model_workgroup.pid!=###CURRENT_PID###',
            'MM' => 'tx_hgonworkgroup_domain_model_workgroup_news_mm',
            'MM_opposite_field' => 'tx_hgon_workgroup',
            'maxitems' => 9999,
            'minitems' => 0,
            'multiple' => 1,
        ]
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    "tx_news_domain_model_news",
    $tempColumns,
    1
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    "tx_news_domain_model_news",
    "tx_hgon_workgroup",
    '',
    'after:related_links'
);