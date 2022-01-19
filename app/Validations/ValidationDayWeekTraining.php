<?php

namespace App\Validations;

class ValidationDayWeekTraining
{
    private $erros = [];

    public function validateDayWeekTraining($data, $model = null, $trainingSheetModel = null)
    {
        try {
            $dayWeekTraining = $model->where('day_week', $data['day_week'])->where('training_sheets_id', $data['training_sheets_id'])->first();
            $trainingSheet = $trainingSheetModel->where('id', $data['training_sheets_id'])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        $dias = array("Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado", "Domingo");

        if (!isset($data['day_week']) || empty($data['day_week'])) {
            $this->erros['error-day-week'] = "Informe o Dia do Treino!";
        } else if (!in_array($data['day_week'], $dias)) {
            $this->erros['error-day-week'] = "O Dia do Treino é inválido!";
        } else if ($trainingSheet === null) {
            $this->erros['error-day-week'] = "Ficha de Treinamento não Localizada!";
        } else if ($dayWeekTraining !== null) {
            $this->erros['error-day-week'] = "O treino para " . $dayWeekTraining->day_week . " já foi criado!";
        } else {

            if (!isset($data['training_sheets_id']) || empty($data['training_sheets_id'])) {
                $this->erros['error-straining-sheet'] = "Informe a Ficha de Treinamento!";
            } else if (!is_numeric($data['training_sheets_id'])) {
                $this->erros['error-straining-sheet'] = "Ficha de Treinamento não Localizada!";
            }

        }

        return $this->erros;
    }

    public function validateDayWeekExercises($data, $model = null, $exerciseModel = null)
    {
        try {
            $dayWeekTraining = $model->with('exercises')->find($data['day_week_training_id']);
            $exercise = $exerciseModel->where('id', $data['exercises'][0])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if (!isset($data['day_week_training_id']) || empty($data['day_week_training_id'])) {
            return $this->erros['error-exercise'] = "Informe o Dia do Treino!";
        } else if ($dayWeekTraining === null || !is_numeric($data['day_week_training_id'])) {
            return $this->erros['error-exercise'] = "Dia do Treino não Localizado!";
        } else if (is_numeric($data['day_week_training_id']) === false) {
            return $this->erros['error-exercise'] = "Dia do Treino não Localizado!";
        } else if (!isset($data['exercises'][0]) || empty($data['exercises'][0])) {
            return $this->erros['error-exercise'] = "Informe o Exercício para o Treino!";
        } else if ($exercise === null || !is_numeric($data['exercises'][0])) {
            return $this->erros['error-exercise'] = "Exercício não Localizado!";
        } else if ($data['treinos']['series'] === null | empty($data['treinos']['series'])) {
            return $this->erros['error-exercise'] = "Informe a Quantidade de Série(s) do Exercício!";
        } else if ($data['treinos']['repetition'] === null | empty($data['treinos']['repetition'])) {
            return $this->erros['error-exercise'] = "Informe a Quantidade de Repetições do Exercício!";
        } else if ($data['treinos']['charge'] === null | empty($data['treinos']['charge'])) {
            return $this->erros['error-exercise'] = "Informe a Quantidade de Carga para o Exercício!";
        }

        $array[] = $dayWeekTraining->exercises;

        foreach ($array as $key => $value) {
            foreach ($value as $row) {
                if ($data['exercises'][0] == $row['id']) {
                    return $this->erros['error-exercise'] = "O Exercício ".$row['name']." já está cadastrado!";
                }
            }
        }

        return $this->erros;
    }

    public function validateIdDayWeekTraining($id, $model)
    {
        $user = $model->where('id', $id)->first();

        if (!is_numeric($id) || $user === null) {
            $this->erros['error-id'] = "Ficha de Treinamento não Localizada!";
        }

        return $this->erros;
    }

}
