const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
        // playSound();
    },
});

window.Echo.channel("EveryoneChannel").listen(".EveryoneMessage", function (e) {
    let data = JSON.parse(e.message);
    if (typeof data.RS !== "undefined" && data.RS.isChange) {
        Toast.fire({
            icon: data.RS.value ? "success" : "danger",
            title: `Mesin ${data.RS.value ? "Menyala" : "Mati"}`,
            footer: data.UUID,
        });
    }
    if (typeof data.PROX !== "undefined" && data.PROX.isChange) {
        Toast.fire({
            icon: data.PROX.value ? "success" : "danger",
            title: `Proximity ${data.PROX.value ? "Aman" : "Tidak Aman"}`,
            footer: data.UUID,
        });
    }
    console.log(JSON.parse(e.message));
});

let userChannel = "user.1";
window.Echo.private(userChannel).listen(".ManualMessage", function (e) {
    Toast.fire({
        icon: "info",
        title: e.message,
    });
    console.log(e.message);
});
