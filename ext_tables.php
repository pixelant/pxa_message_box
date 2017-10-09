<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Resultify.ResultifyMessageBox',
            'Message',
            'Message'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('resultify_message_box', 'Configuration/TypoScript', 'Message Box');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_resultifymessagebox_domain_model_message', 'EXT:resultify_message_box/Resources/Private/Language/locallang_csh_tx_resultifymessagebox_domain_model_message.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_resultifymessagebox_domain_model_message');

    }
);
