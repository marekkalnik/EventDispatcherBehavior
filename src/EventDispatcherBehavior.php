<?php

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class EventDispatcherBehavior extends Behavior
{
    /**
     * @var EventDispatcherObjectBuilderModifier
     */
    private $objectBuilderModifier;

    /**
     * @var EventDispatcherQueryBuilderModifier
     */
    private $queryBuilderModifier;

    /**
     * {@inheritdoc}
     */
    public function getObjectBuilderModifier()
    {
        if (null === $this->objectBuilderModifier) {
            $this->objectBuilderModifier = new EventDispatcherObjectBuilderModifier($this);
        }

        return $this->objectBuilderModifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryBuilderModifier()
    {
        if (null === $this->queryBuilderModifier) {
            $this->queryBuilderModifier = new EventDispatcherQueryBuilderModifier($this);
        }

        return $this->queryBuilderModifier;
    }
}
