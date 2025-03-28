import './bootstrap';
import * as bootstrap from 'bootstrap';

import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener('DOMContentLoaded', () => {
    if (window.Laravel && window.Laravel.success) {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: window.Laravel.success,
            timer: 2000,
            showConfirmButton: false,
        });
    }
    if (window.Laravel && window.Laravel.error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: window.Laravel.error,
            timer: 2000,
            showConfirmButton: false,
        });
    }
});