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
        $data = $this->configurationManager->getContentObject()->data;
        $storagePids = explode(',',$data['pages']);

        $messages = $this->messageRepository->findAllRespectStorage($storagePids);

        $this->view->assign('messages', $messages);
    }
}
