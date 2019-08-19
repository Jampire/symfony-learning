<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Events\VideoCreatedEventInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent(VideoCreatedEventInterface $event): void
    {
        dump($event->getVideo()->title);
    }

    public function onKernelResponse1(ResponseEvent $event): void
    {
//        $response = new Response('jampire');
//        $event->setResponse($response);
        dump('onKernelResponse1');
    }

    public function onKernelResponse2(ResponseEvent $event): void
    {
//        $response = new Response('jampire');
//        $event->setResponse($response);
        dump('onKernelResponse2');
    }

    public static function getSubscribedEvents()
    {
        return [
//            'video.created.event' => 'onVideoCreatedEvent',
//            KernelEvents::RESPONSE => [
//                ['onKernelResponse1', 2],
//                ['onKernelResponse2', 1],
//            ],
        ];
    }
}
