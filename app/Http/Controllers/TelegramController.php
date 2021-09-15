<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserTelegram;
use App\Helpers\FunctionHelper;

class TelegramController extends Controller
{
    public function assign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:rfc,dns', 'exists:users,email'],
            'chat_id' => ['required', 'unique:user_telegrams,chat_id'],
            'lat' => ['required', 'string'],
            'lon' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return FunctionHelper::errorResponse($validator, true);
        }

        $user = User::where('email', $request->email)->first();
        $user->addTelegram(
            $request->chat_id,
            $request->lat,
            $request->lon
        );

        $user = User::with(['devices', 'telegrams'])
                    ->where('email', $request->email)->first();
        return FunctionHelper::response(true, "", [
            'user' => $user,
            'devices' => $user->device_ids,
            'telegram' => $user->telegrams
        ]);
    }

    public function getDevices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:user_telegrams,chat_id']
        ]);

        if ($validator->fails()) {
            return FunctionHelper::errorResponse($validator, true);
        }

        $userTelegram = UserTelegram::with('user')
                                    ->where('chat_id', $request->id)
                                    ->first();

        return FunctionHelper::response(true, "", [
            'user' => $userTelegram->user,
            'devices' => $userTelegram->user->device_ids,
            'telegram' => $userTelegram
        ]);
    }
}
