setTimeout(function() {
    const alertBox = document.getElementById('alertError');
    if (alertBox) {
        alertBox.style.transition = "opacity 0.5s ease";
        alertBox.style.opacity = 0;
        setTimeout(() => alertBox.remove(), 500); // hapus elemen setelah fade out
    }
}, 5000); // 5000 ms = 5 detik