const Toast = Swal.mixin({
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

window.Echo.channel("EveryoneChannel").listen(".EveryoneMessage", function (e) {
    let data = JSON.parse(e.message);
    if (data.RS > 0) {
        Toast.fire({
            icon: "success",
            title: "RS = 1",
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
