
/**
 * @return \Symfony\Component\EventDispatcher\EventDispatcher
 */
static public function getEventDispatcher()
{
    if (null === self::$dispatcher) {
        self::setEventDispatcher(new \Symfony\Component\EventDispatcher\EventDispatcher());
    }

    return self::$dispatcher;
}
