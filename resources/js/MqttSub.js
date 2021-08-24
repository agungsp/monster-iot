import Swal from "sweetalert2";

class MqttSub {
    reconnectTimeout = 2000;
    mqtt = null;
    toast = null;
    toastMessage = null;

    constructor(host = "127.0.0.1", port = 1883) {
        this.host = host;
        this.port = port;
        this.toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        this.toastMessage = {
            icon: "info",
            title: "",
            footer: "",
        };
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
        try {
            this.mqtt.connect(options);
        } catch (error) {
            console.error(error.message);
        }
    }

    onConnect() {
        console.log("Connected");
        this.mqtt.subscribe("/event/#");
    }

    onFailure(message) {
        console.log(`Connection Attempt to Host ${this.host} Failed`);
        setTimeout(this.connect, this.reconnectTimeout);
    }

    showNotification() {
        this.toast.fire(this.toastMessage);
    }
}

export default MqttSub;
