var mqtt;
var reconnectTimeout = 2000;
var host = "103.31.39.42"; //change this
var port = 9001;

function onFailure(message) {
    console.log("Connection Attempt to Host " + host + " Failed");
    setTimeout(MQTTconnect, reconnectTimeout);
}
function onMessageArrived(msg) {
    // document.getElementById("changeText").innerHTML = "<h1>"+msg.payloadString+"</h1>";
<<<<<<< HEAD
    console.log(msg.payloadString);
    console.log(msg.destinationName);

    out_msg = "Message received " + msg.payloadString + "<br>";
    if (msg.destinationName == "/event/pintu") {
        //        console.log(msg.payloadString);
=======
   // console.log(msg);

    out_msg = "Message received " + msg.payloadString + "<br>";
    if (msg.destinationName == "/event/pintu") {
//        console.log(msg.payloadString);
>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
        if (data.SP1 == "0") {
            document.getElementById("SP1").innerHTML = "terbuka";
        } else {
            document.getElementById("SP1").innerHTML = "tertutup";
        }

        if (data.SP2 == "0") {
            document.getElementById("SP2").innerHTML = "terbuka";
        } else {
            document.getElementById("SP2").innerHTML = "tertutup";
        }

        if (data.MAG == "0") {
            document.getElementById("MAG").innerHTML = "tidak terkunci";
        } else {
            document.getElementById("MAG").innerHTML = "terkunci";
        }
<<<<<<< HEAD
        //   console.log("berhasil pintu");
=======
  //   console.log("berhasil pintu");
>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
    }
    if (msg.destinationName == "/event/beban") {
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
<<<<<<< HEAD
        //    console.log(data);
=======
    //    console.log(data);
>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
        if (data.PROX == "0") {
            document.getElementById("PROX").innerHTML = "tidak aman";
        } else {
            document.getElementById("PROX").innerHTML = "aman";
        }
        document.getElementById("LC").innerHTML = data.LC;
<<<<<<< HEAD
        //  console.log("berhasil beban");
=======
      //  console.log("berhasil beban");
>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
    }
    if (msg.destinationName == "/event/base") {
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
        // console.log(data);
        if (data.PB == "0") {
            document.getElementById("PB").innerHTML = "bahaya";
        } else {
            document.getElementById("PB").innerHTML = "aman";
        }
<<<<<<< HEAD
        //        console.log("PB");
=======
//        console.log("PB");
>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
        if (data.RS == "1") {
            document.getElementById("RS").innerHTML = "mati";
        } else {
            document.getElementById("RS").innerHTML = "nyala";
        }
<<<<<<< HEAD
        //      console.log("RS");
=======
  //      console.log("RS");
>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
        if (data.DRI == "0") {
            document.getElementById("DRI").innerHTML = "stabil";
        } else {
            document.getElementById("DRI").innerHTML = "tidak stabil";
        }
<<<<<<< HEAD
        //      console.log("DRI");
=======
  //      console.log("DRI");
>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
        if (data.DRO == "0") {
            document.getElementById("DRO").innerHTML = "tidak mengantuk";
        } else {
            document.getElementById("DRO").innerHTML = "mengantuk";
        }
<<<<<<< HEAD
        //      console.log("DRO");
        document.getElementById("LAT").innerHTML = data.LAT;
        //      console.log("LAT");
        document.getElementById("LON").innerHTML = data.LON;
        //      console.log("LON");
        changeMarker(parseFloat(data.LAT), parseFloat(data.LON));
        //console.log("berhasil base")
    }
=======
  //      console.log("DRO");
        document.getElementById("LAT").innerHTML = data.LAT;
  //      console.log("LAT");
        document.getElementById("LON").innerHTML = data.LON;
  //      console.log("LON");
        changeMarker(parseFloat(data.LAT), parseFloat(data.LON));
        //console.log("berhasil base")
    }

>>>>>>> d8fc70ed50bff4cc0a8fbfb175de8886653c4f1c
}

function onConnect() {
    console.log("Connected ");
    mqtt.subscribe("/event/#");
    //TAMBAHAN MULAI DISINI
    var kiriminit = new Paho.MQTT.Message("cek1");
    kiriminit.destinationName = "/init/data";
    mqtt.send(kiriminit);
    //TAMBAHAN BERAKHIR DISINI
}

function MQTTconnect() {
    console.log("connecting to " + host + " " + port);
    var x = Math.floor(Math.random() * 10000);
    var cname = "orderform-" + x;
    mqtt = new Paho.MQTT.Client(host, port, cname);
    var options = {
        timeout: 3,
        onSuccess: onConnect,
        onFailure: onFailure,
    };
    mqtt.onMessageArrived = onMessageArrived;

    mqtt.connect(options);
}

function lockPintu() {
    var pesankirimlock = new Paho.MQTT.Message("p1");
    pesankirimlock.destinationName = "/control/mag";
    mqtt.send(pesankirimlock);
}

function unlockPintu() {
    var pesankirimunlock = new Paho.MQTT.Message("p0");
    pesankirimunlock.destinationName = "/control/mag";
    mqtt.send(pesankirimunlock);
}

function engineOnpub() {
    var pesanengineOn = new Paho.MQTT.Message("b0");
    pesanengineOn.destinationName = "/control/eng";
    mqtt.send(pesanengineOn);
}

function engineOffpub() {
    var pesanengineOff = new Paho.MQTT.Message("b1");
    pesanengineOff.destinationName = "/control/eng";
    mqtt.send(pesanengineOff);
}
