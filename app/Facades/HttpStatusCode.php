<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HttpStatusCode extends Facade {
    protected static function getFacadeAccessor() { return 'http_status_code'; }

    static function getMessageCode($code) {
        switch ($code) {
            case 100: return 'continue';
            case 101: return 'switching_protocols';

            case 200: return 'ok';
            case 201: return 'created';
            case 202: return 'accepted';
            case 203: return 'non_authoritative_information';
            case 204: return 'no_content';
            case 205: return 'reset_content';
            case 206: return 'partial_content';
            case 207: return 'multi_status';
            case 208: return 'already_reported';
            case 226: return 'im_used';

            case 300: return 'multiple_choices';
            case 301: return 'moved_permanently';
            case 302: return 'found';
            case 303: return 'see_other';
            case 304: return 'not_modified';
            case 305: return 'use_proxy';
            case 307: return 'temporary_redirect';
            case 308: return 'permanent_redirect';

            case 400: return 'bad_request';
            case 401: return 'unauthorized';
            case 402: return 'payment_required';
            case 403: return 'forbidden';
            case 404: return 'not_found';
            case 405: return 'method_not_allowed';
            case 406: return 'not_acceptable';
            case 407: return 'proxy_authentication_required';
            case 408: return 'request_time_out';
            case 409: return 'conflict';
            case 410: return 'gone';
            case 411: return 'length_required';
            case 412: return 'precondition_failed';
            case 413: return 'payload_too_large';
            case 414: return 'request_uri_too_large';
            case 415: return 'unsupported_media_type';
            case 416: return 'request_range_not_satisfiable';
            case 417: return 'expectation_failed';
            case 418: return 'im_a_teapot';
            case 421: return 'misdirected_request';
            case 422: return 'unprocessable_entity';
            case 423: return 'locked';
            case 424: return 'failed_dependency';
            case 426: return 'upgrade_required';
            case 428: return 'precondition_required';
            case 429: return 'too_many_requests';
            case 431: return 'request_header_fields_too_large';
            case 451: return 'unavailable_for_legal_reasons';

            case 500: return 'internal_server_error';
            case 501: return 'not_implemented';
            case 502: return 'bad_gateway';
            case 503: return 'service_unavailable';
            case 504: return 'gateway_time_out';
            case 505: return 'http_version_not_supported';
            case 506: return 'variant_also_negotiates';
            case 507: return 'insufficient_storage';
            case 508: return 'loop_detected';

            default: return 'unknown_error';
        }
    }


    static function getText($code) {
        return __("messages.errors.".static::getMessageCode($code));
    }
}