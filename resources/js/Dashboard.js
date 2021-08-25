import MqttSub from "./MqttSub";

class Dashboard extends MqttSub {
    constructor() {
        super("103.31.39.42", 9001);
    }
    onMessageArrived(msg) {
        out_msg = "Message received " + msg.payloadString + "<br>";
        let pesan = "" + msg.payloadString;
        let data = JSON.parse(pesan);
        switch (msg.destinationName) {
            case "/event/pintu":
                document.getElementById("SP1").innerHTML =
                    data.SP1 == "0" ? "Terbuka" : "Tertutup";

                document.getElementById("SP2").innerHTML =
                    data.SP2 == "0" ? "Terbuka" : "Tertutup";

                document.getElementById("MAG").innerHTML =
                    data.MAG == "0" ? "Tidak Terkunci" : "Terkunci";
                break;

            case "/event/beban":
                document.getElementById("PROX").innerHTML =
                    data.PROX == 0 ? "Tidak Aman" : "Aman";

                document.getElementById("LC").innerHTML = data.LC;
                break;

            case "/event/base":
                document.getElementById("PB").innerHTML =
                    data.PB == "0" ? "Bahaya" : "Aman";

                document.getElementById("RS").innerHTML =
                    data.RS == "1" ? "Mati" : "Menyala";

                document.getElementById("DRI").innerHTML =
                    data.DRI == 0 ? "Stabil" : "Tidak Stabil";

                document.getElementById("DRO").innerHTML =
                    data.DRO == 0 ? "Tidak Mengantuk" : "Mengantuk";

                document.getElementById("LAT").innerHTML = data.LAT;
                document.getElementById("LON").innerHTML = data.LON;
                break;
        }
    }

    lockPintu() {
        const pesankirimlock = new Paho.MQTT.Message("p1");
        pesankirimlock.destinationName = "/control/mag";
        this.mqtt.send(pesankirimlock);
    }

    unlockPintu() {
        const pesankirimunlock = new Paho.MQTT.Message("p0");
        pesankirimunlock.destinationName = "/control/mag";
        this.mqtt.send(pesankirimunlock);
    }

    engineOnpub() {
        const pesanengineOn = new Paho.MQTT.Message("b0");
        pesanengineOn.destinationName = "/control/eng";
        this.mqtt.send(pesanengineOn);
    }

    engineOffpub() {
        const pesanengineOff = new Paho.MQTT.Message("b1");
        pesanengineOff.destinationName = "/control/eng";
        this.mqtt.send(pesanengineOff);
    }
}

export default Dashboard;
