<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

interface MyEventInterface extends \Usox\EventBus\Contract\SyncEventInterface {
    
    public function setFirstname(?string $firstname): MyEventInterface;
    
    public function getFirstname(): ?string;
}

class MyEvent implements MyEventInterface
{
    /**
     * @var null|string
     */
    private $firstname = null;

    public function setFirstname(?string $firstname): MyEventInterface
    {
        $this->firstname = $firstname;
        return $this;
    }
    
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

}

$listeners = [
    MyEventInterface::class => [function (MyEventInterface $event): void {
        var_dump($event->getFirstname());
    }]
];

$bus = \Usox\EventBus\EventBus::init($listeners);

$event = new MyEvent();
$event->setFirstname('Slim Shady');

$bus->fireEvent($event);