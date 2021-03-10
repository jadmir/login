<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Mails\MailRepository;
use App\Models\Visitantes\Visitante;
use App\Models\Token\TokenRepository;
use App\Models\Visitantes\VisitanteRepository;

class VisitanteController extends Controller
{
  protected $visitanteRepository;

  public function __construct(VisitanteRepository $visitanteRepository)
  {
    $this->visitanteRepository = $visitanteRepository;
  }
    /**
     * Listar todos los visitantes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $visitantes = $this->visitanteRepository->allVisitantes();

      return response([
        'visitantes' => $visitantes
      ], Response::HTTP_OK);
    }

    /**
     * Store crea un nuevo visitante
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dataVisitante = request()->input();

      [$rules, $messages] = $this->visitanteRepository->validateNewVisitante($dataVisitante);
      CheckValidate($dataVisitante, $rules, $messages);
      $visitante = $this->visitanteRepository->saveVisitante($dataVisitante);

      return response([
        'visitante' => $visitante
      ], Response::HTTP_CREATED);
    }

    /**
     * Registrarse dentro del sistema
     */
    public function registrar(Request $request)
    {
      $dataVisitante = $request->input();

      [$rules, $messages] = $this->visitanteRepository->validateNewVisitante($dataVisitante);
      CheckValidate($dataVisitante, $rules, $messages);

      $newVisitante = new Visitante();
      $newVisitante->dni= $request->dni;
      $newVisitante->ap_paterno = $request->ap_paterno;
      $newVisitante->ap_materno = $request->ap_materno;
      $newVisitante->nombres = $request->nombres;
      $newVisitante->celular = $request->celular;
      $newVisitante->email = $request->email;
      $newVisitante->password = $request->password;
      $newVisitante->save();

      $visitante = $this->visitanteRepository->saveVisitante($newVisitante);

      $token = TokenRepository::generarTokenConfirmacioEmail($visitante->id);

      MailRepository::verificarEmail([
        'email' => $visitante->email
      ], $visitante->email, $visitante->dni, $token);

      return response([
        'visitante' => $visitante
      ], Response::HTTP_CREATED);
    }

    /**
     * verficiar el correo de un visitante recientemente registrado
     */
    public function verificarCorreo()
    {
      $visitante = request()->auth_email;

      if($visitante->esta_verificado) {
        return response([
          'message' => 'Email verifado'
        ], Response::HTTP_OK);
      }

      $visitante->esta_verificado = true;
      $visitante->d_verificado = Carbon::now();
      $visitante->save();

      $this->visitanteRepository->saveVisitante($visitante);

      return response([
        'visitante' => $visitante
      ], Response::HTTP_CREATED);
    }

    /**
     * Reenviar correo de verificacion de email
     */
    public function reenviarCorreoVerificacion()
    {
      $email = request()->post('email');

      $visitante = $this->VisitanteRepository->findByEmail($email);

      if (!$visitante) {
        return response([
          'message' => 'El correo ingresado no corresponde a ningun registro'
        ], Response::HTTP_OK);
      }

      $token = TokenRepository::generarTokenConfirmacioEmail($visitante->id);

      MailRepository::verificarEmail([
        'email' => $visitante->email
      ], $visitante->email, $visitante->nombres, $token);

      return response([
        'message' => 'El correo verificado fue reenviado'
      ], Response::HTTP_OK);
    }

    /**
     * busqueda por dni
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dni)
    {
      $visitante = $this->visitanteRepository->findByDni($dni);

      CheckModel($visitante, 'El visitante no existe');

      return Response([
        'visitante' => $visitante
      ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
