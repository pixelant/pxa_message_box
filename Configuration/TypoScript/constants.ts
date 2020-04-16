plugin.tx_pxamessagebox_message {
    view {
        # cat=plugin.tx_pxamessagebox_message/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:pxa_message_box/Resources/Private/Templates/
        # cat=plugin.tx_pxamessagebox_message/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:pxa_message_box/Resources/Private/Partials/
        # cat=plugin.tx_pxamessagebox_message/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:pxa_message_box/Resources/Private/Layouts/
    }

    persistence {
        # cat=plugin.tx_pxamessagebox_message//a; type=string; label=Default storage PID
        storagePid =
    }

    settings {
        # cat=plugin.tx_pxamessagebox_message//b; type=boolean; label=Invert sorting
        invertSorting = 0
    }
}
