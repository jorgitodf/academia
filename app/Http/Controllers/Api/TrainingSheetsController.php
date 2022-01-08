<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TrainingSheets;
use App\Model\Registration;
use App\Validations\ValidationTrainingSheet;
use App\Helpers\Helpers;

class TrainingSheetsController extends Controller
{
    private $trainingSheet;
    private $validationTrainingSheet;

    public function __construct(TrainingSheets $trainingSheet, ValidationTrainingSheet $validationTrainingSheet)
    {
        $this->trainingSheet = $trainingSheet;
        $this->validationTrainingSheet = $validationTrainingSheet;
    }

    public function index()
    {
        $trainingSheet = $this->trainingSheet->paginate('10');

        if ($trainingSheet->count() > 0) {
            return response()->json($trainingSheet, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhuma Ficha de Treinamento Encontrada!']], 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $registration = new Registration();

        $erros = $this->validationTrainingSheet->validateTrainingSheet($data, $this->trainingSheet, $registration, null);

        if ($erros && (isset($erros['code']) && $erros['code'] == 500)) {
            return response()->json(['errors' => $erros], 500);
        } else {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $data['end_date'] = date('Y-m-d', strtotime(Helpers::formataData($data['start_date']). '+ 1 month'));
            $data['active'] = 'Sim';
            $trainingSheet = $this->trainingSheet->create($data);
            return response()->json(['data' => ['msg' => 'Ficha de Treinamento do Aluno '.$trainingSheet->user->name.' Criada com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
