<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'HGON.HgonWorkgroup',
            'List',
            'HGON Arbeitsgruppe: Liste / Detail'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'HGON.HgonWorkgroup',
            'Search',
            'HGON Arbeitsgruppe: Suche'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('hgon_workgroup', 'Configuration/TypoScript', 'HGON WorkGroup');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hgonworkgroup_domain_model_workgroup', 'EXT:hgon_workgroup/Resources/Private/Language/locallang_csh_tx_hgonworkgroup_domain_model_workgroup.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hgonworkgroup_domain_model_workgroup');

        // Add an extra categories selection field to the pages table
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
            'examples',
            'tx_hgontemplate_domain_model_didyouknow',
            // Do not use the default field name ("categories") for pages, tt_content, sys_file_metadata, which is already used
            'sys_category',
            array(
                // Set a custom label
                'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:additional_categories',
                // This field should not be an exclude-field
                'exclude' => FALSE,
                // Override generic configuration, e.g. sort by title rather than by sorting
                'fieldConfiguration' => array(
                    'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
                ),
                // string (keyword), see TCA reference for details
                'l10n_mode' => 'exclude',
                // list of keywords, see TCA reference for details
                'l10n_display' => 'hideDiff',
            )
        );

    }
);

//=================================================================
// Add Flexform
//=================================================================
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));

$pluginName = strtolower('Search');
$pluginSignature = $extensionName.'_'.$pluginName;
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/Search.xml');

