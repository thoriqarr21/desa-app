setTimeout(function() {
    const alertBox = document.getElementById('alertError');
    if (alertBox) {
        alertBox.style.transition = "opacity 0.5s ease";
        alertBox.style.opacity = 0;
        setTimeout(() => alertBox.remove(), 500); // hapus elemen setelah fade out
    }
}, 5000); // 5000 ms = 5 detik

function validateFileSize(input) {
    let totalSize = 0;
    for (let i = 0; i < input.files.length; i++) {
        totalSize += input.files[i].size;
    }

    const maxTotalSize = 30 * 1024 * 1024; // 30MB

    if (totalSize > maxTotalSize) {
        // Reset file input
        input.value = "";

        const toastEl = document.getElementById('fileSizeToast');
        const countdownEl = document.getElementById('countdown');

        let seconds = 5;
        countdownEl.textContent = `Menutup dalam ${seconds} detik...`;

        // Tampilkan toast
        const toast = new bootstrap.Toast(toastEl);
        toast.show();

        // Jalankan countdown
        const interval = setInterval(() => {
            seconds--;
            countdownEl.textContent = `Menutup dalam ${seconds} detik...`;
            if (seconds <= 0) {
                clearInterval(interval);
                toast.hide(); // ini penting!
            }
        }, 1000);
    }
}