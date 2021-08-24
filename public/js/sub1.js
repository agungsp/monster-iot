var mqtt1;
var reconnectTimeout = 2000;
var host = "103.31.39.42"; //change this
var port = 9001;

function onFailure(message) {
    console.log("Connection Attempt to Host " + host + " Failed");
    setTimeout(MQTTconnect, reconnectTimeout);
}

function onMessageArrived(msg) {
    if (msg.destinationName == "/event/rfid") {
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
        console.log(data);
        if (data.id == "b1") {
            console.log("b1");
            if (data.dt == "0") {
                document.getElementById("rfid1").innerHTML = "undetected";
            } else {
                document.getElementById("rfid1").innerHTML = "detected";
            }
            console.log("b1dt");

            if (data.status == "0") {
                document.getElementById("status1").innerHTML = "keluar";
            } else {
                document.getElementById("status1").innerHTML = "masuk";
            }
            console.log("b1st");
        }

        if (data.id == "b2") {
            if (data.dt == "0") {
                document.getElementById("rfid2").innerHTML = "undetected";
            } else {
                document.getElementById("rfid2").innerHTML = "detected";
            }

            if (data.status == "0") {
                document.getElementById("status2").innerHTML = "keluar";
            } else {
                document.getElementById("status2").innerHTML = "masuk";
            }
        }

        if (data.id == "b3") {
            if (data.dt == "0") {
                document.getElementById("rfid3").innerHTML = "undetected";
            } else {
                document.getElementById("rfid3").innerHTML = "detected";
            }

            if (data.status == "0") {
                document.getElementById("status3").innerHTML = "keluar";
            } else {
                document.getElementById("status3").innerHTML = "masuk";
            }
        }

        if (data.id == "b4") {
            if (data.dt == "0") {
                document.getElementById("rfid4").innerHTML = "undetected";
            } else {
                document.getElementById("rfid4").innerHTML = "detected";
            }

            if (data.status == "0") {
                document.getElementById("status4").innerHTML = "keluar";
            } else {
                document.getElementById("status4").innerHTML = "masuk";
            }
        }
    }
}

function onConnect() {
    console.log("Connected ");
    mqtt.subscribe("/event/#");
    //TAMBAHAN MULAI DISINI
    var kiriminit = new Paho.MQTT.Message("cek");
    kiriminit.destinationName = "/init/data";
    mqtt.send(kiriminit);
    //TAMBAHAN BERAKHIR DISINI
}

function MQTTconnect() {
    console.log("connecting to " + host + " " + port);
    var x = Math.floor(Math.random() * 10000);
    var cname = "ban-" + x;
    mqtt = new Paho.MQTT.Client(host, port, cname);
    var options = {
        timeout: 3,
        onSuccess: onConnect,
        onFailure: onFailure,
    };
    mqtt.onMessageArrived = onMessageArrived;

    mqtt.connect(options);
}