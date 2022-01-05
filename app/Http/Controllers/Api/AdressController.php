<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Adress;
use App\Validations\ValidationAdress;
use App\Helpers\Helpers;

class AdressController extends Controller
{
    private $adress;
    private $validationAdress;

    public function __construct(Adress $adress, ValidationAdress $validationAdress)
    {
        $this->adress = $adress;
        $this->validationAdress = $validationAdress;
    }

    public function index()
    {
        $adress = $this->adress->paginate('10');

        if ($adress->count() > 0) {
            return response()->json($adress, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhum Registro de Usuário Encontrado!']], 404);
    }

}
