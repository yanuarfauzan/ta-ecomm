document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    togglePassword.addEventListener("click", function() {
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);

        // Ganti ikon mata sesuai dengan status password
        if (type === "password") {
            togglePassword.classList.remove("bi-eye");
            togglePassword.classList.add("bi-eye-slash");
        } else {
            togglePassword.classList.remove("bi-eye-slash");
            togglePassword.classList.add("bi-eye");
        }
    });
})