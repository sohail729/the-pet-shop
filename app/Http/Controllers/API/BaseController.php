<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @param int $status
     * @param string $message
     * @param array $data
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($status = 200, $message = null, $data = [], $errors = [])
    {
        $response = [
            'status' => $status,
            'message' => $message
        ];

        if (null != $data || null != $errors) {
            $response['response'] =  [
                'data'      => $data,
                'errors'    => $errors
            ];
        }

        return response()->json($response);
    }
}
