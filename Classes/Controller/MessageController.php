<?php

namespace Pixelant\PxaMessageBox\Controller;

use Pixelant\PxaMessageBox\Domain\Model\Message;
use Pixelant\PxaMessageBox\Domain\Repository\MessageRepository;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

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
     * @var PersistenceManager
     */
    protected $persistenceManager = null;

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
     * @param PersistenceManager $persistenceManager
     */
    public function injectPersistenceManager(PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
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
        /** @var FrontendUser $frontendUser */
        $frontendUser = $this->frontendUserRepository->findByUid($this->userId);
        $seen = [];
        foreach ($messages as $message) {
            /** @var Message $message */
            $seen[$message->getUid()] = ($message->getSeenBy()->contains($frontendUser)) ? true : false;
        }

        $this->view->assign('seen', $seen);
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

        if ($message->getSeenBy()->contains($frontendUser)) {
            $message->removeSeenBy($frontendUser);
        } else {
            $message->addSeenBy($frontendUser);
        }
        $this->messageRepository->update($message);

        $this->persistenceManager->persistAll();

        if (GeneralUtility::_GET('type')) {
            return json_encode(['success' => true]);
        }

        $this->redirect('list');
    }
}
