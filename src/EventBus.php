<?php declare(strict_types=1);

namespace Usox\EventBus;

use Usox\EventBus\Contract\EventInterface;
use Usox\EventBus\Router\EventRouterInterface;

final class EventBus implements EventBusInterface
{

    private $router;

    private function __construct(
        EventRouterInterface $router
    ) {
        $this->router = $router;
    }

    public function fireEvent(EventInterface $event): void
    {
        $transport = $this->router->route($event);
        
        $transport->dispatch($event);
    }

    public static function init(
        array $listeners,
        array $routes = []
    ): EventBusInterface {
        return new static(
            new Router\EventRouter($routes, $listeners)
        );
    }
}