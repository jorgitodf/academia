<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FormPayment;
use App\Validations\ValidationFormPayment;
use App\Helpers\Helpers;

class FormPaymentController extends Controller
{
    private $formPayment;
    private $validationFormPayment;

    public function __construct(FormPayment $formPayment, ValidationFormPayment $validationFormPayment)
    {
        $this->formPayment = $formPayment;
        $this->validationFormPayment = $validationFormPayment;
    }

    public function index()
    {
        $formPayment = $this->formPayment->paginate('10');

        if ($formPayment->count() > 0) {
            return response()->json($formPayment, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhuma Forma de Pagamento Encontrada!']], 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $erros = $this->validationFormPayment->validateFormPayment($data, $this->formPayment, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $fp = $this->formPayment->create($data);
            return response()->json(['data' => ['msg' => 'Forma de Pagamento Cadastrado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
