<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\PdfFile;
use App\Entity\VideoFile;
use App\Entity\Author;

class FileFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 3; $i++) {
            $author = new Author();
            $author->setName('Name - ' . $i);
            $manager->persist($author);

            for ($j = 0; $j < 3; $j++) {
                $pdf = new PdfFile();
                $pdf->setFilename('pdf name ' . $j);
                $pdf->setDescription('pdf desc ' . $j);
                $pdf->setSize(5656);
                $pdf->setOrientation('portrait');
                $pdf->setPagesNumber(12);
                $pdf->setAuthor($author);
                $manager->persist($pdf);
            }

            for ($k = 0; $k < 3; $k++) {
                $video = new VideoFile();
                $video->setFilename('video name ' . $k);
                $video->setDescription('video desc ' . $k);
                $video->setSize(10000);
                $video->setFormat('mp4');
                $video->setDuration(12000);
                $video->setAuthor($author);
                $manager->persist($video);
            }
        }

        $manager->flush();
    }
}
