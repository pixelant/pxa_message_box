plugin.tx_resultifymessagebox_message {
    view {
        templateRootPaths {
            10 = {$plugin.tx_resultifymessagebox_message.view.templateRootPath}
        }

        partialRootPaths {
            10 = {$plugin.tx_resultifymessagebox_message.view.partialRootPath}
        }

        layoutRootPaths {
            10 = {$plugin.tx_resultifymessagebox_message.view.layoutRootPath}
        }
    }

    persistence {
        storagePid = {$plugin.tx_resultifymessagebox_message.persistence.storagePid}
    }

    settings {
        # Set invert sorting for messages
        invertSorting = {$plugin.tx_resultifymessagebox_message.settings.invertSorting}
    }
}

PxaMessageBoxAjaxCall = PAGE
PxaMessageBoxAjaxCall {
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

        switchableControllerActions {
            Message {
                1 = close
            }
        }
    }
}

page {
    includeCSS.messageBoxCss = EXT:resultify_message_box/Resources/Public/Css/messageBox.css
    includeJSFooter.messageBoxJs = EXT:resultify_message_box/Resources/Public/Js/messageBox.js
}
