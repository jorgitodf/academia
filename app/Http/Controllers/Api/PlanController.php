<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Plan;
use App\Validations\ValidationPlan;
use App\Helpers\Helpers;

class PlanController extends Controller
{
    private $plan;
    private $validationPlan;

    public function __construct(Plan $plan, ValidationPlan $validationPlan)
    {
        $this->plan = $plan;
        $this->validationPlan = $validationPlan;
    }

    public function index()
    {
        $plan = $this->plan->paginate('10');

        if ($plan->count() > 0) {
            return response()->json($plan, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhum Plano Encontrado!']], 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $erros = $this->validationPlan->validatePlan($data, $this->plan, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $data['active'] = 'Sim';
            $plan = $this->plan->create($data);
            return response()->json(['data' => ['msg' => 'Plano Cadastrado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
