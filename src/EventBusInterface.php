<?php declare(strict_types=1);


namespace Usox\EventBus;


interface EventBusInterface
{

    public function fireEvent(Contract\EventInterface $event): void;
}