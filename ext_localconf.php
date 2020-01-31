<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Resultify.ResultifyMessageBox',
    'Message',
    [
        'Message' => 'list, close'
    ],
    // non-cacheable actions
    [
        'Message' => 'list, close'
    ]
);
