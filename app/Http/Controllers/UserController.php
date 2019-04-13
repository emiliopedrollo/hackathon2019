<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithUserIdentificationToken;
use App\User;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    public function create(Request $request) {

        $data = $request->post('data');

        $user = User::whereIdentificationToken($data['identification_token'])
            ->firstOrNew($data);

        $user->update($data);

        $user->save();

        return JsonResource::make($user);
    }

    public function identify(WithUserIdentificationToken $request) {

        $response = new \Illuminate\Http\Response();


        $response->header('Content-Type','image/png');

        $options = (new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG
        ]));

        $user = $request->getAuthUser();

        list($type, $data) = explode(';', (new QRCode($options))->render($user->identification_token));
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);


        $response->setContent($data);
        return $response;


    }

}
