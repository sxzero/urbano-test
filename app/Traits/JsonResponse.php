<?php

namespace App\Traits;

trait JsonResponse
{

    public function jsonSuccessResponse($data, $code = 200)
    {
        header('Content-Type: application/json', true, $code);

        $response = [
            "success" => true,
            "code" => $code,
            "data" => $data
        ];

        echo json_encode($response);
        exit();
    }

    public function jsonErrorResponse($message, $code)
    {
        header('Content-Type: application/json', true, $code);

        $response = [
            "success" => false,
            "code" => $code,
            "message" => $message
        ];

        echo json_encode($response);
        exit();
    }
}
