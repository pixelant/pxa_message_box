<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Resultify.ResultifyMessageBox',
            'Message',
            [
                'Message' => 'list, ajax'
            ],
            // non-cacheable actions
            [
                'Message' => 'list, ajax'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    message {
                        iconIdentifier = resultify_message_box-plugin-message
                        title = LLL:EXT:resultify_message_box/Resources/Private/Language/locallang_db.xlf:tx_resultify_message_box_message.name
                        description = LLL:EXT:resultify_message_box/Resources/Private/Language/locallang_db.xlf:tx_resultify_message_box_message.description
                        tt_content_defValues {
                            CType = list
                            list_type = resultifymessagebox_message
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'resultify_message_box-plugin-message',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:resultify_message_box/Resources/Public/Icons/user_plugin_message.svg']
			);
		
    }
);
