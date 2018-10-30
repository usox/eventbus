<?php declare(strict_types=1);

namespace Usox\EventBus\Transport;

use Usox\EventBus\Contract\EventInterface;

interface TransportInterface
{

    public function dispatch(EventInterface $event): void;
}