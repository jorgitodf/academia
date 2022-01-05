<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TypeUser;

class TypeUserController extends Controller
{
    private $ypeUser;

    public function __construct(TypeUser $ypeUser)
    {
        $this->ypeUser = $ypeUser;
    }

    public function index()
    {
        $ypeUser = $this->ypeUser->paginate('10');
		return response()->json($ypeUser, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
