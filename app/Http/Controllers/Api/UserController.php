<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Validations\ValidationUser;
use App\Helpers\Helpers;

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

        $erros = $this->validationUser->validateUser($data, $this->user, null, $photo);

        if ($erros) {
            return response()->json(['errors' => $erros], 400);
        }

        try {

            $data['registration'] = mt_rand(10000,99999) . Helpers::getAno();
            $data['password'] = bcrypt($data['password']);

            $imagesUploaded = [];
            $path = $photo->store('images', 'public');
            $imagesUploaded[] = ['photo' => $path];

            $data['photo'] = $path;

            $user = $this->user->create($data);
            $user->phone()->create(['fixed' => $data['fixed'], 'mobile' => $data['mobile'], 'user_id' => $data['type_users_id']]);

            return response()->json(['data' => ['msg' => 'Usuário Cadastrado com Sucesso!']], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
