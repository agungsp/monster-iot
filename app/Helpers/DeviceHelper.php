<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use function PHPUnit\Framework\throwException;

class DeviceHelper {

    /**
     * Get accessible uuid device
     *
     * Get accessible encoded uuid device with encrypted user id
     *
     * @param string $enUserId Encrypted user id
     * @return string
     **/
    public static function getUuids($enUserId)
    {
        $separator = ';';
        $userId = null;
        try {
            $userId = Crypt::decryptString($enUserId);
        } catch (DecryptException $e) {
            return throwException($e);
        }
        $user = User::find($userId);
        $devices = collect($user->device_uuids);
        $encoded = $devices->join(';') . '.' . static::encode($devices->join(';'));
        return $encoded;
    }

    /**
     * Encode string
     *
     * Encode string with own method
     *
     * @param string $text Text to be encoded
     * @return string
     **/
    public static function encode($text)
    {
        $encoded = base64_encode($text);
        $encoded = strrev($encoded);
        $encoded = static::reverseCase($encoded);
        return $encoded;
    }

    /**
     * Decode string
     *
     * Decode string with own method
     *
     * @param string $encodedText Encoded text to be decoded
     * @return string
     **/
    public static function decode($encodedText)
    {
        $decoded = static::reverseCase($encodedText);
        $decoded = strrev($decoded);
        $decoded = base64_decode($decoded);
        return $decoded;
    }

    /**
     * Validate encoded uuid with signature
     *
     * @param string $encodedText Encoded text to be validate
     * @return bool
     **/
    public static function validate($encodedText)
    {
        $split = explode('.', $encodedText);
        $decoded = static::decode($split[1]);
        return $split[0] === $decoded;
    }

    /**
     * Reverse Case char of string
     *
     * @param string $text Text to be reverse case
     * @return string
     **/
    public static function reverseCase($text)
    {
        $split = str_split($text);
        $output = [];
        for ($i = 0; $i < count($split); $i++) {
            array_push($output, $split[$i] == strtolower($split[$i]) ? strtoupper($split[$i]) : strtolower($split[$i]));
        }
        return implode($output);
    }

}
