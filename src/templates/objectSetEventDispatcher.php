
/**
 * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface
 */
static public function setEventDispatcher(\Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher)
{
    self::$dispatcher = $eventDispatcher;
}
