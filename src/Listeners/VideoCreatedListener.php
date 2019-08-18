<?php

namespace App\Listeners;

use App\Events\VideoCreatedEventInterface;

class VideoCreatedListener
{
    public function onVideoCreatedEvent(VideoCreatedEventInterface $event): void
    {
        dump($event->getVideo()->title);
    }
}
