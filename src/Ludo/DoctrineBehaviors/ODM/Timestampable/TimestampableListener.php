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

use Doctrine\ODM\MongoDB\Event\LoadClassMetadataEventArgs,
    Doctrine\Common\EventSubscriber,
    Doctrine\ODM\MongoDB\Events,
    Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

/**
 * Timestampable listener.
 *
 * Adds mapping to the timestampable entites.
 */
class TimestampableListener implements EventSubscriber
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();

        if (null === $classMetadata->reflClass) {
            return;
        }

        if ($this->isDocumentSupported($classMetadata)) {
            if ($classMetadata->reflClass->hasMethod('updateTimestamps')) {
                $classMetadata->addLifecycleCallback('updateTimestamps', Events::prePersist);
                $classMetadata->addLifecycleCallback('updateTimestamps', Events::preUpdate);
            }
        }
    }

    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata];
    }

    /**
     * Checks whether provided entity is supported.
     *
     * @param ClassMetadata $classMetadata The metadata
     *
     * @return Boolean
     */
    private function isDocumentSupported(ClassMetadata $classMetadata)
    {
        $traitNames = $classMetadata->reflClass->getTraitNames();

        return in_array('Knp\DoctrineBehaviors\Model\Timestampable\Timestampable', $traitNames);
    }
}
