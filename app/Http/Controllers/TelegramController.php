<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserTelegram;

class TelegramController extends Controller
{
    public function assign(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'chat_id' => ['required', 'unique:user_telegrams,chat_id'],
            'lat' => ['required', 'string'],
            'lon' => ['required', 'string']
        ]);

        $user = User::where('email', $request->email)->first();
        $user->addTelegram(
            $request->chat_id,
            $request->lat,
            $request->lon
        );

        $user = User::with(['devices', 'telegrams'])
                    ->where('email', $request->email)->first();
        return [
            'success' => true,
            'message' => '',
            'data' => [
                'user' => $user,
                'devices' => $user->device_ids,
                'telegram' => $user->telegrams
            ]
        ];
    }

    public function getDevices(Request $request)
    {
        $request->validate([
            'id' => ['required', 'unique:user_telegrams,chat_id']
        ]);

        $userTelegram = UserTelegram::with('user')
                                    ->where('chat_id', $request->id)
                                    ->first();
        return [
            'success' => true,
            'message' => '',
            'data' => [
                'user' => $userTelegram->user,
                'devices' => $userTelegram->user->device_ids,
                'telegram' => $userTelegram
            ]
        ];
    }
}
