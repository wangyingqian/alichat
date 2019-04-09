<?php
namespace Wangyingqian\AliChat\Kernel;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author wangyingqian
 *
 * @method static Event dispatch($eventName, Event $event = null) Dispatches an event to all registered listeners
 * @method static array getListeners($eventName = null) Gets the listeners of a specific event or all listeners sorted by descending priority.
 * @method static int|null getListenerPriority($eventName, $listener) Gets the listener priority for a specific event.
 * @method static bool hasListeners($eventName = null) Checks whether an event has any registered listeners.
 * @method static addListener($eventName, $listener, $priority = 0) Adds an event listener that listens on the specified events.
 * @method static removeListener($eventName, $listener) Removes an event listener from the specified events.
 * @method static addSubscriber(EventSubscriberInterface $subscriber) Adds an event subscriber.
 * @method static removeSubscriber(EventSubscriberInterface $subscriber)
 */
class Events
{
    /**
     * dispatcher.
     *
     * @var EventDispatcher
     */
    protected static $dispatcher;

    /**
     * Forward call.
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return call_user_func_array([self::getDispatcher(), $method], $args);
    }

    /**
     * Forward call
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([self::getDispatcher(), $method], $args);
    }

    /**
     * setDispatcher
     *
     * @param EventDispatcher $dispatcher
     */
    public static function setDispatcher(EventDispatcher $dispatcher)
    {
        self::$dispatcher = $dispatcher;
    }

    /**
     * getDispatcher
     *
     * @return EventDispatcher
     */
    public static function getDispatcher()
    {
        if (self::$dispatcher) {
            return self::$dispatcher;
        }

        return self::$dispatcher = self::createDispatcher();
    }

    /**
     * createDispatcher
     *
     * @return EventDispatcher
     */
    public static function createDispatcher()
    {
        return new EventDispatcher();
    }

}
