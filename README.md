# RESULTIFY

This extension adds possibility to add cross-browser/cross-device messages in FE

## Installation

####The following steps are required to active the Rating and Comments for a TYPO3 installation:
1. Install the extension called pxa_message_box
2. Active the extension using "Extensions" module
3. Add the TypoScript called "Message Box" to the site roots where the features should be activated

## Configuration
####To add new messages in BE editor must create sys folder. After that editor can start adding news messages in list view module:
1. Press "Create new record"
2. Choose message type under "Message Box"
3. Pick appropriate Date, Author, Title for message (headline), message itself (text)
4. Press "Save"

####To add new plugn on site:
1. Press "Create new content element" on page you would like to include plugin
2. Choose "General plugins" under Plugins tab
3. After that choose "message" plugin under "Plugin" tab
4. Under "Record storage page" choose sys-folder that was created for storing messages

After that all messages that was created inside folder will apear to each FE user. FE user can press close for each message. In this case he/she will not see this message again, doesn't matter on which browser or device FE user open site again (cross-browser/cross-device). 

## Scheduler
####There is possibility to add scheduler task to clean up redundant data from "fe users" table:
1. Go to scheduler module.
2. Press "Add task"
3. Under class choose ResultifyMessageBox->"Clean Up FE users message boxes"
4. Set Type and Frequency if needed

This task will remove all message ids from "fe user" table that are not present in system.
