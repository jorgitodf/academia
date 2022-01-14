<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationPhysicalEvaluationForm
{
    private $erros = [];

    public function validatePhysicalEvaluationForm($data, $model = null, $registrationModel = null, $modelUser = null, $action = null, $id = null)
    {
        try {
            $physicalEvaluationForm = $model->where('user_id', $data['user_id'])->first();
            $registration = $registrationModel->with('user')->where('user_id', $data['user_id'])->first();
            $user = $modelUser->where('id', $data['instructor_id'])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if ($id !== null) {
            try {
                $pef = $model->where('id', $id)->first();
            } catch (\Exception $e) {
                return ['error' => $e->getMessage(), 'code' => 500];
            }
        }

        if (!isset($data['user_id']) || empty($data['user_id'] || $action !== 'PUT')) {
            $this->erros['error-users'] = "Informe o Aluno para criar o Formulário de Avaliação Física!";
        } else if ($registration === null) {
            $this->erros['error-users'] = "O Aluno ainda não possui Matrícula!";
        } else if ($physicalEvaluationForm !== null && $action !== 'PUT') {
            $this->erros['error-users'] = "O Formulário de Avaliação Física para o Aluno ".$registration->user->name." já existe!";
        } else if ($pef === null || !is_numeric($id) && $action === 'PUT') {
            $this->erros['error-users'] = "Formulário de Avaliação Física não Localizado!";
        } else if (!isset($data['instructor_id']) || empty($data['instructor_id'])) {
            $this->erros['error-users'] = "Informe o Instrutor Responsável pela Avaliação Física!";
        } else if ($user === null || !is_numeric($data['instructor_id'])) {
            $this->erros['error-users'] = "Instrutor Responsável pela Avaliação Física não Localizado!";
        } else {

            if (!isset($data['valuation']) || empty($data['valuation'])) {
                $this->erros['error-valuation'] = "Informe a Data da Avaliação Física!";
            } else if (!Helpers::ValidaData($data['valuation'])) {
                $this->erros['error-valuation'] = "A Avaliação Física é inválida!";
            } else if (!isset($data['objective']) || empty($data['objective'])) {
                $this->erros['error-objective'] = "Informe o Objetivo da Avaliação Física!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['objective'])) {
                $this->erros['error-objective'] = "O Objetivo da Avaliação Física não pode conter número(s)!";
            } elseif (!isset($data['activity']) || empty($data['activity'])) {
                $this->erros['error-activity'] = "Informe a Atividade desejada a praticar!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['activity'])) {
                $this->erros['error-activity'] = "A Atividade desejada a praticar não pode conter número(s)!";
            } else if (!isset($data['pathologies']) || empty($data['pathologies'])) {
                $this->erros['error-pathologies'] = "Caso possua Patologia(s) informe-a(s), caso não possua informe Nenhuma!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['pathologies'])) {
                $this->erros['error-pathologies'] = "A(s) Patologia(s) informada(s) não pode conter número(s)!";
            } else if (!isset($data['injuries_surgeries']) || empty($data['injuries_surgeries'])) {
                $this->erros['error-injuries-surgeries'] = "Caso já tenha feito algum tipo de Cirugia informe-a, caso não possua informe Nenhuma!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['injuries_surgeries'])) {
                $this->erros['error-injuries-surgeries'] = "O campo Cirugia não pode conter número(s)!";
            } else if (!isset($data['controlled_medication']) || empty($data['controlled_medication'])) {
                $this->erros['error-controlled-medication'] = "Caso faça o uso de alguma medicação controlada informe-a(s), caso não use informe Nenhuma!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['controlled_medication'])) {
                $this->erros['error-controlled-medication'] = "O campo de Medicação Controlada não pode conter número(s)!";
            } else if (!isset($data['smoking']) || empty($data['smoking'])) {
                $this->erros['error-smoking'] = "Você é Fumante?!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['smoking'])) {
                $this->erros['error-smoking'] = "O campo Fumante não pode conter número(s)!";
            } else if (!isset($data['alcoholic_beverage']) || empty($data['alcoholic_beverage'])) {
                $this->erros['error-alcoholic-beverage'] = "Você consome Bebida Alcoólica?!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['alcoholic_beverage'])) {
                $this->erros['error-alcoholic-beverage'] = "O campo Bebida Alcoólica não pode conter número(s)!";
            } else if (!isset($data['weight']) || empty($data['weight'])) {
                $this->erros['error-weight'] = "Qual é o seu peso?!";
            } else if (!is_numeric($data['weight'])) {
                $this->erros['error-weight'] = "O campo referente ao Peso não pode conter letras!";
            } else if (!isset($data['height']) || empty($data['height'])) {
                $this->erros['error-height'] = "Qual é a sua Altura?!";
            } else if (!is_numeric($data['height'])) {
                $this->erros['error-height'] = "O campo referente a Altura não pode conter letras!";
            } elseif (!isset($data['chest']) || empty($data['chest'])) {
                $this->erros['error-chest'] = "Qual é a medida do Peitoral?";
            } else if (!is_numeric($data['chest'])) {
                $this->erros['error-chest'] = "O campo referente a medida do Peitoral não pode conter letras!";
            } else if (!isset($data['waist']) || empty($data['waist'])) {
                $this->erros['error-waist'] = "Qual é a medida do Cintura?";
            } else if (!is_numeric($data['waist'])) {
                $this->erros['error-waist'] = "O campo referente a medida da Cintura não pode conter letras!";
            } else if (!isset($data['left_arm']) || empty($data['left_arm'])) {
                $this->erros['error-left-arm'] = "Qual é a medida do Braço Esquerdo?";
            } else if (!is_numeric($data['left_arm'])) {
                $this->erros['error-left-arm'] = "O campo referente a medida do Braço Esquerdo não pode conter letras!";
            } else if (!isset($data['right_arm']) || empty($data['right_arm'])) {
                $this->erros['error-right-arm'] = "Qual é a medida do Braço Direito?";
            } else if (!is_numeric($data['right_arm'])) {
                $this->erros['error-right-arm'] = "O campo referente a medida do Braço Direito não pode conter letras!";
            } else if (!isset($data['left_leg']) || empty($data['left_leg'])) {
                $this->erros['error-left-leg'] = "Qual é a medida da Perna Esquerda?";
            } else if (!is_numeric($data['left_leg'])) {
                $this->erros['error-left-leg'] = "O campo referente a medida da Perna Esquerda não pode conter letras!";
            } else if (!isset($data['right_leg']) || empty($data['right_leg'])) {
                $this->erros['error-right-leg'] = "Qual é a medida da Perna Direita?";
            } else if (!is_numeric($data['right_leg'])) {
                $this->erros['error-right-leg'] = "O campo referente a medida da Perna Direita não pode conter letras!";
            } else if (!isset($data['instructor_id']) || empty($data['instructor_id'])) {
                $this->erros['error-instructor'] = "Informe o Instrutor responsável pela Avaliação Física!";
            }

        }

        return $this->erros;
    }

    public function validateIdPhysicalEvaluationForm($id, $model)
    {
        $physicalEvaluationForm = $model->where('id', $id)->first();

        if (!is_numeric($id) || $physicalEvaluationForm === null) {
            $this->erros['error-physical-evaluation-form'] = "Formulário de Avaliação Física não Encontrado!";
        }

        return $this->erros;
    }

}
