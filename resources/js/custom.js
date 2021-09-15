window.Toast = Swal.mixin({
    toast: true,
    position: "top",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

window.reverseCase = (text) => {
    let output = "";
    for (let i = 0; i < text.length; i++) {
        output +=
            text[i] == text[i].toLowerCase()
                ? text[i].toUpperCase()
                : text[i].toLowerCase();
    }
    return output;
};

window.reverseString = (text) => {
    return text === "" ? "" : reverseString(text.substr(1)) + text.charAt(0);
};

window.decodeUuid = (encodedText) => {
    let decoded = window.reverseCase(encodedText);
    decoded = window.reverseString(decoded);
    decoded = atob(decoded);
    return decoded;
};

window.validateUuidSignatures = (encodedText) => {
    let split = encodedText.split(".");
    // console.log(split);
    let decoded = window.decodeUuid(split[1]);
    // console.log(decoded);
    return split[0] === decoded;
};
