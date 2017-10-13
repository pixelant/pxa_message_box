
plugin.tx_resultifymessagebox_message {
    view {
        templateRootPaths.0 = EXT:resultify_message_box/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_resultifymessagebox_message.view.templateRootPath}
        partialRootPaths.0 = EXT:resultify_message_box/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_resultifymessagebox_message.view.partialRootPath}
        layoutRootPaths.0 = EXT:resultify_message_box/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_resultifymessagebox_message.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_resultifymessagebox_message.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

ajaxCall = PAGE
ajaxCall {
    typeNum = 2378954
    config {
        disableAllHeaderCode = 1
        xhtml_cleaning = 0
        admPanel = 0
        additionalHeaders = Content-type:application/json
        no_cache = 1
        debug = 0
    }
    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        extensionName = ResultifyMessageBox
        pluginName = Message
        vendorName = Resultify
        controller = MessageController
        action = ajax
        view < plugin.tx_resultifymessagebox_message.view
        persistence < plugin.tx_resultifymessagebox_message.persistence
        settings < plugin.tx_resultifymessagebox_message.settings
    }
}

page.includeCSS {
    messageBoxCss = EXT:resultify_message_box/Resources/Public/Css/messageBox.css
}

page.includeJSFooter {
    messageBoxJs = EXT:resultify_message_box/Resources/Public/Js/messageBox.js
}

# these classes are only used in auto-generated templates
plugin.tx_resultifymessagebox._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-resultify-message-box table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-resultify-message-box table th {
        font-weight:bold;
    }

    .tx-resultify-message-box table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)
