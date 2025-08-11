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

    const maxTotalSize = 10 * 1024 * 1024; // 30MB

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

document.addEventListener("DOMContentLoaded", function() {
    // Cari semua <i> yang punya class keyword di awal (show/edit/delete)
    document.querySelectorAll('i').forEach(function(icon) {
        let classes = icon.className.split(/\s+/);
        if (classes.length > 0) {
            let keyword = classes[0]; // class pertama, misal "show"
            if (!icon.hasAttribute('title')) {
                icon.setAttribute('title', keyword.charAt(0).toUpperCase() + keyword.slice(1));
                icon.setAttribute('data-bs-toggle', 'tooltip');
            }
        }
    });

    // Aktifkan Bootstrap tooltip di semua elemen yang punya data-bs-toggle="tooltip"
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});