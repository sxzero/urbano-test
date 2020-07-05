<?php

namespace App\Http\Controllers;

use App\Traits\JsonResponse;
use App\Traits\XmlResponse;

class Controller
{
    use XmlResponse;
    use JsonResponse;

    public $response_format;

    /**
     * Output the selected response format
     *
     * @param \App\ClientGroup $client_group
     * @return object
     */
    protected function responseFormat($model, $code = 200, $title = 'Response'){
        try
        {
            if ($this->response_format == 'xml') {
                return $this->xmlSuccessResponse($title, $model);
            }
    
            return $this->jsonSuccessResponse($model, $code);

        } catch (\Throwable $th) {
            return $this->jsonErrorResponse($th->getMessage(), 500);
        }
    }
}
