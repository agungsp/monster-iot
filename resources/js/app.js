const { default: Dashboard } = require("./Dashboard");
const { default: Rfid } = require("./Rfid");

require("./bootstrap");
require("./scripts");

if (window.location.pathname.includes("/dashboard")) {
    window.mqtt = new Dashboard();
} else if (window.location.pathname.includes("/truck-monitoring")) {
    window.mqtt = new Rfid();
}
