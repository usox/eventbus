<?php declare(strict_types=1);

namespace Usox\EventBus\Transport;

use Usox\EventBus\Contract\EventInterface;

final class AsyncTransport implements TransportInterface
{

    public function dispatch(EventInterface $event): void
    {
        // TODO: Implement dispatch() method.
    }
}