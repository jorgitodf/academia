<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GroupExercise;
use App\Validations\ValidationGroupExercise;

class GroupExerciseController extends Controller
{
    private $groupExercise;
    private $validationGroupExercise;

    public function __construct(GroupExercise $groupExercise, ValidationGroupExercise $validationGroupExercise)
    {
        $this->groupExercise = $groupExercise;
        $this->validationGroupExercise = $validationGroupExercise;
    }

    public function index()
    {
        $groupExercise = $this->groupExercise->paginate('10');

        if ($groupExercise->count() > 0) {
            return response()->json($groupExercise, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhum Grupo de Exercício Encontrado!']], 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $erros = $this->validationGroupExercise->validateGroupExercise($data, $this->groupExercise, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $ge = $this->groupExercise->create($data);
            return response()->json(['data' => ['msg' => 'O Grupo de Exercício ' . $ge->name . ' foi Cadastrado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        $erros = $this->validationGroupExercise->validateIdGroupExercise($id, $this->groupExercise);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $groupExercise = $this->groupExercise->findOrFail($id);
            return response()->json(['data' => $groupExercise], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $erros = $this->validationGroupExercise->validateGroupExercise($data, $this->groupExercise, 'PUT', $id);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $groupExercise = $this->groupExercise->findOrFail($id);
            $groupExercise->update($data);
            return response()->json(['data' => ['msg' => 'Grupo de Exercício Atualizado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
