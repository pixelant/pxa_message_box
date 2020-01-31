<?php

namespace Resultify\ResultifyMessageBox\Controller;

use Resultify\ResultifyMessageBox\Domain\Model\Message;
use Resultify\ResultifyMessageBox\Domain\Repository\MessageRepository;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * MessageController
 */
class MessageController extends ActionController
{
    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * @var FrontendUserRepository
     */
    protected $frontendUserRepository = null;

    /**
     * Loggen in user ID
     *
     * @var int
     */
    protected $userId = null;

    /**
     * @param MessageRepository $messageRepository
     */
    public function injectMessageRepository(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param FrontendUserRepository $frontendUserRepository
     */
    public function injectFrontendUserRepository(FrontendUserRepository $frontendUserRepository)
    {
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * Init
     */
    protected function initializeAction()
    {
        $userAspect = GeneralUtility::makeInstance(Context::class)->getAspect('frontend.user');
        if ($userAspect->isLoggedIn()) {
            $this->userId = $userAspect->get('id');
        }
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        if (!$this->userId) {
            return;
        }

        // Get appropriate messages
        $messages = $this->messageRepository->findByNotSeen($this->userId);
        if ($this->settings['invertSorting']) {
            $messages = array_reverse($messages->toArray());
        }

        $this->view->assign('messages', $messages);
    }

    /**
     * Close action
     *
     * @param Message $message
     * @return void
     */
    public function closeAction(Message $message)
    {
        if (!$this->userId) {
            return;
        }

        /** @var FrontendUser $frontendUser */
        $frontendUser = $this->frontendUserRepository->findByUid($this->userId);

        $message->addSeenBy($frontendUser);
        $this->messageRepository->update($message);

        if (GeneralUtility::_GET('type')) {
            return json_encode(['success' => true]);
        }

        $this->redirect('list');
    }
}
