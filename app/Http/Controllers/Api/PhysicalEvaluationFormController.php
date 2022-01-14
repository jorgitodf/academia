<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PhysicalEvaluationForm;
use App\Model\Registration;
use App\Validations\ValidationPhysicalEvaluationForm;
use App\Helpers\Helpers;
use App\Model\User;

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
        $user = new User();

        $erros = $this->validationPhysicalEvaluationForm->validatePhysicalEvaluationForm($data, $this->physicalEvaluationForm, $registration, $user, null);

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

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $registration = new Registration();
        $user = new User();

        $erros = $this->validationPhysicalEvaluationForm->validatePhysicalEvaluationForm($data, $this->physicalEvaluationForm, $registration, $user, 'PUT', $id);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $physicalEvaluationForm = $this->physicalEvaluationForm->findOrFail($id);
            $physicalEvaluationForm->update($data);
            return response()->json(['data' => ['msg' => 'Formulário de Avaliação Física Atualizado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        $erros = $this->validationPhysicalEvaluationForm->validateIdPhysicalEvaluationForm($id, $this->physicalEvaluationForm);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $physicalEvaluationForm = $this->physicalEvaluationForm->with('user')->with('instructor')->findOrFail($id);
            return response()->json(['peform' => $physicalEvaluationForm], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


}
