<?php
namespace Resultify\ResultifyMessageBox\Domain\Model;

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
 * Message
 */
class Message extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * date
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $date = null;

    /**
     * author
     *
     * @var string
     * @validate NotEmpty
     */
    protected $author = '';

    /**
     * headline
     *
     * @var string
     * @validate NotEmpty
     */
    protected $headline = '';

    /**
     * text
     *
     * @var string
     * @validate NotEmpty
     */
    protected $text = '';

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
}
