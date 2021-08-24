import MqttSub from "./MqttSub";
class Dashboard extends MqttSub {
    configEvent = {};

    constructor() {
        super("103.31.39.42", 9001);
        this.configEvent = {
            "event/pintu": {
                SP1: {
                    name: "Pintu 1",
                    state: ["Terbuka", "Tertutup"], // Index 0 = anomali, 1 = normal
                },
                SP2: {
                    name: "Pintu 2",
                    state: ["Terbuka", "Tertutup"],
                },
                MAG: {
                    name: "Kunci Pintu",
                    state: ["Tidak Terkunci", "Terkunci"],
                },
            },
            "event/beban": {
                PROX: {
                    name: "Proximity",
                    state: ["Tidak Aman", "Aman"],
                },
                LC: {
                    name: "Berat Kontainer",
                    state: 50,
                },
            },
            "event/base": {
                PB: {
                    name: "Emergency Button",
                    state: ["Bahaya", "Aman"],
                },
                RS: {
                    name: "Kondisi Mesin",
                    state: ["Mati", "Menyala"],
                },
                DRI: {
                    name: "Driving Behaviour",
                    state: ["Tidak Stabil", "Stabil"],
                },
                DRO: {
                    name: "Drowsiness",
                    state: ["Mengantuk", "Tidak Mengantuk"],
                },
                LAT: {
                    name: "Latitude",
                },
                LON: {
                    name: "Longitude",
                },
            },
            except: ["LC", "LAT", "LON"],
        };
    }

    eventHandler(topic, data) {
        for (let key in this.configEvent[topic]) {
            if (this.configEvent["except"].indexOf(key) < 0) {
                document.getElementById(key).innerHTML =
                    this.configEvent[topic][key].state[data[key].value];
                this.toastMessage.icon = data[key].value ? "error" : "success";
                this.toastMessage.title =
                    this.configEvent[topic][key].name +
                    " " +
                    this.configEvent[topic][key].state[data[key].value];
                this.toastMessage.footer = "Ini untuk device";
            } else {
                document.getElementById(key).innerHTML = data[key].value;
            }
        }
    }

    onMessageArrived(msg) {
        out_msg = "Message received " + msg.payloadString + "<br>";
        console.log("Message received");
        let pesan = "" + msg.payloadString;
        let data = JSON.parse(pesan);
        this.eventHandler(msg.destinationName, data);
        // switch (msg.destinationName) {
        //     case "/event/pintu":
        //         // Pintu 1
        //         document.getElementById("SP1").innerHTML =
        //             data.SP1.value == "0" ? "Terbuka" : "Tertutup";
        //         // End Pintu 1

        //         // Pintu 2
        //         document.getElementById("SP2").innerHTML =
        //             data.SP2.value == "0" ? "Terbuka" : "Tertutup";
        //         // End Pintu 2

        //         // Kunci Pintu
        //         document.getElementById("MAG").innerHTML =
        //             data.MAG.value == "0" ? "Tidak Terkunci" : "Terkunci";
        //         // End Pintu 2
        //         break;

        //     case "/event/beban":
        //         document.getElementById("PROX").innerHTML =
        //             data.PROX.value == 0 ? "Tidak Aman" : "Aman";

        //         document.getElementById("LC").innerHTML = data.LC;
        //         break;

        //     case "/event/base":
        //         document.getElementById("PB").innerHTML =
        //             data.PB == "0" ? "Bahaya" : "Aman";

        //         document.getElementById("RS").innerHTML =
        //             data.RS == "1" ? "Mati" : "Menyala";

        //         document.getElementById("DRI").innerHTML =
        //             data.DRI == 0 ? "Stabil" : "Tidak Stabil";

        //         document.getElementById("DRO").innerHTML =
        //             data.DRO == 0 ? "Tidak Mengantuk" : "Mengantuk";

        //         document.getElementById("LAT").innerHTML = data.LAT;
        //         document.getElementById("LON").innerHTML = data.LON;
        //         break;
        // }
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
