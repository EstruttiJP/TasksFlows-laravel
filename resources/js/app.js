document.addEventListener('DOMContentLoaded', function () { 
    const dropdownButton = document.querySelector('.dropdown button'); 
    const dropdownMenu = document.querySelector('#dropdown'); 
    dropdownButton.addEventListener('click', function () { 
        dropdownMenu.classList.toggle('hidden'); 
    }); 
    document.addEventListener('click', function (e) { 
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) { 
            dropdownMenu.classList.add('hidden'); 
        } 
    }); 
});