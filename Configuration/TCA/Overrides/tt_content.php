<?php
defined('TYPO3') or die("Access denied.");

call_user_func(
    function (string $extKey) {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'List',
            'HGON Arbeitsgruppe: Liste'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Detail',
            'HGON Arbeitsgruppe: Detail'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Header',
            'HGON Arbeitsgruppe: Header'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Sidebar',
            'HGON Arbeitsgruppe: Sidebar'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extKey,
            'Search',
            'HGON Arbeitsgruppe: Suche'
        );


        //=================================================================
        // Add Flexform (CType)
        //=================================================================
        $extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($extKey));
        $pluginName = strtolower('Search');
        $pluginSignature = $extensionName.'_'.$pluginName;
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:EXT:'.$extKey . '/Configuration/FlexForms/Search.xml',
            $pluginSignature
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            'pi_flexform',
            $pluginSignature,
            'after:header'
        );



    },
    'hgon_workgroup'
);
