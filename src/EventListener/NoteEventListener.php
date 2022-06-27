<?php

namespace App\EventListener;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\NoteExpense;
use App\Entity\User;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NoteEventListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setNewDate', EventPriorities::PRE_VALIDATE],
        ];
    }
    public function setNewDate(ViewEvent $event): void
    {
        /* @var $user User; */
        $noteExpense = $event->getControllerResult();
        if ($noteExpense instanceof NoteExpense) {
            $method = $event->getRequest()->getMethod();
            if (Request::METHOD_POST === $method) {
                $noteExpense->setCreatedAt(new DateTime());
            }
        }
    }
}
