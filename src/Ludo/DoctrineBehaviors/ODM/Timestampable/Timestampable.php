<?php

/*
 * This file is initially from the KnpDoctrineBehaviors package.
 *
 * (c) KnpLabs <http://knplabs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ludo\DoctrineBehaviors\ODM\Timestampable;

/**
 * Timestampable trait.
 *
 * Should be used inside entity, that needs to be timestamped.
 */
trait Timestampable
{
    /**
     * @var DateTime $createdAt
     *
     * @ODM\Field(type="date", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime $updatedAt
     *
     * @ODM\Field(type="date", nullable=true)
     */
    private $updatedAt;

    /**
     * Returns createdAt value.
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Returns updatedAt value.
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Updates createdAt and updatedAt timestamps.
     */
    public function updateTimestamps()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime('now');
        }

        $this->updatedAt = new \DateTime('now');
    }
}
