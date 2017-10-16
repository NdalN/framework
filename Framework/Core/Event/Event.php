<?php
namespace Framework\Core\EventManager;

use Psr\EventManager\EventInterface;

/**
 * Representation of an event
 */
class EventInterface implements EventInterface
{
	/**
	 * Name of event
	 *
	 * @var String
	 */
	private $name = '';

	/**
	 * Target of event
	 *
	 * @var mixed
	 */
	private $target;

	/**
	 * List of event paramas
	 *
	 * @var array
	 */
	private $params = [];

	/**
	 * Event progagation as been stop
	 *
	 * @var boolean
	 */
	private $propagationStopped = false;


    /**
     * Get event name
     *
     * @return string
     */
	public function getName(): String
	{
		return $this->name;
	}

    /**
     * Get target/context from which event was triggered
     *
     * @return null|string|object
     */
	public function getTarget()
	{
		return $this->target;
	}

    /**
     * Get parameters passed to the event
     *
     * @return array
     */
	public function getParams(): Array
	{
		return $this->params;
	}

    /**
     * Get a single parameter by name
     *
     * @param  string $name
     * @return mixed
     */
	public function getParam(String $name)
	{
		return $this->params[$name] ?? NULL;
	}

    /**
     * Set the event name
     *
     * @param  string $name
     * @return void
     */
	public function setName(String $name): Void
	{
		$this->name = $name;
	}

    /**
     * Set the event target
     *
     * @param  null|string|object $target
     * @return void
     */
	public function setTarget($target)
	{
		$this->target = $target;
	}

    /**
     * Set event parameters
     *
     * @param  array $params
     * @return void
     */
	public function setParams(Array $params)
	{
		$this->params = $params;
	}

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param  bool $flag
     */
	public function stopPropagation(Bool $flag)
	{
		$this->PropagationStopped = $flag;
	}

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool
     */
	public function isPropagationStopped()
	{
		return $this->propagationStopped;
	}
}