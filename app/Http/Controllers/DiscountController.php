<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Http\Requests\RedeemDiscountRequest;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function redeem(RedeemDiscountRequest $request) {
        $user = $request->getAuthUser();

        $fields = $request->validated();

        if($user->cashback_available < $fields['discount_value']) {
            return static::respondWithError("Você ainda não possui cashback o suficiente ):");
        }

        Discount::create([
            'user_id' => $user->id,
            'value' => $fields['discount_value'],
        ]);

        $user->update([
            'cashback_available' => $user->cashback_available - $fields['discount_value'],
        ]);

        return static::respondData(['message' => "Você usou um pouquinho do cashback!"]);
    }

}
