<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Firebase\JWT\ExpiredException;
use App\Models\Visitantes\Visitante;

class ConfirmarEmail
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    $token = $request->headers->get('token');

    if (!$token) {
      return response([
        'message' => 'Autorización no encontrada.',
        'token' => $token
      ], Response::HTTP_UNAUTHORIZED);
    }

    try {
      $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
    } catch (ExpiredException $e) {
      return response([
        'message' => 'El tiempo de verificación de su correo ha expirado, solicite un link de verificación nuevo',
        'errorDetail' => $e->getMessage()
      ], Response::HTTP_UNAUTHORIZED);
    } catch (Exception $e) {
      return response([
        'message' => 'No se ha podido reconocer su autorizacion.',
      ], Response::HTTP_UNAUTHORIZED);
    }

    $visitante = Visitante::find($credentials->id);

    if (!$visitante) {
      return response([
        'message' => 'Usted no esta autorizado a realizar esta acción',
      ], Response::HTTP_UNAUTHORIZED);
    }

    if (!$credentials->type || $credentials->type !== 'confirmar_email') {
      return response([
        'message' => 'Error al confirmar su correo',
      ], Response::HTTP_UNAUTHORIZED);
    }

    $request->auth_email = $visitante;

    return $next($request);
  }
}
