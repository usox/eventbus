<?php declare(strict_types=1);

namespace Usox\EventBus\Transport;

use Usox\EventBus\Contract\EventInterface;

final class SyncTransport implements TransportInterface
{
    /**
     * @var callable[]
     */
    private $listeners = [];
    
    public function __construct(array $listeners)
    {
        $this->listeners = $listeners;
    }

    public function dispatch(EventInterface $event): void
    {
        $interfaces = class_implements($event);

        foreach ($interfaces as $interface_name) {
            if (array_key_exists($interface_name, $this->listeners)) {
                $listeners = $this->listeners[$interface_name];

                if (!is_array($listeners)) {
                    $listeners = [$listeners];
                }

                foreach ($listeners as $listener) {
                   $listener($event);
                }
            }
        }
    }
}