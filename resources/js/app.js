const { default: Rfid } = require("./Rfid");

require("./bootstrap");
require("./scripts");

if (window.location.pathname.includes("/dashboard")) {
    require("./sub");
}
