<?php

namespace App\Http\Controllers;

use App\Facades\HttpStatusCode;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondNotFound($message = null)
    {
        $message = $message ?: __('messages.errors.not_found');
        $code = Response::HTTP_NOT_FOUND;
        return static::respondWithError($message, $code);
    }

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

    public static function respondDataFirst($data, $statusCode = Response::HTTP_OK, $headers = [])
    {
        return static::respond([
            'data' => $data[0]
        ], $statusCode, $headers);
    }


    public static function respondEditableFields($fields, $headers = [])
    {
        $code = Response::HTTP_OK;
        return static::respond([
            'data' => [
                'editable_fields' => $fields
            ]
        ], $code, $headers);
    }

    /**
     * @param LengthAwarePaginator|\Illuminate\Contracts\Pagination\LengthAwarePaginator $data
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public static function respondPaginatedData($data, $statusCode = Response::HTTP_OK, $headers = [])
    {
        $data = $data->toArray();
        return static::respond([
            'data' => $data['data'],
            'meta' => Arr::except($data, [
                'data',
                'first_page_url',
                'last_page_url',
                'prev_page_url',
                'next_page_url',
            ]),
            'links' => [
                'first' => $data['first_page_url'] ?? null,
                'last' => $data['last_page_url'] ?? null,
                'prev' => $data['prev_page_url'] ?? null,
                'next' => $data['next_page_url'] ?? null,
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
            'message' => $message ?: HttpStatusCode::getText($statusCode),
            'message_code' => HttpStatusCode::getMessageCode($statusCode),
            'status_code' => $statusCode
        ];

        $error = array_merge_recursive($error, $extra ?: []);

        $headers = $extra['headers'] ?? [];

        unset($extra['headers']);

        return static::respond(['error' => $error], $statusCode, $headers);
    }

    /**
     * @param $message
     * @param array $details
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondWithUnprocessableEntity($message = null, $details = [])
    {
        $message = $message ?: __('messages.errors.unprocessable_entity');
        $details = (empty($details) ? [] : ['details' => $details]);
        return static::respondWithError($message, Response::HTTP_UNPROCESSABLE_ENTITY, $details);
    }

    public static function respondWithConflict($message = null, $details = [])
    {
        $message = $message ?: __('messages.errors.conflict');
        $details = (empty($details) ? [] : ['details' => $details]);
        return static::respondWithError($message, Response::HTTP_CONFLICT, $details);
    }

    public static function respondWithMultipleChoices($message = null, $details = [])
    {
        $message = $message ?: __('messages.errors.multiple_choices');
        $details = (empty($details) ? [] : ['details' => $details]);
        return static::respondWithError($message, Response::HTTP_MULTIPLE_CHOICES, $details);
    }

    /**
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondWithUnauthorized($message = null)
    {
        $message = $message ?: __('messages.errors.unauthorized');
        return static::respondWithError($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondWithForbidden($message = null)
    {
        $message = $message ?: __('messages.errors.forbidden');
        return static::respondWithError($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondWithBadRequest($message = null)
    {
        $message = $message ?: __('messages.errors.bad_request');
        return static::respondWithError($message, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondMethodNotAllowed($message = null)
    {
        $message = $message ?: __('messages.errors.method_not_allowed');
        return static::respondWithError($message, Response::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * @param null $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondCreated($message = null, $data = [])
    {
        $message = $message ?: __('messages.entity_created');
        $code = Response::HTTP_CREATED;
        $response = [
            'message' => $message,
            'message_code' => HttpStatusCode::getMessageCode($code)
        ];

        if ((is_array($data) and sizeof($data) > 0) or
            ($data and !is_array($data))) {
            $response['data'] = $data;
        }

        return static::respond($response, $code);
    }

    /**
     * @param null $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondCreatedWithWarning($message = null, $data = [])
    {
        $message = $message ?: __('messages.entity_created_with_warning');
        $code = Response::HTTP_CREATED;
        return static::respond([
            'message' => $message,
            'message_code' => HttpStatusCode::getMessageCode($code),
            'data' => $data,
        ], $code);
    }

    /**
     * @param null $message
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondUpdated($message = null, $data = [])
    {
        $message = $message ?: __('messages.entity_updated');
        $code = Response::HTTP_OK;
        return static::respond([
            'message' => $message,
            'message_code' => HttpStatusCode::getMessageCode($code),
            'data' => $data,
        ], $code);
    }

    /**
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondDeleted($message = null)
    {
        $message = $message ?: __('messages.entity_removed');
        $code = Response::HTTP_OK;
        return static::respond([
            'message' => $message,
            'message_code' => HttpStatusCode::getMessageCode($code)
        ], $code);
    }
}
