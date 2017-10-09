<?php
namespace Resultify\ResultifyMessageBox\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Alex <alex@pixelant.se>
 */
class MessageControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Resultify\ResultifyMessageBox\Controller\MessageController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Resultify\ResultifyMessageBox\Controller\MessageController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllMessagesFromRepositoryAndAssignsThemToView()
    {

        $allMessages = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $messageRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $messageRepository->expects(self::once())->method('findAll')->will(self::returnValue($allMessages));
        $this->inject($this->subject, 'messageRepository', $messageRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('messages', $allMessages);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
