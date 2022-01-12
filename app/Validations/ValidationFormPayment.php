<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationFormPayment
{
    private $erros = [];

    public function validateFormPayment($data, $model = null, $action = null, $id = null)
    {
        if ($id !== null) {
            $paymentMethodId = $model->find($id);
            if ($paymentMethodId === null || !is_numeric($id)) {
                $this->erros['error-payment-method'] = "Forma de Pagamento não Encontrada!";
            }
        }

        try {
            $paymentMethod = $model->where('payment_method', $data['payment_method'])->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if (!isset($data['payment_method']) || empty($data['payment_method'])) {
            $this->erros['error-payment-method'] = "Informe a Forma de Pagamento!";
        } else if ($paymentMethod !== null && $paymentMethod->payment_method === $data['payment_method'] && $action !== 'PUT') {
            $this->erros['error-payment-method'] = "A Forma de Pagamento informada já está cadastrada!";
        } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['payment_method'])) {
            $this->erros['error-payment-method'] = "A Forma de Pagamento não pode conter número(s)!";
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
