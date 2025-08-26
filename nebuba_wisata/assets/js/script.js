// Fungsi untuk validasi form
function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return isValid;
}

// Validasi form reservasi
document.getElementById('reservasiForm')?.addEventListener('submit', function(e) {
    if (!validateForm('reservasiForm')) {
        e.preventDefault();
    }
});

// Validasi form kontak
document.getElementById('kontakForm')?.addEventListener('submit', function(e) {
    if (!validateForm('kontakForm')) {
        e.preventDefault();
    }
});

// Validasi form login
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    if (!validateForm('loginForm')) {
        e.preventDefault();
    }
});

// Fungsi untuk preview gambar sebelum upload
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}

// Inisialisasi tooltip Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});