import.meta.glob([
    '../images/**'
]);
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";

// Inicializar o Flatpickr no campo de data quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    flatpickr('#deadline', {
        dateFormat: 'Y-m-d',
    });
});


