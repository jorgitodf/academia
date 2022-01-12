<?php

namespace App\Validations;

use App\Helpers\Helpers;

class ValidationUser
{
    private $erros = [];

    public function validateUser($data, $model = null, $action = null, $photo = null, $id = null)
    {

        if ($id !== null) {
            $user = $model->find($id);
            if ($user === null || !is_numeric($id)) {
                $this->erros['error-user'] = "Usuário não Encontrado!";
            } 
        } 
        
        try {
            $email = $model->where('email', $data['email'])->first();
            $cpf = $model->where('cpf', Helpers::limpaCPF($data['cpf']))->first();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage(), 'code' => 500];
        }

        if (!isset($data['cpf']) || empty($data['cpf'])) {
            $this->erros['error-cpf'] = "Informe o CPF do Usuário!";
        } else if (!Helpers::validaCPF($data['cpf'])) {
            $this->erros['error-cpf'] = "O CPF informado é inválido!";
        } else if ($cpf !== null && $cpf->cpf === Helpers::limpaCPF($data['cpf']) && $action !== 'PUT') {
            $this->erros['error-cpf'] = "O CPF informado já está cadastrado!";
        } else if (!isset($data['email']) || empty($data['email'])) {
            $this->erros['error-email'] = "Informe o E-mail do Usuário!";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->erros['error-email'] = "Informe um E-mail válido!";
        } else if ($email !== null && $email->email === $data['email'] && $action !== 'PUT') {
            $this->erros['error-email'] = "O E-mail informado já está cadastrado!";
        } else {

            if (!isset($data['name']) || empty($data['name'])) {
                $this->erros['error-name'] = "Informe o Nome do Usuário!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['name'])) {
                $this->erros['error-name'] = "O Campo Nome do Usuário não pode conter número(s)!";
            } else if (strlen($data['name']) <= 7) {
                $this->erros['error-name'] = "Infome o Nome e o SobreNome do Usuário!";
            }

            if (!isset($data['birth_date']) || empty($data['birth_date'])) {
                $this->erros['error-birth-date'] = "Informe a Data de Nascimento!";
            } else if (!Helpers::ValidaData($data['birth_date'])) {
                $this->erros['error-birth-date'] = "A Data de Nascimento é inválida!";
            }

            if (!isset($data['profession']) || empty($data['profession'])) {
                $this->erros['error-profession'] = "Informe a Profissão!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['name'])) {
                $this->erros['error-profession'] = "A Campo Profissão não pode conter número(s)!";
            }

            if (!isset($data['gender']) || empty($data['gender'])) {
                $this->erros['error-gender'] = "Informe o Sexo!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['gender'])) {
                $this->erros['error-profession'] = "O Campo Sexo não pode conter número(s)!";
            }

            if ($photo === null) {
                $this->erros['error-photo'] = "Selecione a Foto!";
            } else if ($photo->getClientSize() > 23068672) {
                $this->erros['error-photo'] = "Tamanho da Foto Excede o Limite de 22 MB!";
            } else if (array_search($photo->extension(), array('bmp' ,'png', 'svg', 'jpeg', 'jpg')) === false) {
                $this->erros['error-photo'] = "Foto Somente png, svg, jpg, pdf, jpeg!";
            }

            if (!isset($data['password']) || empty($data['password'])) {
                $this->erros['error-password'] = "Informe uma Senha!";
            } else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $data['password'])) {
                $this->erros['error-password'] = 'A Senha de deve conter pelo menos um número, uma letra, um caracter especial e entre 8 e 12 Dígitos!';
            }

            if (!isset($data['fixed']) || empty($data['fixed'])) {
                $this->erros['error-phone'] = "Informe o Telefone!";
            } else if (!Helpers::validarTelefoneCelularEFixo($data['fixed'])) {
                $this->erros['error-phone'] = "O Telefone informado é inválido!";
            }

            if (!isset($data['mobile']) || empty($data['mobile'])) {
                $this->erros['error-mobile'] = "Informe o Celular!";
            } else if (!Helpers::validarTelefoneCelularEFixo($data['mobile'])) {
                $this->erros['error-mobile'] = "O Telefone informado é inválido!";
            }

            if (!isset($data['type_user_id']) || empty($data['type_user_id'])) {
                $this->erros['error-type-user'] = "Informe o Tipo do Usuário!";
            }

            if (!isset($data['public_place_id']) || empty($data['public_place_id'])) {
                $this->erros['error-public-places'] = "Informe o Logradouro do Endereço!";
            } else if (!is_numeric($data['public_place_id'])) {
                $this->erros['error-public-places'] = "Erro no Logradouro do Endereço!";
            }

            if (!isset($data['description']) || empty($data['description'])) {
                $this->erros['error-description'] = "Informe o Endereço!";
            }

            if (!isset($data['complement']) || empty($data['complement'])) {
                $this->erros['error-complement'] = "Informe o Complemento do Endereço!";
            }

            if (!isset($data['number']) || empty($data['number'])) {
                $this->erros['error-number'] = "Informe o Número do Endereço!";
            }

            if (!isset($data['zip_code']) || empty($data['zip_code'])) {
                $this->erros['error-zip-code'] = "Informe o CEP do Endereço!";
            } else if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $data['zip_code'])) {
                $this->erros['error-zip-code'] = "O CEP informado é inválido!";
            }

            if (!isset($data['neighborhoods']) || empty($data['neighborhoods'])) {
                $this->erros['error-neighborhoods'] = "Informe o Bairro do Endereço!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['neighborhoods'])) {
                $this->erros['error-neighborhoods'] = "O Campo Bairro não pode conter número(s)!";
            }

            if (!isset($data['cities']) || empty($data['cities'])) {
                $this->erros['error-cities'] = "Informe a Cidade!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['cities'])) {
                $this->erros['error-cities'] = "O Campo Cidade não pode conter número(s)!";
            }
            
            if (!isset($data['states']) || empty($data['states'])) {
                $this->erros['error-states'] = "Informe a UF!";
            } else if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['states'])) {
                $this->erros['error-states'] = "O Campo UF não pode conter número(s)!";
            } else if (strlen($data['states'] > 2)) {
                $this->erros['error-states'] = "O Campo UF deve conter apenas a Sigla!";
            }

        }

        return $this->erros;
    }

    public function validateIdUser($id, $model)
    {
        $user = $model->where('id', $id)->first();

        if (!is_numeric($id) || $user === null) {
            $this->erros['error-id'] = "Usuário não Encontrado!";
        }

        return $this->erros;
    }

}
