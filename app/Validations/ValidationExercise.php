<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationExercise
{
    private $erros = [];

    public function validateExercise($data, $model = null, $groupExerciseModel = null, $action = null, $id = null)
    {
        if ($id !== null) {
            $exercise = $model->find($id);
            if ($exercise === null || !is_numeric($id)) {
                $this->erros['error-exercise'] = "Exercício não Encontrado!";
            }
        }

        try {
            $exercise = $model->where('name', $data['name'])->first();
            $groupExercise = $groupExerciseModel->where('id', $data['group_exercise_id'])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if (!isset($data['name']) || empty($data['name'])) {
            $this->erros['error-name'] = "Informe o Exercício!";
        } else if ($exercise !== null && $action !== 'PUT') {
            $this->erros['error-name'] = "O Exercício " . $exercise->name . " já existe!";
        } else if ($groupExercise === null) {
            $this->erros['error-group-exercise'] = "Grupo de Exercício não localizado!";
        } else if (!isset($data['group_exercise_id']) || empty($data['group_exercise_id'])) {
            $this->erros['error-group-exercise'] = "Informe o Grupo do Exercicio!";
        } else {

            if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['name'])) {
                $this->erros['error-name'] = "O Campo Exercício não pode conter número(s)!";
            }

        }

        return $this->erros;
    }

    public function validateIdExercise($id, $model)
    {
        $user = $model->where('id', $id)->first();

        if (!is_numeric($id) || $user === null) {
            $this->erros['error-exercise'] = "Exercício não Encontrado!";
        }

        return $this->erros;
    }

}
