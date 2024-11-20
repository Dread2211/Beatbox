document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
      loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);

        try {
          const response = await fetch(loginForm.action, {
            method: 'POST',
            body: formData
          });

          if (response.ok) {
            const data = await response.json();

            if (data.status === 'success') {
              // Cierra el modal de inicio de sesión
              const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
              if (loginModal) {
                loginModal.hide();
              }

              // Mostrar modal de éxito
              const successModal = new bootstrap.Modal(document.getElementById('successModal'));
              document.getElementById('successMessage').textContent = data.message;
              successModal.show();

              // Actualiza los botones tras un inicio de sesión exitoso
              document.getElementById('loginButton').classList.add('d-none');
              document.getElementById('logoutForm').classList.remove('d-none');
            } else {
              // Mostrar modal de error
              showErrorModal(data.message);
            }
          } else {
            showErrorModal('Error al procesar la solicitud. Inténtelo nuevamente.');
          }
        } catch (error) {
          console.error('Error de red:', error);
          showErrorModal('Error de red. Inténtelo nuevamente.');
        }
      });
    }

    const registerForm = document.getElementById('registerForm'); // Asegúrate de que este ID sea correcto

    if (registerForm) {
      registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(registerForm);

        try {
          const response = await fetch(registerForm.action, {
            method: 'POST',
            body: formData
          });

          if (response.ok) {
            const data = await response.json();

            if (data.status === 'success') {
              // Cierra el modal de registro
              const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal')); 
              if (registerModal) {
                registerModal.hide(); // Cerrar el modal de registro
              }

              // Mostrar modal de éxito si el registro fue exitoso
              const successModal = new bootstrap.Modal(document.getElementById('successModal'));
              document.getElementById('successMessage').textContent = data.message; // Mensaje personalizado
              successModal.show();

              // Opcional: Limpiar el formulario después de registro exitoso
              registerForm.reset();
            } else {
              // Mostrar modal de error si hubo un problema
              showErrorModal(data.message);
            }
          } else {
            showErrorModal('Error al procesar la solicitud. Inténtelo nuevamente.');
          }
        } catch (error) {
          console.error('Error de red:', error);
          showErrorModal('Error de red. Inténtelo nuevamente.');
        }
      });
    }

    // Función para mostrar el modal de error
    function showErrorModal(message) {
      const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
      document.getElementById('errorMessage').textContent = message;
      errorModal.show();
    }


    // Verifica el estado de la sesión al cargar la página
    checkSessionStatus();
  });
