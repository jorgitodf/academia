<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PhysicalEvaluationForm;
use App\Model\Registration;
use App\Validations\ValidationPhysicalEvaluationForm;
use App\Helpers\Helpers;

class PhysicalEvaluationFormController extends Controller
{
    private $physicalEvaluationForm;
    private $validationPhysicalEvaluationForm;

    public function __construct(PhysicalEvaluationForm $physicalEvaluationForm, ValidationPhysicalEvaluationForm $validationPhysicalEvaluationForm)
    {
        $this->physicalEvaluationForm = $physicalEvaluationForm;
        $this->validationPhysicalEvaluationForm = $validationPhysicalEvaluationForm;
    }

    public function index()
    {
        $physicalEvaluationForm = $this->physicalEvaluationForm->paginate('10');

        if ($physicalEvaluationForm->count() > 0) {
            return response()->json($physicalEvaluationForm, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhum Formulário de Avaliação Física Encontrado!']], 400);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $registration = new Registration();

        $erros = $this->validationPhysicalEvaluationForm->validatePhysicalEvaluationForm($data, $this->physicalEvaluationForm, $registration, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $data['revaluation'] = date('Y-m-d', strtotime(Helpers::formataData($data['valuation']). ' + 3 month'));
            $physicalEvaluationForm = $this->physicalEvaluationForm->create($data);
            return response()->json(['data' => ['msg' => 'Formulário de Avaliação Física Cadastrado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

}
