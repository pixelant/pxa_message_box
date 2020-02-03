<?php

namespace Pixelant\PxaMessageBox\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Message
 */
class Message extends AbstractEntity
{
    /**
     * date
     *
     * @var \DateTime
     */
    protected $date = null;

    /**
     * author
     *
     * @var string
     */
    protected $author = '';

    /**
     * headline
     *
     * @var string
     */
    protected $headline = '';

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $seenBy = null;

    /**
     */
    public function __construct()
    {
        $this->seenBy = new ObjectStorage();
    }


    /**
     * Returns the date
     *
     * @return \DateTime $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Returns the author
     *
     * @return string $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets the author
     *
     * @param string $author
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Returns the headline
     *
     * @return string $headline
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Sets the headline
     *
     * @param string $headline
     * @return void
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return ObjectStorage
     */
    public function getSeenBy(): ObjectStorage
    {
        return $this->seenBy;
    }

    /**
     * @param ObjectStorage $seenBy
     */
    public function setSeenBy(ObjectStorage $seenBy): void
    {
        $this->seenBy = $seenBy;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser
     */
    public function addSeenBy(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser)
    {
        $this->seenBy->attach($frontendUser);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser
     */
    public function removeSeenBy(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser)
    {
        $this->seenBy->detach($frontendUser);
    }
}
