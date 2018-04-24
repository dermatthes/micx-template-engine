<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 12:30 AM
 */

namespace Micx\Core\Helper;


trait EventEmitterTrait
{

    private $eventListeners = [];

    public function addEventListener(string $event, int $priority, callable $callback)
    {
        if ( ! isset ($this->eventListeners[$event]))
            $this->eventListeners[$event] = [];
        if ( ! isset ($this->eventListeners[$event][$priority]))
            $this->eventListeners[$event][$priority] = [];
        $this->eventListeners[$event][$priority][] = $callback;
        $this->isSorted = false;
    }


    public function triggerEvent ($event, ...$params)
    {
        if ( ! isset ($this->eventListeners[$event]))
            return false;

        ksort($this->eventListeners[$event]);
        foreach ($this->eventListeners[$event] as $curEvent) {
            foreach ($curEvent as $callback)
                $callback(...$params);
        }
        return true;
    }
}