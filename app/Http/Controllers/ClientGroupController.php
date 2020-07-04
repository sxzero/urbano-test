<?php

namespace App\Http\Controllers;

use App\ClientGroup;
use App\Traits\JsonResponse;
use App\Traits\XmlResponse;
use Rakit\Validation\Validator;

class ClientGroupController extends Controller
{
    use JsonResponse;
    use XmlResponse;

    protected $validator;
    protected $client_group;

    public function __construct($format = 'json')
    {
        $this->validator = new Validator;
        $this->client_group = new ClientGroup;

        $this->response_format = $format == 'xml'
            ? 'xml'
            : 'json';
    }

    /**
     * List all Client Groups
     *
     * @return object
     */
    public function index()
    {
        try {
            $client_group = $this->client_group->all();

            return $this->responseFormat($client_group, 200, 'Client Groups');
        } catch (\Throwable $th) {
            return $this->jsonerrorResponse($th->getMessage(), 500);
        }
    }

    /**
     * Get the request Client Group.
     *
     * @param int $id
     * @return object
     */
    public function get($id)
    {
        try {
            $client_group = $this->client_group->find($id);

            if (empty($client_group)){
                return $this->jsonErrorResponse('The client group does not exists', 404);
            }
            
            return $this->responseFormat($client_group, 200, 'Client Group');

        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(), 500);
        }
    }

    /**
     * Create a new Client Group
     *
     * @param \Klein\Request $request
     * @return object
     */
    public function store($request)
    {
        try {
            $data = [
                'name' => $request->group_name,
            ];
    
            $rules = [
                'name' => 'required',
            ];
    
            $validate = $this->validator->validate($data, $rules);
            if ($validate->fails()) {
                $errors = $validate->errors();
    
                return $this->jsonErrorResponse($errors->firstOfAll(), 422);
            }

            $client_group = new ClientGroup();
            if (!empty($client_group->whereName($data['name'])->first())){
                return $this->jsonErrorResponse('This client group already exists', 422);
            }

            $client_group->fill($data);
            $client_group->save();

            return $this->responseFormat($client_group, 201, 'Client Group');
            
        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(),500);
        }
    }

    /**
     * Update a Client Group.
     *
     * @param int $id
     * @param \Klein\Request $request
     * @return object
     */
    public function update($id, $request)
    {
        try {
            $data = [
                'name' => $request->group_name,
            ];
    
            $rules = [
                'name' => 'required',
            ];
    
            $validate = $this->validator->validate($data, $rules);
            if ($validate->fails()) {
                $errors = $validate->errors();
    
                return $this->jsonErrorResponse($errors->firstOfAll(), 422);
            }

            $client_group = $this->client_group->find($id);
            if (empty($client_group)){
                return $this->jsonErrorResponse('The client group does not exists', 400);
            }

            if (!empty($client_group->whereName($data['name'])->first())){
                return $this->jsonErrorResponse('This client group already exists', 422);
            }

            $client_group->fill($data);
            $client_group->save();

            return $this->responseFormat($client_group, 200, 'Client Group');
            
        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(),500);
        }
    }

    /**
     * Delete a Client Group
     *
     * @param int $id
     * @return object
     */
    public function destroy($id)
    {
        try {
            $client_group = $this->client_group->find($id);

            if (empty($client_group)){
                return $this->jsonErrorResponse('The client group does not exists', 404);
            }

            $client_group->delete();
            
            return $this->responseFormat($client_group, 200, 'Client Group');
            
        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(),500);
        }
    }
}
