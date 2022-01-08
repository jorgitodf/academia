<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationRegistration
{
    private $erros = [];

    public function validateRegistration($data, $modelUser = null, $modelRegistration = null, $action = null)
    {
        $registration = null;

        try {
            $user = $modelUser->where('id', $data['user_id'])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if ($user !== null) {
            try {
                $registration = $modelRegistration->where('user_id', $user->id)->first();
            } catch (\Exception $e) {
                return ['error' => $e->getMessage(), 'code' => 500];
            }
        }

        if ($registration !== null && $action !== 'PUT') {
            $this->erros['error-registration'] = "Aluno já Matriculado!";
        } else {

            if (!isset($data['start_date']) || empty($data['start_date'])) {
                $this->erros['error-start-date'] = "Informe a Data de Início da Matrícula!";
            } else if (!Helpers::ValidaData($data['start_date'])) {
                $this->erros['error-start-date'] = "A Data de Início da Matrícula é inválida!";
            }

            if (!isset($data['paid_out']) || empty($data['paid_out'])) {
                $this->erros['error-paid-out'] = "Informe se o pagamento da Matrícula foi realizado!";
            }  else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['paid_out'])) {
                $this->erros['error-paid-out'] = "O Pagamento da Matrícula não pode conter número(s)!";
            }

            if (!isset($data['user_id']) || empty($data['user_id'])) {
                $this->erros['error-user'] = "Informe o Aluno a ser Matriculado!";
            } else if (!is_numeric($data['user_id']) || $user === null) {
                $this->erros['error-user'] = "Aluno não Encontrado!";
            }

            if (!isset($data['plan_id']) || empty($data['plan_id'])) {
                $this->erros['error-plan'] = "Informe o Plano desejado para a Matricula!";
            } else if (!is_numeric($data['plan_id'])) {
                $this->erros['error-plan'] = "Plano desejado não Encontrado!";
            }

            if (!isset($data['form_payment_id']) || empty($data['form_payment_id'])) {
                $this->erros['error-payment'] = "Informe a Forma de Pagamento da Matricula!";
            } else if (!is_numeric($data['form_payment_id'])) {
                $this->erros['error-payment'] = "Forma de Pagamento não Encontrada!";
            }

        }

        return $this->erros;
    }

    public function validateIdRegistration($id, $model)
    {
        $registration = $model->where('id', $id)->first();

        if (!is_numeric($id) || $registration === null) {
            $this->erros['error-id'] = "Matrícula não Encontrada!";
        }

        return $this->erros;
    }

}
