<?php declare(strict_types=1);

namespace Usox\EventBus\Router;

use Usox\EventBus\Contract\EventInterface;
use Usox\EventBus\Transport\TransportInterface;

interface EventRouterInterface
{

    public function route(EventInterface $event): TransportInterface;
}