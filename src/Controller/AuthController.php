<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    public function __construct(UserRepository $userRepository, SerializerInterface $serializer, Security $security)
    {
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
        $this->security = $security;
    }
    
    /**
     * @Route("/register", name="user.register")
     */
    public function index(Request $request, LoggerInterface $logger): JsonResponse
    {
        $jsonData = json_decode($request->getContent());
        $user = $this->userRepository->create($jsonData);

        $serialized = $this->serializer->serialize($user, 'json');
        $logger->info('===========================> logger serialized : '.$serialized);

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
