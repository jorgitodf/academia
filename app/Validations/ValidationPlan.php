<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationPlan
{
    private $erros = [];

    public function validatePlan($data, $model = null, $action = null)
    {
        $plan = $model->where('plan', $data['plan'])->where('active', 'Sim')->first();

        if (!isset($data['plan']) || empty($data['plan'])) {
            $this->erros['error-plan'] = "Informe o Plano!";
        } else if ($plan !== null && $plan->plan === $data['plan'] && $action !== 'PUT') {
            $this->erros['error-plan'] = "O Plano informado já está cadastrado!";
        } else {

            if (!isset($data['value']) || empty($data['value'])) {
                $this->erros['error-value'] = "Informe o Valor do Plano!";
            }

        }

        return $this->erros;
    }

    public function validateIdPlan($id, $model)
    {
        $user = $model->where('id', $id)->first();

        if (!is_numeric($id) || $user === null) {
            $this->erros['error-id'] = "Usuário não Encontrado!";
        }

        return $this->erros;
    }

}
