<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Author;
use App\Entity\File;
use App\Entity\PdfFile;
use App\Entity\User;
use App\Entity\Video;
use App\Events\VideoCreatedEvent;
use App\Form\VideoFormType;
use App\Services\GiftsService;
use App\Services\MyService;
use App\Services\MyThirdService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class DefaultController extends AbstractController
{
    /** @var EventDispatcherInterface */
    private $dispatcher;

    public function __construct($logger, EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function index(): Response
    {
        $users = ['A', 'B', 'C', 'D'];

//        $entityManager = $this->getDoctrine()->getManager();
//        $user = (new User())->setName('Adam');
//        $user2 = (new User())->setName('Robert');
//        $user3 = (new User())->setName('John');
//        $user4 = (new User())->setName('Susan');
//        $entityManager->persist($user);
//        $entityManager->persist($user2);
//        $entityManager->persist($user3);
//        $entityManager->persist($user4);
//        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
        ]);
    }

    /**
     * @Route("/", name="default")
     * @Route("users", name="users_list")
     * @param GiftsService $gifts
     * @param Request $request
     * @return Response
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function getUsers(GiftsService $gifts, Request $request): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        //$this->addFlash('notice', 'AHAHAHA');

//        $filledGifts = array_merge(
//            $gifts->gifts,
//            array_fill(count($gifts->gifts) - 1, count($users) - count($gifts->gifts), 'nothing')
//        );

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }

    /**
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}/{category}",
     *     defaults={"category": "computers"},
     *     requirements={
     *         "_locale": "by|en",
     *         "category": "computers|rtv",
     *         "year": "\d+"
     *     }
     * )
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function articles()
    {

    }

    /**
     * @Route("/cookie", name="my_cookie")
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function myCookie(): Response
    {
        $cookie = new Cookie('my_cookie', 'my_value', 3600);
        $res = new Response();
        $res->headers->setCookie($cookie);
        $res->send();

        return $res;
    }

    /**
     * @Route("/generate-url/{param?}", name="generate_url")
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function myGenerateUrl()
    {
        exit($this->generateUrl('generate_url', [
            'param' => 10,
        ], UrlGeneratorInterface::ABSOLUTE_URL));
    }

    /**
     * @Route("/download")
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function download()
    {
        $path = $this->getParameter('download_directory');

        return $this->file($path . '/a.txt');
    }

    public function mostPopularPosts(int $number = 3)
    {
        $posts = ['post 1', 'post 2', 'posts 3', 'posts 4'];

        return $this->render('default/most_popular_posts.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/save/{name}", name="crete_user")
     * @param string $name
     *
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     * @return Response
     */
    public function saveUser(string $name): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setName($name);
//        for ($i = 0; $i < 5; $i++) {
//            $user = new User();
//            $user->setName($name . ' - ' . $i);
//            $entityManager->persist($user);
//        }

        //$entityManager->flush();

        for ($i = 0; $i < 3; $i++) {
            $video = new Video();
            $video->setTitle('Video title - ' . $i);
            $user->addVideo($video);
            $entityManager->persist($video);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('default/create_user.html.twig', [
            'user_id' => $user->getId(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="show_user", requirements={"id": "\d+"})
     * @param User $user
     * @param MyThirdService $service
     *
     * @return Response
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     * @throws
     */
    public function show(User $user, MyThirdService $service): Response
    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $items = $entityManager->getRepository(Author::class)->findByIdWithPdf(1);
//        dump($items);

        $service->doAction();


        return $this->render('default/show_user.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/task", name="my_task")
     * @return Response
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function task(): Response
    {
        $cache = new FilesystemAdapter();
        $posts = $cache->get('user_posts', static function (ItemInterface $item) {
            $item->expiresAfter(15);
            $computedValue = ['post 1', 'post 2', 'post 3'];
            dump('connected with database ... ');

            return $computedValue;
        });

        dump($posts);

        return $this->render('default/task.html.twig', [
            'label' => 'Task',
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/video-created", name="video_created")
     * @return Response
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function videoCreated(): Response
    {
        $video = new \stdClass();
        $video->title = 'Funny movie';
        $video->category = 'funny';

        $event = new VideoCreatedEvent($video);
        $this->dispatcher->dispatch($event, VideoCreatedEvent::NAME);

        return $this->render('default/task.html.twig', [
            'label' => 'Video Created Event',
        ]);
    }

    /**
     * @Route("video-form", name="video_form")
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function videoForm(Request $request): Response
    {
        $video = new Video;
//        $video->setTitle('Write a blog post');
//        $video->setCreatedAt(new \DateTime('tomorrow'));

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());

            //return $this->redirectToRoute('home');
        }

        return $this->render('default/task.html.twig', [
            'label' => 'Video Form',
            'form' => $form->createView(),
        ]);
    }
}
