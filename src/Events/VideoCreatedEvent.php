<?php

namespace App\Events;

use Symfony\Contracts\EventDispatcher\Event;

class VideoCreatedEvent extends Event implements VideoCreatedEventInterface
{
    public const NAME = 'video.created.event';

    protected $video;

    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }
}
