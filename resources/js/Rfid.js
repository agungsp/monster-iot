import MqttSub from "./MqttSub";

class Rfid extends MqttSub {
    constructor() {
        super("103.31.39.42", 9001);
    }

    onMessageArrived(msg) {
        if (msg.destinationName == "/event/rfid") {
            let pesan = "" + msg.payloadString;
            let data = JSON.parse(pesan);
            switch (data.id) {
                case "b1":
                    document.getElementById("rfid1").innerHTML =
                        data.dt == "0" ? "Undetected" : "Detected";
                    break;
                case "b2":
                    document.getElementById("rfid2").innerHTML =
                        data.dt == "0" ? "Undetected" : "Detected";
                    break;
                case "b3":
                    document.getElementById("rfid3").innerHTML =
                        data.dt == "0" ? "Undetected" : "Detected";
                    break;
                case "b4":
                    document.getElementById("rfid4").innerHTML =
                        data.dt == "0" ? "Undetected" : "Detected";
                    break;
            }
        }
    }
}

export default Rfid;
