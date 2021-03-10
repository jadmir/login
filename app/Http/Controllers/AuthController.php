<?php

namespace App\Http\Controllers;

use App\Models\Visitantes\VisitanteRepository;
use Carbon\Carbon;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
  protected $userRepository;

  public function __construct(VisitanteRepository $visitanteRepository)
  {
    $this->visitanteRepository = $visitanteRepository;
  }

  protected function generateToken(Int $id)
  {
    $payload = [
      'iss' => env('JWT_ISS'),
      'id' => $id,
      'iat' => time(),
      'exp' => strtotime(Carbon::now()->addDay()),
    ];

    return JWT::encode($payload, env('JWT_SECRET'));
  }

  /**
   * Login usuario con email
   */
  public function loginEmail()
  {
    $dataLogin = request()->input();

    $email = $dataLogin['email'];
    $password = $dataLogin['password'];

    $visitante = $this->visitanteRepository->findByEmail($email);

    CheckModel($visitante, 'Email incorrecto');

    if (!$visitante->esta_verificado) {
      ThrowBadRequest('Debe verificar su correo para poder ingresar');
    }

    $passwordValid = $visitante->validPassword($password);

    if (!$passwordValid) {
      ThrowBadRequest('La contraseña es incorrecta');
    }

    return response([
      'visitante' => $visitante,
      'token' => $this->generateToken($visitante->id)
    ], 200);
  }
}
