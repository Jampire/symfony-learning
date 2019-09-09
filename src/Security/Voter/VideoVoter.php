<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Video;

class VideoVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [Video::VIDEO_DELETE_ATTR, Video::VIDEO_VIEW_ATTR], true)
            && $subject instanceof Video;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        /** @var Video $video */
        $video = $subject;

        switch ($attribute) {
            case Video::VIDEO_VIEW_ATTR:
            case Video::VIDEO_DELETE_ATTR:
                return $user === $video->getSecurityUser();
        }

        return false;
    }
}
