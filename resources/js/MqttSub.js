class MqttSub {
    reconnectTimeout = 2000;
    mqtt = null;

    constructor(host = "127.0.0.1", port = 1883) {
        this.host = host;
        this.port = port;
    }

    connect() {
        console.log(`connecting to ${this.host}:${this.port}`);
        let x = Math.floor(Math.random() * 10000);
        let cname = "orderform-" + x;
        this.mqtt = new Paho.MQTT.Client(this.host, this.port, cname);
        let options = {
            timeout: 3,
            onSuccess: this.onConnect,
            onFailure: this.onFailure,
        };
        this.mqtt.onMessageArrived = this.onMessageArrived;
        this.mqtt.connect(options);
    }

    onConnect() {
        console.log("Connected");
        this.mqtt.subscribe("event/#");
    }

    onFailure(message) {
        console.log(`Connection Attempt to Host ${this.host} Failed`);
        setTimeout(this.connect, this.reconnectTimeout);
    }
}

export default MqttSub;
