<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Registration;
use App\Model\User;
use App\Model\Plan;
use App\Validations\ValidationRegistration;
use App\Helpers\Helpers;

class RegistrationController extends Controller
{
    private $registration;
    private $validationRegistration;

    public function __construct(Registration $registration, ValidationRegistration $validationRegistration)
    {
        $this->registration = $registration;
        $this->validationRegistration = $validationRegistration;
    }

    public function index()
    {
        $registration = $this->registration->paginate('10');

        if ($registration->count() > 0) {
            return response()->json($registration, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhuma Matrícula Encontrada!']], 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User();

        $erros = $this->validationRegistration->validateRegistration($data, $user, $this->registration, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $plan = new Plan();
            $data['registration'] = mt_rand(10000,99999) . Helpers::getAno();
            $data['end_date'] = Helpers::geraDataFimMatricula($plan, $data['start_date'], $data['plan_id']);

            $registration = $this->registration->create($data);
            return response()->json(['data' => ['msg' => 'Matríciula Realizada com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        $erros = $this->validationRegistration->validateIdRegistration($id, $this->registration);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $registration = $this->registration->with('user')->with('plan')->with('form_payment')->findOrFail($id);
            return response()->json(['registration' => $registration], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

}
