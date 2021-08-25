<?php

namespace App\Helpers;

use PhpMqtt\Client\Facades\MQTT;
use PhpMqtt\Client\Exceptions\ConnectionNotAvailableException;
use PhpMqtt\Client\Exceptions\MqttClientException;


class MqttHelper {

    public static function subscribe($topic = 'test', $qos = 0)
    {
        try {
            $mqtt = MQTT::connection();
            $mqtt->subscribe($topic, function (string $topic, string $message) {
                broadcast(new \App\Events\SendDeviceEvent($message));
                // echo "Send\n";
                print_r(json_decode($message));

            }, $qos);
            $mqtt->loop(true);
        } catch (MqttClientException $e) {
            return $e->getMessage();
        }
    }

    public static function publish($topic, $message, $qos = 0, $retainMessage = false)
    {
        try {
            $mqtt = MQTT::connection();
            $mqtt->publish($topic, $message, $qos, $retainMessage);
        } catch (MqttClientException $e) {
            return $e->getMessage();
        }
    }
}
