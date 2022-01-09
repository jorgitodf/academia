<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Exercise;
use App\Model\GroupExercise;
use App\Validations\ValidationExercise;

class ExerciseController extends Controller
{
    private $exercise;
    private $validationExercise;

    public function __construct(Exercise $exercise, ValidationExercise $validationExercise)
    {
        $this->exercise = $exercise;
        $this->validationExercise = $validationExercise;
    }

    public function show($id)
    {
        $erros = $this->validationExercise->validateIdExercise($id, $this->exercise);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $exercise = $this->exercise->with('group_exercise')->findOrFail($id);
            return response()->json(['data' => $exercise], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $groupExercise = new GroupExercise();

        $erros = $this->validationExercise->validateExercise($data, $this->exercise, $groupExercise, 'PUT', $id);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $exercise = $this->exercise->findOrFail($id);
            $exercise->update($data);
            return response()->json(['data' => ['msg' => 'Exercício Atualizado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $groupExercise = new GroupExercise();

        $erros = $this->validationExercise->validateExercise($data, $this->exercise, $groupExercise, null, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $exercise = $this->exercise->create($data);
            return response()->json(['data' => ['msg' => 'Exercício '.$exercise->name.' Cadastrado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
