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

/**
 * MessageController
 */
class MessageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $messages = $this->messageRepository->findAll();
        $this->view->assign('messages', $messages);
    }
}
