<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TrainingSheets;
use App\Model\Registration;
use App\Validations\ValidationTrainingSheet;
use App\Helpers\Helpers;
use App\Model\DayWeekTraining;
use App\Model\User;

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
        $user = new User();

        $erros = $this->validationTrainingSheet->validateTrainingSheet($data, $this->trainingSheet, $registration, $user, null);

        if (count($erros) > 0 && isset($erros['code']) && $erros['code'] == 500) {
            return response()->json(['errors' => $erros], 500);
        }

        if (count($erros) > 0) {
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

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $registration = new Registration();
        $user = new User();

        $erros = $this->validationTrainingSheet->validateTrainingSheet($data, $this->trainingSheet, $registration, $user, 'PUT', $id);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $trainingSheet = $this->trainingSheet->findOrFail($id);
            $trainingSheet->update($data);

            return response()->json(['data' => ['msg' => 'Ficha de Treinamento Atualizada com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        $erros = $this->validationTrainingSheet->validateIdTrainingSheet($id, $this->trainingSheet);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $trainingSheet = $this->trainingSheet->with('user')->with('instructor')->findOrFail($id);
            $dyt = New DayWeekTraining();
            $dayWeekTraining = $dyt->with('exercises')->where('training_sheets_id', $id)->get();

            return response()->json(['training-sheet' => $trainingSheet, 'exercises' => $dayWeekTraining], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
