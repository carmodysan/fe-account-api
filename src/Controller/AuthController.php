<?php

namespace App\Controller;

use App\Repository\PeriodicOperationRepository;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class AuthController extends AbstractController
{
    private $userRepository;
    private $periodicOperationRepository;
    private $serializer;
    private $security;
    private $logger;

    public function __construct(UserRepository $userRepository, PeriodicOperationRepository $periodicOperationRepository, SerializerInterface $serializer, Security $security, LoggerInterface $logger)
    {
        $this->userRepository = $userRepository;
        $this->periodicOperationRepository = $periodicOperationRepository;
        $this->serializer = $serializer;
        $this->security = $security;
        $this->logger = $logger;
    }
    
    /**
     * @Route("/register", name="user.register")
     */
    public function index(Request $request): JsonResponse
    {
        $jsonData = json_decode($request->getContent());
        $user = $this->userRepository->create($jsonData);

        return new JsonResponse([
            'user' => $this->serializer->serialize($user, 'json')
        ], 201);        
    }

    /**
     * @Route("/profile", name="user.profile")
     */
    public function profile(): JsonResponse
    {
        $currentUser = $this->security->getUser();
        $user = $this->serializer->serialize($currentUser, 'json');
        
        return new JsonResponse([
            $user
        ], 200); 
    }

    /**
     * @Route("/periodic_operations", name="user.preiod")
     *
     * @return JsonResponse
     */
    public function test(): JsonResponse
    {
        $currentUser = $this->security->getUser();
        $user = $this->serializer->serialize($currentUser, 'json');
        $obj = json_decode($user);
        $this->logger->debug('====================>>>>>>>> '.$obj->{'id'});
        $authorId = $obj->{'id'};
        $periodicOperations = $this->periodicOperationRepository->findBy(['authorId' => $authorId]);
        $po = $this->serializer->serialize($periodicOperations, 'json');

        return new JsonResponse([
            $po
        ], 200); 
    }
}
