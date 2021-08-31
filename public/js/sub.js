var mqtt;
var reconnectTimeout = 2000;
var host = "103.31.39.42"; //change this
var port = 9001;
let tbodyEvents = document.querySelector("#tbodyEvents");
let lastCoordinate = {
    LAT: "",
    LON: "",
};

function onFailure(message) {
    console.log("Connection Attempt to Host " + host + "Failed");
    setTimeout(MQTTconnect, reconnectTimeout);
}
function onMessageArrived(msg) {
    // document.getElementById("changeText").innerHTML = "<h1>"+msg.payloadString+"</h1>";

    out_msg = "Message received " + msg.payloadString + "<br>";
    if (
        msg.destinationName ==
        "/event/858771fe-15bb-4619-a36e-6a8f8094aaa1/pintu"
    ) {
        console.log(moment().format("YYYY-MM-DD HH:mm:ss") + " pintu");
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
        if (data.SP1.value == "0") {
            document.getElementById("SP1").innerHTML =
                '<span class="badge rounded-pill bg-danger">terbuka</span>';
            if (data.SP1.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "pintu:SP1";
                cellStatus.innerHTML = "terbuka";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Pintu 1 Terbuka",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("SP1").innerHTML =
                '<span class="badge rounded-pill bg-success">tertutup</span>';
            if (data.SP1.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "pintu:SP1";
                cellStatus.innerHTML = "tertutup";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Pintu 1 Tertutup",
                    footer: data.UUID,
                });
            }
        }

        if (data.SP2.value == "0") {
            document.getElementById("SP2").innerHTML =
                '<span class="badge rounded-pill bg-danger">terbuka</span>';
            if (data.SP2.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "pintu:SP2";
                cellStatus.innerHTML = "terbuka";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Pintu 2 Terbuka",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("SP2").innerHTML =
                '<span class="badge rounded-pill bg-success">tertutup</span>';
            if (data.SP2.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "pintu:SP2";
                cellStatus.innerHTML = "tertutup";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "Success",
                    title: "Pintu 2 Tertutup",
                    footer: data.UUID,
                });
            }
        }

        if (data.MAG.value == "0") {
            document.getElementById("MAG").innerHTML =
                '<span class="badge rounded-pill bg-danger">tidak terkunci</span>';
            if (data.MAG.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "pintu:MAG";
                cellStatus.innerHTML = "tidak terkunci";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Kunci Pintu Tidak Terkunci",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("MAG").innerHTML =
                '<span class="badge rounded-pill bg-success">terkunci</span>';
            if (data.MAG.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "pintu:MAG";
                cellStatus.innerHTML = "terkunci";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Kunci Pintu Terkunci",
                    footer: data.UUID,
                });
            }
        }
    }
    if (
        msg.destinationName ==
        "/event/858771fe-15bb-4619-a36e-6a8f8094aaa1/beban"
    ) {
        console.log(moment().format("YYYY-MM-DD HH:mm:ss") + " beban");
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
        // console.log(data);
        if (data.PROX.value == "0") {
            document.getElementById("PROX").innerHTML =
                '<span class="badge rounded-pill bg-danger">tidak aman</span>';
            if (data.PROX.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "beban:PROX";
                cellStatus.innerHTML = "tidak aman";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Proximity Tidak Aman",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("PROX").innerHTML =
                '<span class="badge rounded-pill bg-success">aman</span>';
            if (data.PROX.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "beban:PROX";
                cellStatus.innerHTML = "aman";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Proximity Aman",
                    footer: data.UUID,
                });
            }
        }
        document.getElementById("LC").innerHTML = data.LC.value;
    }
    if (
        msg.destinationName ==
        "/event/858771fe-15bb-4619-a36e-6a8f8094aaa1/base"
    ) {
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
        console.log(moment().format("YYYY-MM-DD HH:mm:ss") + " base");
        if (data.PB.value == "0") {
            document.getElementById("PB").innerHTML =
                '<span class="badge rounded-pill bg-danger">bahaya</span>';
            if (data.PB.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:PB";
                cellStatus.innerHTML = "bahaya";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Emergency Button Bahaya",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("PB").innerHTML =
                '<span class="badge rounded-pill bg-success">aman</span>';
            if (data.PB.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:PB";
                cellStatus.innerHTML = "aman";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Emergency Button Aman",
                    footer: data.UUID,
                });
            }
        }
        if (data.RS.value == "0") {
            document.getElementById("RS").innerHTML =
                '<span class="badge rounded-pill bg-danger">mati</span>';
            if (data.RS.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:RS";
                cellStatus.innerHTML = "mati";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Mesin Mati",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("RS").innerHTML =
                '<span class="badge rounded-pill bg-success">nyala</span>';
            if (data.RS.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:RS";
                cellStatus.innerHTML = "nyala";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Mesin Menyala",
                    footer: data.UUID,
                });
            }
        }
        if (data.DRI.value == "0") {
            document.getElementById("DRI").innerHTML =
                '<span class="badge rounded-pill bg-success">stabil</span>';
            if (data.DRI.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:DRI";
                cellStatus.innerHTML = "stabil";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Driving Behaviour Stabil",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("DRI").innerHTML =
                '<span class="badge rounded-pill bg-danger">tidak stabil</span>';
            if (data.DRI.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:DRI";
                cellStatus.innerHTML = "tidak stabil";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Driving Behaviour Tidak Stabil",
                    footer: data.UUID,
                });
            }
        }
        if (data.DRO.value == "0") {
            document.getElementById("DRO").innerHTML =
                '<span class="badge rounded-pill bg-success">tidak mengantuk</span>';
            if (data.DRO.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:DRO";
                cellStatus.innerHTML = "tidak mengantuk";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Drowness Tidak Mengantuk",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("DRO").innerHTML =
                '<span class="badge rounded-pill bg-danger">mengantuk</span>';
            if (data.DRO.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:DRO";
                cellStatus.innerHTML = "mengantuk";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Drowness Mengantuk",
                    footer: data.UUID,
                });
            }
        }
        if (data.TANK.value == "0") {
            document.getElementById("TANK").innerHTML =
                '<span class="badge rounded-pill bg-danger">terbuka</span>';
            if (data.TANK.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-danger");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:TANK";
                cellStatus.innerHTML = "terbuka";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "error",
                    title: "Tutup Tangki Terbuka",
                    footer: data.UUID,
                });
            }
        } else {
            document.getElementById("TANK").innerHTML =
                '<span class="badge rounded-pill bg-success">tertutup</span>';
            if (data.TANK.isChange) {
                let row = tbodyEvents.insertRow(0);
                let cellDateTime = row.insertCell(0);
                let cellEvent = row.insertCell(1);
                let cellStatus = row.insertCell(2);
                let cellCoordinate = row.insertCell(3);
                row.classList.add("text-success");
                cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                cellEvent.innerHTML = "base:TANK";
                cellStatus.innerHTML = "tertutup";
                cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;

                Toast.fire({
                    icon: "success",
                    title: "Tutup Tangki Tertutup",
                    footer: data.UUID,
                });
            }
        }
        document.getElementById("LAT").innerHTML = data.LAT.value;
        document.getElementById("LON").innerHTML = data.LON.value;
        lastCoordinate.LAT = data.LAT.value;
        lastCoordinate.LON = data.LON.value;
    }

    //  TAMBAHAN MULAI DISINI

    if (
        msg.destinationName ==
        "/event/858771fe-15bb-4619-a36e-6a8f8094aaa1/rfid"
    ) {
        var pesan = "" + msg.payloadString;
        var data = JSON.parse(pesan);
        if (data.id == "b1") {
            if (data.dt == "0") {
                document.getElementById("rfid1").innerHTML =
                    '<span class="badge rounded-pill bg-danger">undetected</span>';
            } else {
                document.getElementById("rfid1").innerHTML =
                    '<span class="badge rounded-pill bg-success">detected</span>';
            }

            if (data.status == "0") {
                document.getElementById("status1").innerHTML = "keluar";
            } else {
                document.getElementById("status1").innerHTML = "masuk";
            }
        }

        if (data.id == "b2") {
            if (data.dt == "0") {
                document.getElementById("rfid2").innerHTML =
                    '<span class="badge rounded-pill bg-danger">undetected</span>';
            } else {
                document.getElementById("rfid2").innerHTML =
                    '<span class="badge rounded-pill bg-success">detected</span>';
            }

            if (data.status == "0") {
                document.getElementById("status2").innerHTML = "keluar";
            } else {
                document.getElementById("status2").innerHTML = "masuk";
            }
        }

        if (data.id == "b3") {
            if (data.dt == "0") {
                document.getElementById("rfid3").innerHTML =
                    '<span class="badge rounded-pill bg-danger">undetected</span>';
            } else {
                document.getElementById("rfid3").innerHTML =
                    '<span class="badge rounded-pill bg-success">detected</span>';
            }

            if (data.status == "0") {
                document.getElementById("status3").innerHTML = "keluar";
            } else {
                document.getElementById("status3").innerHTML = "masuk";
            }
        }

        if (data.id == "b4") {
            if (data.dt == "0") {
                document.getElementById("rfid4").innerHTML =
                    '<span class="badge rounded-pill bg-danger">undetected</span>';
            } else {
                document.getElementById("rfid4").innerHTML =
                    '<span class="badge rounded-pill bg-success">detected</span>';
            }

            if (data.status == "0") {
                document.getElementById("status4").innerHTML = "keluar";
            } else {
                document.getElementById("status4").innerHTML = "masuk";
            }
        }
    }
    // TAMBAHAN BERAKHIR DISINI
}

function onConnect() {
    // Once a connection has been made, make a subscription and send a message.

    console.log("Connected ");
    mqtt.subscribe("/event/858771fe-15bb-4619-a36e-6a8f8094aaa1/#");
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

    mqtt.connect(options); //connect
}

function lockPintu() {
    var pesankirimlock = new Paho.MQTT.Message("p1");
    pesankirimlock.destinationName =
        "/control/858771fe-15bb-4619-a36e-6a8f8094aaa1/mag";
    mqtt.send(pesankirimlock);
}

function unlockPintu() {
    var pesankirimunlock = new Paho.MQTT.Message("p0");
    pesankirimunlock.destinationName =
        "/control/858771fe-15bb-4619-a36e-6a8f8094aaa1/mag";
    mqtt.send(pesankirimunlock);
}

function engineOnpub() {
    var pesanengineOn = new Paho.MQTT.Message("b0");
    pesanengineOn.destinationName =
        "/control/858771fe-15bb-4619-a36e-6a8f8094aaa1/eng";
    mqtt.send(pesanengineOn);
}

function engineOffpub() {
    var pesanengineOff = new Paho.MQTT.Message("b1");
    pesanengineOff.destinationName =
        "/control/858771fe-15bb-4619-a36e-6a8f8094aaa1/eng";
    mqtt.send(pesanengineOff);
}
