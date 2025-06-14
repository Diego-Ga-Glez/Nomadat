/**
 * Muestra un mensaje de error debajo del input correspondiente.
 * @param {HTMLElement} element - El input donde se mostrará el error.
 * @param {string} message - El mensaje de error (vacío para borrar).
 */
function setError(element, message){
    // Obtiene el contenedor del input
    const inputControl = element.parentElement;

    // Busca el elemento donde se mostrará el mensaje
    const errorDisplay = inputControl.querySelector('.error');

    // Establece el mensaje de error (vacío si no hay error)
    errorDisplay.innerText = message;
}

/**
 * Valida el campo "Name" (mínimo 3 caracteres).
 * @returns {boolean} True si el nombre es válido, false si no.
 */
function validateName(){
    const nameInput = document.getElementById('name');
    const nameValue = nameInput.value.trim();
    const isValid  = nameValue.length >= 3; // Mínimo 3 caracteres

    setError(nameInput, isValid ? '' : 'Name must be at least 3 characters long.');
    return isValid;
}

/**
 * Valida el campo "Last Name" (mínimo 5 caracteres).
 * @returns {boolean} True si el apellido es válido, false si no.
 */
function validateLastName(){
    const lastNameInput = document.getElementById('lastName');
    const lastNameValue = lastNameInput.value.trim();
    const isValid  = lastNameValue.length >= 5; // Mínimo 5 caracteres

    setError(lastNameInput, isValid ? '' : 'Last name must be at least 5 characters long.');
    return isValid;
}

/**
 * Valida el campo "Age" (debe ser mayor o igual a 18).
 * @returns {boolean} True si la edad es válida, false si no.
 */
function validateAge(){
    const ageInput = document.getElementById('age');
    const ageValue = Number(ageInput.value.trim());
    const isValid = ageValue >= 18; // Verifica que sea mayor o igual a 18

    setError(ageInput, isValid ? '': 'Age must be over 18');
    return isValid

}

document.getElementById('form').addEventListener('submit', event =>{

    // Evita el envío automático del formulario
    event.preventDefault();

    // Ejecuta todas las validaciones
    const isNameValid = validateName();
    const isLastNameValid = validateLastName();
    const isAgeValid = validateAge();

    const isValid = (isNameValid && isLastNameValid && isAgeValid);

    // Si alguna validacón falla, no hace nada
    if(!isValid) return;

    // Si todo es válido, muestra alerta y limpia el formulario
    Swal.fire({
        title: "Form Submitted!",
        text: "Your information has been successfully recorded.",
        icon: "success"
    }).then(() => {
        event.target.reset();
    });
});