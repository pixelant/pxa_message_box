<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Pixelant.PxaMessageBox',
    'Message',
    'Message box',
    'EXT:pxa_message_box/Resources/Public/Icons/message.svg'
);
