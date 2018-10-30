<?php declare(strict_types=1);


namespace Usox\EventBus\Router;


use Usox\EventBus\Contract\EventInterface;

interface EventRouterInterface
{

    public function route(EventInterface $event): callable;
}