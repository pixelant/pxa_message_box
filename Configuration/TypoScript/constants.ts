
plugin.tx_resultifymessagebox_message {
    view {
        # cat=plugin.tx_resultifymessagebox_message/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:resultify_message_box/Resources/Private/Templates/
        # cat=plugin.tx_resultifymessagebox_message/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:resultify_message_box/Resources/Private/Partials/
        # cat=plugin.tx_resultifymessagebox_message/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:resultify_message_box/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_resultifymessagebox_message//a; type=string; label=Default storage PID
        storagePid =
    }
}
