<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Validations\ValidationUser;
use App\Helpers\Helpers;
use App\Model\Adress;

class UserController extends Controller
{
    private $user;
    private $validationUser;

    public function __construct(User $user, ValidationUser $validationUser)
    {
        $this->user = $user;
        $this->validationUser = $validationUser;
    }

    public function index()
    {
        $user = $this->user->paginate('10');

        if ($user->count() > 0) {
            return response()->json($user, 200);
        }

		return response()->json(['error' => ['message' => 'Nenhum Registro de Usuário Encontrado!']], 404);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $photo = $request->file('photo');

        $erros = $this->validationUser->validateUser($data, $this->user, null, $photo, null, null);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $data['password'] = bcrypt($data['password']);

            $imagesUploaded = [];
            $path = $photo->store('images', 'public');
            $imagesUploaded[] = ['photo' => $path];

            $data['photo'] = $path;

            $user = $this->user->create($data);
            $user->phone()->create(['fixed' => $data['fixed'], 'mobile' => $data['mobile']]);
            $user->adress()->create(['description' => $data['description'], 'complement' => $data['complement'],
                'number' => $data['number'], 'zip_code' => $data['zip_code'], 'neighborhoods' => $data['neighborhoods'],
                'public_place_id' => $data['public_place_id'], 'cities' => $data['cities'], 'states' => $data['states']]);

            return response()->json(['data' => ['msg' => 'Usuário Cadastrado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        $erros = $this->validationUser->validateIdUser($id, $this->user);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $user = $this->user->with('type_user')->with('phone')->findOrFail($id);
            $adress = new Adress();
            $adr = $adress->with('public_place')->findOrFail($id);

            return response()->json(['user' => $user, 'adress' => $adr], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $photo = $request->file('photo');

        $erros = $this->validationUser->validateUser($data, $this->user, null, $photo, $id, 'PUT');

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $data['password'] = bcrypt($data['password']);

            $imagesUploaded = [];
            $path = $photo->store('images', 'public');
            $imagesUploaded[] = ['photo' => $path];

            $data['photo'] = $path;

            $user = $this->user->findOrFail($id);
            $user->update($data);

            $phones = $user->phone()->where('user_id', $user->id);
            $phones->update(['fixed' => trim(Helpers::limpaTelefone($data['fixed'])), 'mobile' => trim(Helpers::limpaTelefone($data['mobile']))]);

            $adress = $user->adress()->where('user_id', $user->id);
            $adress->update(
                ['description' => trim(mb_convert_case($data['description'], MB_CASE_TITLE, "UTF-8")),
                'complement' => trim(mb_convert_case($data['complement'], MB_CASE_TITLE, "UTF-8")),
                'number' => trim($data['number']), 'zip_code' => trim(Helpers::limpaCEP($data['zip_code'])),
                'neighborhoods' => trim(mb_convert_case($data['neighborhoods'], MB_CASE_TITLE, "UTF-8")),
                'public_place_id' => $data['public_place_id'], 'cities' => trim(mb_convert_case($data['cities'], MB_CASE_TITLE, "UTF-8")),
                'states' => trim(strtoupper($data['states']))
            ]);

            return response()->json(['data' => ['msg' => 'Dados do Usuário Atualizado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
