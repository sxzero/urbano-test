<?php

namespace App\Http\Controllers;

use App\Client;
use App\Traits\JsonResponse;
use App\Traits\XmlResponse;
use Rakit\Validation\Validator;

class ClientController extends Controller
{
    use JsonResponse;
    use XmlResponse;

    protected $validator;
    protected $client;

    public function __construct($format = 'json')
    {
        $this->validator = new Validator;
        $this->client = new Client;

        $this->response_format = $format == 'xml'
            ? 'xml'
            : 'json';
    }

    /**
     * List all Clients.
     *
     * @return object
     */
    public function index()
    {
        try {
            $clients = $this->client->with('client_group')->get();

            return $this->responseFormat($clients, 200, 'Clients');
        } catch (\Throwable $th) {
            return $this->jsonerrorResponse($th->getMessage(), 500);
        }
    }

    /**
     * Get an existing Client
     *
     * @param int $id
     * @return object
     */
    public function get($id)
    {
        try {
            $client = $this->client->with('client_group')->find($id);

            if (empty($client)){
                return $this->jsonErrorResponse('The client does not exists', 404);
            }

            return $this->responseFormat($client, 200, 'Client');

        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(), 500);
        }
    }

    /**
     * Return all results from query
     *
     * @param \Klein\Request $request
     * @return object
     */
    public function filter($request)
    {
        try {
            $params = array_filter([
                'name' => $request->client_search_name,
                'lastname' => $request->client_search_lastname,
                'email' => $request->client_search_email,
                'client_group_id' => $request->client_search_group_id,
            ]);

            $clients = ($this->client->with('client_group')->where($params)->get())->toArray();
            
            if (empty($clients)){
                return $this->jsonErrorResponse('Not found results', 404);
            }
            
            return $this->responseFormat($clients, 200, 'Clients');

        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(), 500);
        }
    }

    /**
     * Create a new Client
     *
     * @param \Klein\Request $request
     * @return object
     */
    public function store($request)
    {
        try {
            $data = [
                'name' => $request->client_name,
                'lastname' => $request->client_lastname,
                'email' => $request->client_email,
                'client_group_id' => $request->client_group_id,
                'notes' => $request->client_notes
            ];
    
            $rules = [
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'client_group_id' => 'required|numeric|min:1'
            ];
    
            $validate = $this->validator->validate($data, $rules);
            if ($validate->fails()) {
                $errors = $validate->errors();
    
                return $this->jsonErrorResponse($errors->firstOfAll(), 422);
            }

            $client = new Client();
            if (!empty($client->whereEmail($data['email'])->first())){
                return $this->jsonErrorResponse('This email is already register', 422);
            }

            $client_group = new \App\ClientGroup();
            if (empty($client_group->find($data['client_group_id']))){
                return $this->jsonErrorResponse('The client group is not valid', 400);
            }

            $client->fill($data);
            $client->save();

            return $this->responseFormat($client, 201, 'Client');
            
        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(),500);
        }
    }

    /**
     * Update an existing Client
     *
     * @param int $id
     * @param \Klein\Request $request
     * @return object
     */
    public function update($id, $request)
    {
        try {
            $data = [
                'name' => $request->client_name,
                'lastname' => $request->client_lastname,
                'email' => $request->client_email,
                'client_group_id' => $request->client_group_id,
                'notes' => $request->client_notes
            ];
    
            $rules = [
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'client_group_id' => 'required|numeric|min:1'
            ];
    
            $validate = $this->validator->validate($data, $rules);
            if ($validate->fails()) {
                $errors = $validate->errors();
    
                return $this->jsonErrorResponse($errors->firstOfAll(), 422);
            }

            $client = $this->client->find($id);
            if (empty($client)){
                return $this->jsonErrorResponse('The client does not exists', 400);
            }

            if ($client->email != $data['email']) {
                if (!empty($client->whereEmail($data['email'])->first())){
                    return $this->jsonErrorResponse('This client already exists', 422);
                }
            }

            $client_group = new \App\ClientGroup();
            if (empty($client_group->find($data['client_group_id']))){
                return $this->jsonErrorResponse('The client group is not valid', 400);
            }

            $client->fill($data);
            $client->save();

            return $this->responseFormat($client, 200, 'Client');
            
        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(),500);
        }
    }

    /**
     * Delete a Client
     *
     * @param int $id
     * @return object
     */
    public function destroy($id)
    {
        try {
            $client = $this->client->find($id);

            if (empty($client)){
                return $this->jsonErrorResponse('The client does not exists', 404);
            }

            $client->delete();
            
            return $this->responseFormat($client, 200, 'Client');
            
        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(),500);
        }
    }
}
