document.addEventListener("DOMContentLoaded", function() {
    var alertMessage = localStorage.getItem("alertMessage");
    if (alertMessage) {
        alert(alertMessage);
        localStorage.removeItem("alertMessage");
    }
});