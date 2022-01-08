<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationGroupExercise
{
    private $erros = [];

    public function validateGroupExercise($data, $model = null, $action = null)
    {
        try {
            $groupExercise = $model->where('name', $data['name'])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if (!isset($data['name']) || empty($data['name'])) {
            $this->erros['error-name'] = "Informe o Grupo de Exercício!";
        } else if ($groupExercise !== null && $action !== 'PUT') {
            $this->erros['error-name'] = "O Grupo de Exercício " . $groupExercise->name . " já existe!";
        } else {

            if (!isset($data['name']) || empty($data['name'])) {
                $this->erros['error-name'] = "Informe o Nome do Grupo de Exercício!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['name'])) {
                $this->erros['error-name'] = "O Campo Nome do Grupo de Exercício não pode conter número(s)!";
            }

        }

        return $this->erros;
    }

    public function validateIdFormPayment($id, $model)
    {
        $user = $model->where('id', $id)->first();

        if (!is_numeric($id) || $user === null) {
            $this->erros['error-id'] = "Forma de Pagamento não Encontrada!";
        }

        return $this->erros;
    }

}
