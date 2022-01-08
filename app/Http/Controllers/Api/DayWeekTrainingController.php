<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DayWeekTraining;
use App\Model\Exercise;
use App\Validations\ValidationDayWeekTraining;


class DayWeekTrainingController extends Controller
{
    private $dayWeekTraining;
    private $validationDayWeekTraining;

    public function __construct(DayWeekTraining $dayWeekTraining, ValidationDayWeekTraining $validationDayWeekTraining)
    {
        $this->dayWeekTraining = $dayWeekTraining;
        $this->validationDayWeekTraining = $validationDayWeekTraining;
    }

    public function index()
    {
        $dayWeekTraining = $this->dayWeekTraining->with('exercises')->paginate('10');

        if ($dayWeekTraining->count() > 0) {
            return response()->json($dayWeekTraining, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhuma Forma de Pagamento Encontrada!']], 404);
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $erros = $this->validationDayWeekTraining->validateDayWeekTraining($data, $this->dayWeekTraining, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $dayWeekTraining = $this->dayWeekTraining->create($data);

            return response()->json(['data' => [
                'msg' => 'Treino de '.$dayWeekTraining->day_week.' criado com Sucesso, cadastre agora os exercícios desejados!',
                'id' => $dayWeekTraining->id,
                'day_week' => $dayWeekTraining->day_week
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $erros = $this->validationDayWeekTraining->validateDayWeekExercises($data, $this->dayWeekTraining, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $dayWeekTraining = $this->dayWeekTraining->where('id', $data['day_week_training_id'])->first();
            $dayWeekTraining->exercises()->attach($data['exercises'], $data['treinos']);
            $exercise = new Exercise();
            $e = $exercise->where('id', $data['exercises'][0])->first();

            return response()->json(['data' => [
                'msg' => 'Exercício ' . $e->name . ' para '.$dayWeekTraining->day_week.' cadastrado com Sucesso!'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
