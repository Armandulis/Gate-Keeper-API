<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use App\Service\Validation\UserValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route( '/api', name: 'api_' )]
class RegisterController extends AbstractController
{
  /**
   * RegisterController constructor
   * @param UserService $userService
   * @param UserValidationService $userValidationService
   */
  public function __construct(
    private readonly UserService $userService,
    private readonly UserValidationService $userValidationService
  )
  {
  }

  /**
   * Handles the registration process.
   * @Route("/register", name="app_register", methods={'POST'})
   * @param Request $request The request object containing the registration data
   * @return JsonResponse The JSON response containing the success message
   */
  #[Route( '/register', name: 'register', methods: [ 'POST' ] )]
  public function register( Request $request ) : JsonResponse
  {
    // Get request input
    $plaintextPassword = $request->request->get( 'password' );
    $email = $request->request->get( 'email' );
    $username = $request->request->get( 'username' );

    // Validate input
    if( $errors = $this->userValidationService->validateRegisterUser( $email, $plaintextPassword, $username ) )
    {
      return $this->json(
        [ 'errors' => $errors ],
        Response::HTTP_BAD_REQUEST
      );
    }

    // Create user
    $user = new User();
    $user->setEmail( $email );
    $user->setUsername( $username );
    $this->userService->createUser( $user, $plaintextPassword );

    return $this->json( [
      'message' => 'User with email ' . $user->getEmail() . ' successfully created!',
    ] );
  }
}
