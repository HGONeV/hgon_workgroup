<?php
defined('TYPO3') or die("Access denied.");

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hgonworkgroup_domain_model_workgroup', 'EXT:hgon_workgroup/Resources/Private/Language/locallang_csh_tx_hgonworkgroup_domain_model_workgroup.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hgonworkgroup_domain_model_workgroup');

    },
    'hgon_workgroup'
);

