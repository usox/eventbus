<?php declare(strict_types=1);

namespace Usox\EventBus\Router;

use Usox\EventBus\Contract\EventInterface;
use Usox\EventBus\Contract\SyncEventInterface;
use Usox\EventBus\Transport\SyncTransport;
use Usox\EventBus\Transport\TransportInterface;

final class EventRouter implements EventRouterInterface
{
    /**
     * @var EventRouterInterface[]
     */
    private $routes;
    
    public function __construct(
        array $routes
    ) {
        $this->routes = $routes;
    }

    public function route(EventInterface $event): callable
    {
        $interfaces = class_implements($event);
        $routes = $this->getMap();
        
        $transport = $routes[SyncEventInterface::class];
        
        foreach ($routes as $interface_name => $transport) {
            if (in_array($interface_name, $interfaces)) {
                break;
            }
        }
        
        return $transport;
    }

    /**
     * @return callable[]
     */
    private function getMap(): array
    {
        return array_merge([
            SyncEventInterface::class => function (array $listeners): TransportInterface {
                return new SyncTransport($listeners);
            }],
            $this->routes
        );
    }
}