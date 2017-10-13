<?php
namespace Resultify\ResultifyMessageBox\Task;

/***
 *
 * This file is part of the "Message Box" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Alex <alex@pixelant.se>, Resultify
 *
 ***/

use Resultify\ResultifyMessageBox\Utility\DatabaseUtility;

/**
 * CleanUpFeUserMessagesTask
 */
class CleanUpFeUserMessagesTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
     * execute scheduler task
     * @return bool
     */
    public function execute() {
    	if(DatabaseUtility::cleanUpFeUsers()){
    		return true;	
    	}else{
    		return false;
    	}
    }
}