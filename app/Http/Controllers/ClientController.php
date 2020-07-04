<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientGroup;
use App\Traits\JsonResponse;
use Rakit\Validation\Validator;

class ClientController
{
    use JsonResponse;

    protected $validator;

    public function __construct()
    {
        $this->validator = new Validator;
    }

    /**
     * List all Clients
     *
     * @return object
     */
    public function index()
    {
        $clients = new Client();

        return $clients->all();
    }

    public function get($id)
    {
        # code...
    }

    /**
     * New Client
     *
     * @param object $request
     * @return object
     */
    public function store($request)
    {

        try {
            $data = [
                'name' => $request->client_name,
                'lastname' => $request->client_lastname,
                'email' => $request->client_email,
                'client_group' => $request->client_group,
                'notes' => $request->client_notes
            ];
    
            $rules = [
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'client_group' => 'required|numeric|min:1'
            ];
    
            $validate = $this->validator->validate($data, $rules);
            if ($validate->fails()) {
                $errors = $validate->errors();
    
                return $this->errorResponse($errors->firstOfAll(), 422);
            }

            $client = new Client();
            if (!empty($client->whereEmail($data['email'])->first())){
                return $this->errorResponse('This email is already register', 422);
            }

            $client_group = new ClientGroup();
            if (empty($client_group->find($data['client_group']))){
                return $this->errorResponse('The client group is not valid', 400);
            }

            $client->fill($data);
            $client->save();

            return $this->successResponse(
                $client,
                201
            );
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),500);
        }
    }

    public function update($id, $request)
    {
        # code...
    }
}
