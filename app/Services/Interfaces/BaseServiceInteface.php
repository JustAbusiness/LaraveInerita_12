<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface BaseServiceInteface
{
   public function save(Request $request, ?int $id  = null);
}
