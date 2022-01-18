<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationTrainingSheet
{
    private $erros = [];

    public function validateTrainingSheet($data, $model = null, $registrationModel = null, $userModel = null, $action = null, $id = null)
    {
        try {
            $registration = $registrationModel->with('user')->where('user_id', $data['user_id'])->first();
            $trainingSheets = $model->with('user')->where('active', 'Sim')->where('user_id', $data['user_id'])->first();
            $user = $userModel->where('id', $data['user_id'])->first();
            $instructor = $userModel->where('id', $data['instructor_id'])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if ($id !== null) {

            $trainingSheet = $model->find($id);
            if ($trainingSheet === null || !is_numeric($id)) {
                $this->erros['error-training-sheet'] = "Ficha de Treinamento não Encontrada!";
            }

        } else {

            if (!isset($data['user_id']) || empty($data['user_id'])) {
                $this->erros['error-users'] = "Informe o Aluno para criar a Ficha de Treinamento!";
            } else if ($user === null) {
                $this->erros['error-users'] = "Aluno não Localizado!";
            } else if ($registration === null) {
                $this->erros['error-users'] = "O Aluno ainda não possui Matrícula!";
            } else if ($trainingSheets !== null && $action !== 'PUT') {
                $this->erros['error-users'] = "A Ficha de Treinamento para o Aluno ".$registration->user->name." já existe!";
            } else {

                if (!isset($data['start_date']) || empty($data['start_date'])) {
                    $this->erros['error-start-date'] = "Informe a Data da Ficha de Treinamento!";
                } else if (!Helpers::ValidaData($data['start_date'])) {
                    $this->erros['error-start-date'] = "A a Data da Ficha de Treinamento é inválida!";
                } else if (!isset($data['instructor_id']) || empty($data['instructor_id'])) {
                    $this->erros['error-instructor'] = "Informe o Instrutor responsável pela Avaliação Física!";
                } else if ($instructor === null) {
                    $this->erros['error-instructor'] = "Instutor não Localizado!";
                }

            }

        }
        return $this->erros;
    }

    public function validateIdTrainingSheet($id, $model)
    {
        $user = $model->where('id', $id)->first();

        if (!is_numeric($id) || $user === null) {
            $this->erros['error-id'] = "Ficha de Treinamento não Encontrada!";
        }

        return $this->erros;
    }

}
