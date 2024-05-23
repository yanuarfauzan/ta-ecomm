document.addEventListener('DOMContentLoaded', function () {
    const otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach(function(input, index) {
            input.addEventListener('input', function() {
                if (this.value.length >= 1) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value.length === 0) {
                    // Menghapus nilai input sebelumnya saat tombol backspace ditekan
                    if (index > 0) {
                        otpInputs[index - 1].value = '';
                        otpInputs[index - 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key.length === 1 && isNaN(parseInt(e.key))) {
                    e.preventDefault();
                }
            });
        });
})
