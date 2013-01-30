<?php

/**
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class EventDispatcherQueryBuilderModifier extends EventDispatcherObjectBuilderModifier
{
    private $behavior;

    public function __construct(Behavior $behavior)
    {
        $this->behavior = $behavior;
    }

    public function queryAttributes($builder)
    {
        $events = array();
        foreach (array(
            'pre_select_query',
            'pre_update_query',
            'post_update_query',
            'pre_delete_query',
            'post_delete_query',
        ) as $eventName) {
            $constant = strtoupper('EVENT_' . $eventName);
            $events[$constant] = $this->getEventName($eventName);
        }

        return $this->behavior->renderTemplate('objectAttributes', array(
            'events' => $events,
        ));
    }

    public function queryMethods($builder)
    {
        // declare this class for hooks
        $builder->declareClass('EventDispatcherAwareModelInterface');

        $script = '';
        $script .= $this->addGetEventDispatcher($builder);
        $script .= $this->addSetEventDispatcher($builder);

        return $script;
    }

    public function addGetEventDispatcher($builder)
    {
        $builder->declareClass('Symfony\Component\EventDispatcher\EventDispatcher');

        return $this->behavior->renderTemplate('objectGetEventDispatcher');
    }

    public function addSetEventDispatcher($builder)
    {
        $builder->declareClass('Symfony\Component\EventDispatcher\EventDispatcherInterface');

        return $this->behavior->renderTemplate('objectSetEventDispatcher');
    }

    public function preUpdateQuery()
    {
        return $this->behavior->renderTemplate('objectHook', array(
            'eventName' => $this->getEventName('pre_update_query'),
        ));
    }

    public function postUpdateQuery()
    {
        return $this->behavior->renderTemplate('objectHook', array(
            'eventName' => $this->getEventName('post_update_query'),
        ));
    }

    public function preInsert()
    {
        return $this->behavior->renderTemplate('objectHook', array(
            'eventName' => $this->getEventName('pre_insert_query'),
        ));
    }

    public function preSelectQuery()
    {
        return $this->behavior->renderTemplate('objectHook', array(
            'eventName' => $this->getEventName('pre_select_query'),
        ));
    }

    public function preDeleteQuery()
    {
        return $this->behavior->renderTemplate('objectHook', array(
            'eventName' => $this->getEventName('pre_delete_query'),
        ));
    }

    public function postDeleteQuery()
    {
        return $this->behavior->renderTemplate('objectHook', array(
            'eventName' => $this->getEventName('post_delete_query'),
        ));
    }

    public function objectFilter(&$script)
    {
        $script = preg_replace('#(extends ModelCriteria)#', '$1 implements EventDispatcherAwareModelInterface', $script);
    }

    protected function getEventName($eventName)
    {
        return 'propel.' . $eventName ;
    }
}
