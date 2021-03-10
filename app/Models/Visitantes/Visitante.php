<?php

namespace App\Models\Visitantes;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitante extends Model
{
    use HasFactory;

    protected $table = 'visitantes';

    protected $hidden = ['password'];

    protected $fillable = [
      'dni',
      'ap_paterno',
      'ap_materno',
      'nombres',
      'celular',
      'email',
      'password'
    ];

    protected static function boot()
    {
      parent::boot();
      Visitante::observe(VisitanteObserver::class);
    }

    /**
   * Verficar que la contraseña del usuario sea válida
   */
    public function validPassword($password)
    {
      return Hash::check($password, $this->password);
    }
}
