<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:pxa_message_box/Resources/Private/Language/locallang_db.xlf:tx_pxamessagebox_domain_model_message',
        'label' => 'headline',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'date,author,headline,text',
        'iconfile' => 'EXT:pxa_message_box/Resources/Public/Icons/message.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, date, author, headline, text, seen_by',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, date, author, headline, text,
         --div--;LLL:EXT:pxa_message_box/Resources/Private/Language/locallang_db.xlf:tx_pxamessagebox_domain_model_message.seen_by, seen_by,
         --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_pxamessagebox_domain_model_message',
                'foreign_table_where' => 'AND tx_pxamessagebox_domain_model_message.pid=###CURRENT_PID### AND tx_pxamessagebox_domain_model_message.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pxa_message_box/Resources/Private/Language/locallang_db.xlf:tx_pxamessagebox_domain_model_message.date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'date,required',
                'default' => time()
            ],
        ],
        'author' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pxa_message_box/Resources/Private/Language/locallang_db.xlf:tx_pxamessagebox_domain_model_message.author',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'headline' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pxa_message_box/Resources/Private/Language/locallang_db.xlf:tx_pxamessagebox_domain_model_message.headline',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pxa_message_box/Resources/Private/Language/locallang_db.xlf:tx_pxamessagebox_domain_model_message.text',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ]
        ],
        'seen_by' => [
            'exclide' => true,
            'label' => 'LLL:EXT:pxa_message_box/Resources/Private/Language/locallang_db.xlf:tx_pxamessagebox_domain_model_message.seen_by',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'MM' => 'tx_resultifymessagebox_message_feuser_mm',
            ]
        ],
    ],
];
