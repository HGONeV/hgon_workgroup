<?php
defined('TYPO3_MODE') || die('Access denied.');

//=================================================================
// Add TypoScript
//=================================================================
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'hgon_workgroup',
    'Configuration/TypoScript',
    'HGON WorkGroup'
);
