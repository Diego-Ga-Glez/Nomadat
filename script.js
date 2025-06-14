const nameInput = document.getElementById('name');
const lastNameInput = document.getElementById('lastName');
const ageInput = document.getElementById('age');
const form = document.getElementById('form');

function setMessage(element, message){
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = message;
}

function validateName(){
    const nameValue = nameInput.value.trim();
    const isValid  = nameValue.length >= 3;

    setMessage(nameInput, isValid ? '' : 'Name must be at least 3 characters long.');
    return isValid;
}

function validateLastName(){
    const lastNameValue = lastNameInput.value.trim();
    const isValid  = lastNameValue.length >= 5;

    setMessage(lastNameInput, isValid ? '' : 'Last name must be at least 5 characters long.');
    return isValid;
}

function validateAge(){
    const ageValue = Number(ageInput.value.trim());
    const isValid = ageValue >= 18;

    setMessage(ageInput, isValid ? '': 'Age must be over 18');
    return isValid

}

form.addEventListener('submit', e =>{
    const isNameValid = validateName();
    const isLastNameValid = validateLastName();
    const isAgeValid = validateAge();

    e.preventDefault();
    const isValid = (isNameValid && isLastNameValid && isAgeValid);

    if(!isValid) return;

    Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success"
    }).then(() => {
        form.reset();
    });
});