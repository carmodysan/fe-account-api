<?php

namespace App\Controller;

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
    private $serializer;
    private $security;
    private $logger;

    public function __construct(UserRepository $userRepository, SerializerInterface $serializer, Security $security, LoggerInterface $logger)
    {
        $this->userRepository = $userRepository;
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
}
