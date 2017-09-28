<?php
namespace Framework\Core\EventManagerr;

use Psr\EventManager\EventManagerInterface;

/**
 * Interface for EventManager
 */
class EventManagerInterface implements EventManagerInterface
{

	/**
	 * List of all listener
	 *
	 * @var array
	 */
	private $listeners = [];

    /**
     * Attaches a listener to an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @param int $priority the priority at which the $callback executed
     * @return bool true on success false on failure
     */
	public function attach(String $event, $callback,Int $priority = 0): Bool
	{
		$this->listeners[$event][] = [
			'callback' => $callback,
			'priority' => $priority
		];

		return true;
	}

    /**
     * Detaches a listener from an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @return bool true on success false on failure
     */
	public function detach(String $event, $callback): Bool
	{
		$this->listeners[$event] = array_filter($this->listeners[$event], function ($listener) use ($callback){
			return $listener['callback'] !== $callback;
		});

		return true;
	}

    /**
     * Clear all listeners for a given event
     *
     * @param  string $event
     * @return void
     */
	public function clearListeners(String $event)
	{
		$this->listeners[$event] = [];
	}

    /**
     * Trigger an event
     *
     * Can accept an EventInterface or will create one if not passed
     *
     * @param  string|EventInterface $event
     * @param  object|string $target
     * @param  array|object $argv
     * @return mixed
     */
	public function trigger($event, $target = NULL, $argv = array())
	{
		if (is_string($event)) {
			$event = $this->addEvent($event, $target, $argv);
		}

		if (isset($this->listeners[$event->getName()])) {
			$listeners = $this->listeners[$event->getName()];
			usort($listeners, function ($listenerA, $listenerB) {
				return $listenerB['priority'] - $listenerA['priority'];
			});

			foreach ($listeners as ['callback' => $callback]) {
				if ($event->isPropagationStopped()) {
					break;
				}
				call_user_func($callback, $event);
			}
		}
		
	}


	private function addEvent(String $eventName, $target = NULL, Array $argv): EventManagerInterface
	{
		$event = new Event();
		$event->setName($eventName);
		$event->setTarget($target);
		$event->setParams($argv);

		return $event;
	}
}