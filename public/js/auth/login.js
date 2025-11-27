document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formAuthentication');
    const loginButton = document.getElementById('login-button');
    const originalButtonContent = loginButton.querySelector('span').innerHTML;
    
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('toggle-password');

    // --- Lógica de Envío del Formulario ---
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        clearErrors();
        showLoadingState();

        const formData = new FormData(form);
        const url = form.action;

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status === 200 && body.status) {
                handleSuccess(body);
            } else {
                throw body;
            }
        })
        .catch(error => {
            hideLoadingState();
            handleError(error);
        });
    });

    // --- Lógica para Mostrar/Ocultar Contraseña ---
    togglePasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Cambiar el icono del ojo
        const icon = this.querySelector('i');
        icon.classList.toggle('ri-eye-line');
        icon.classList.toggle('ri-eye-off-line');
    });

    // --- Funciones Auxiliares ---
    function handleSuccess(data) {
        Swal.fire({
            icon: 'success',
            title: data.title || '¡Éxito!',
            text: data.msg || 'Bienvenido. Serás redirigido.',
            timer: 1500,
            showConfirmButton: false,
            allowOutsideClick: false,
        }).then(() => {
            window.location.href = '/dashboard';
        });
    }

    function handleError(error) {
        if (error.errors) {
            displayValidationErrors(error.errors);
            Swal.fire({
                icon: 'warning',
                title: 'Datos Inválidos',
                text: 'Por favor, corrige los campos marcados.',
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: error.title || 'Error',
                text: error.msg || 'Ha ocurrido un error inesperado.',
            });
        }
    }

    function showLoadingState() {
        loginButton.disabled = true;
        loginButton.innerHTML = `
            <span class="spinner"></span>
            <span>Verificando...</span>
        `;
    }

    function hideLoadingState() {
        loginButton.disabled = false;
        loginButton.innerHTML = `<span>${originalButtonContent}</span>`;
    }

    function displayValidationErrors(errors) {
        for (const field in errors) {
            const inputElement = document.getElementById(field);
            const errorElement = document.getElementById(`${field}-error`);
            if (inputElement && errorElement) {
                inputElement.classList.add('is-invalid');
                errorElement.textContent = errors[field][0];
            }
        }
    }

    function clearErrors() {
        form.querySelectorAll('.input-field.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
        });
    }
});