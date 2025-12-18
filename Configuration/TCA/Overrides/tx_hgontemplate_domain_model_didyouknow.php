<?php
defined('TYPO3') or die("Access denied.");

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$table = 'tx_hgontemplate_domain_model_didyouknow';
$fieldName = 'categories';

$GLOBALS['TCA'][$table]['columns'][$fieldName] = [
    'exclude' => true,
    'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.categories',
    'config' => [
        'type' => 'category',
        'relationship' => 'manyToMany',
        // optional, wenn du die MM-Tabelle fixieren willst:
        // 'MM' => 'tx_hgontemplate_didyouknow_category_mm',
        'treeConfig' => [
            'parentField' => 'parent',
            'appearance' => [
                'showHeader' => true,
                'expandAll' => true,
                'maxLevels' => 99,
            ],
        ],
    ],
];

// Feld im Backend-Formular anzeigen (Tab "Access" ist nur Beispiel – nimm den passenden)
ExtensionManagementUtility::addToAllTCAtypes(
    $table,
    $fieldName,
    '',
    'after:title'
);
