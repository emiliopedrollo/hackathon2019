<?php

namespace App\Http\Controllers;

use App\Facades\HttpStatusCode;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data
     * @param $statusCode
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respond($data, $statusCode, $headers = [])
    {
        $headers['Access-Control-Allow-Origin'] = '*';
        return new JsonResponse($data, $statusCode, $headers);
    }

    public static function respondData($data, $statusCode = Response::HTTP_OK, $headers = [])
    {
        return static::respond([
            'data' => $data
        ], $statusCode, $headers);
    }

    public static function respondSuccess($message, $statusCode = Response::HTTP_OK, $headers = [])
    {
        return static::respond([
            'messages' => [
                [
                    'message' => $message ?: HttpStatusCode::getText($statusCode),
                    'type' => 'success'
                ]
            ]
        ], $statusCode, $headers);
    }

    /**
     * @param $message
     * @param int $statusCode
     * @param array $extra
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondWithError($message = null, $statusCode = 500, $extra = [])
    {

        $error = [
            'messages' => [
                [
                    'message' => $message ?: HttpStatusCode::getText($statusCode),
                    'type' => 'error',
                ],
            ],
            'message_code' => HttpStatusCode::getMessageCode($statusCode),
            'status_code' => $statusCode
        ];

        $error = array_merge_recursive($error, $extra ?: []);

        $headers = $extra['headers'] ?? [];

        unset($extra['headers']);

        return static::respond(['error' => $error], $statusCode, $headers);
    }
}
