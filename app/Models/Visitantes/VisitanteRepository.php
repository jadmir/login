<?php

namespace App\Models\Visitantes;

use Exception;

class VisitanteRepository
{
  protected $Visitante;

  public function __construct(Visitante $visitante)
  {
    $this->visitante = $visitante;
  }
  /**
   * listar todos los visitantes
   */
  public function allVisitantes()
  {
    $visitantes = $this->visitante->all();

    return $visitantes;
  }

  /**
   * Encontrar visitante por dni
   */
  public function findByDni($dni): ?Visitante
  {
    $visitante = $this->visitante->where('dni', $dni);

    return $visitante;
  }

  /**
   * Encontrar visitante por nombre
   */
  public function findByNombre($nombres): ?Visitante
  {
    $visitante = $this->visitante->where('nombres', $nombres)
      ->first();

    return $visitante;
  }

  /**
   * Encontrar cliente por email
   */
  public function findByEmail($email): ?Visitante
  {
    $visitante = $this->visitante->where('email', $email)
      ->first();

    return $visitante;
  }

  /**
   * Registrar un nuevo visitante
   */
  public function saveVisitante(Visitante $visitante): ?Visitante
  {
    try {
      $isRegistered = $visitante->save();

      if (!$isRegistered) {
        ThrowBadRequest('No se pudo registrar al visitante.');
      }

      return $visitante;
    } catch (Exception $e) {
      ThrowBadRequest('Error al registrar visitante', $e->getMessage());
    }
  }

  /**
   * Validar la informacion que se recibe para crear un nuevo visitante
   */
  public function validateNewVisitante()
  {
    $rules = [
      'password' => 'required',
      'email' => 'required|unique:visitantes'
    ];

    $messages = [
      'password.required' => 'La contraseña es obligatoria',
      'email.required' => 'El email es obligatorio',
      'email.unique' => 'El email ya se encuentra registrado'
    ];

    return [$rules, $messages];
  }

  /**
   * Validar la información que se recibe para el login de un visitante
   */
  public function validateLogin()
  {
    $rules = [
      'email' => 'required',
      'password' => 'required'
    ];

    $messages = [
      'email.required' => 'El email del visitante es obligatorio',
      'password.required' => 'Contraseña obligatoria'
    ];
  }

}
