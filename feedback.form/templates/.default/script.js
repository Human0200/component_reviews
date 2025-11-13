function toggleFeedbackForm(formId) {
    var formContainer = document.getElementById(formId);
    if (formContainer.style.display === 'none') {
        formContainer.style.display = 'block';
    } else {
        formContainer.style.display = 'none';
    }
}

function validateFeedbackForm(form) {
    var name = form.querySelector('[name="name"]').value.trim();
    var phone = form.querySelector('[name="phone"]').value.trim();
    var email = form.querySelector('[name="email"]').value.trim();
    var message = form.querySelector('[name="message"]').value.trim();
    
    if (!name) {
        alert('Укажите ваше имя');
        return false;
    }
    
    if (!phone && !email) {
        alert('Укажите телефон или email');
        return false;
    }
    
    if (!message) {
        alert('Напишите ваш вопрос');
        return false;
    }
    
    return true;
}

// Маска для телефона (опционально)
document.addEventListener('DOMContentLoaded', function() {
    var phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : '+' + x[1] + ' (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
        });
    });
});