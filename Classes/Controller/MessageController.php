<?php
namespace Resultify\ResultifyMessageBox\Controller;

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
 * MessageController
 */
class MessageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Resultify\ResultifyMessageBox\Domain\Repository\MessageRepository
     * @inject
     */
    protected $messageRepository;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        // get user
        $user = $GLOBALS['TSFE']->fe_user->user;

        // get storage uid
        $data = $this->configurationManager->getContentObject()->data;
        $storagePids = explode(',',$data['pages']);

        if($user['uid'] != NULL && $data['pages'] != '')
        {
            // get ids of messages already seen by user
            $userData = DatabaseUtility::getUserData($user['uid']);
            $messagesUids = explode(',',$userData);

            // Set sorting
            $this->messageRepository->setInvertSorting(boolval($this->settings['invertSorting']));
            
            // get appropriate messages
            $messages = $this->messageRepository->findByUidRespectStorage($storagePids, $messagesUids);

            $this->view->assign('messages', $messages);
        }

    }

    /**
     * action ajax
     * @return void
     */
    public function ajaxAction()
    {
        // get user
        $user = $GLOBALS['TSFE']->fe_user->user;

        // get uid of message that was clicked
        $messageUid = $this->request->getArgument('uid');

        if($messageUid && $user['uid'] != NULL){
            // get ids of messages already seen by this user
            $userData = DatabaseUtility::getUserData($user['uid']);
            $messagesUids = explode(',',$userData);

            // build correct array of uids to update
            if($userData == ''){
                $messagesUidsToUpdate = $messageUid;
            }else{
                if (!in_array($messageUid, $messagesUids)) {
                    array_push($messagesUids, $messageUid);
                    $messagesUidsToUpdate = implode(",", $messagesUids);
                }else{
                    $messagesUidsToUpdate = implode(",", $messagesUids);
                }    
            }
            
            if(DatabaseUtility::updateUser($user['uid'], $messagesUidsToUpdate)){
                echo json_encode(array("result" => "updateOK"));
            }else{
                echo json_encode(array("result" => "updateError"));
            }
        }else{
            echo json_encode(array("result" => "updateError"));
        }
    }
}
