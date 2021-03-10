<?php

namespace App\Models\Visitantes;

use Illuminate\Support\Facades\Hash;

class VisitanteObserver
{
  public function creating(Visitante $visitante)
  {
    $visitante->password = Hash::make($visitante->password);
  }
}
