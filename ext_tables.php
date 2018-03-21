<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Resultify.ResultifyMessageBox',
            'Message',
            'Message',
            'EXT:resultify_message_box/Resources/Public/Icons/user_plugin_message.svg'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('resultify_message_box', 'Configuration/TypoScript', 'Message Box');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_resultifymessagebox_domain_model_message', 'EXT:resultify_message_box/Resources/Private/Language/locallang_csh_tx_resultifymessagebox_domain_model_message.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_resultifymessagebox_domain_model_message');

        // extend fe_user
        // \TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('fe_users');
        // $TCA['tx_test_domain_model_address']['ctrl']['type'] = 'tx_extbase_type';
        $tmp_fe_users_columns = array(
                'seen_messages_ids' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:resultify_message_box/Resources/Private/Language/locallang_db.xlf:tx_resultify_message_box_message.seen_messages_ids',
                        'config' => [
                            'type' => 'input',
                            'size' => 30,
                            'eval' => 'trim'
                        ],
                )
        );


        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_fe_users_columns, 1);
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'seen_messages_ids');

    }
);
