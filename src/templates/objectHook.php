self::getEventDispatcher()->dispatch('<?php echo $eventName ?>', new \Symfony\Component\EventDispatcher\GenericEvent($this));
