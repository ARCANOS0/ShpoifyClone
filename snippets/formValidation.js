// Form Validation of registration

const form = document.getElementById('form');
const usernameIN = document.getElementById('username-input');
const emailIN = document.getElementById('email-input');
const passwordIn = document.getElementById('password');
const repeatPass = document.getElementById('confirm-password');
const errorMessage = document.getElementById('error-message');

form.addEventListener('submit', (e) => {
  let errors = [];

  if (usernameIN) {
    errors = getSignUpFromErrors(usernameIN.value, emailIN.value, passwordIn.value, repeatPass.value);
  } else {
    errors = getLogInFromErrors(emailIN.value, passwordIn.value);
  }

  if (errors.length > 0) {
    e.preventDefault();
    errorMessage.innerText = errors.join(". ");
  }
});

function getSignUpFromErrors(username, email, password, repeatPassword) {
  let errors = [];

  if (!username) {
    errors.push('Username is required!');
    usernameIN.parentElement.classList.add('incorrect');
  } else {
    usernameIN.parentElement.classList.remove('incorrect');
  }

  if (!email) {
    errors.push('Email is required!');
    emailIN.parentElement.classList.add('incorrect');
  } else {
    emailIN.parentElement.classList.remove('incorrect');
  }

  if (!password) {
    errors.push('Password is required!');
    passwordIn.parentElement.classList.add('incorrect');
  } else {
    passwordIn.parentElement.classList.remove('incorrect');
  }

  if (password !== repeatPassword) {
    errors.push('Passwords do not match!');
    repeatPass.parentElement.classList.add('incorrect');
  } else {
    repeatPass.parentElement.classList.remove('incorrect');
  }

  if(password.length <8){
   errors.push('password need to be at least 8 characters')
    passwordIn.parentElement.classList.add('incorrect')
  }

  return errors;
}

function getLogInFromErrors(email, password) {
  let errors = [];
  if (!email) errors.push('Email is required!');
  if (!password) errors.push('Password is required!');
  return errors;
}

const allInputs = [usernameIN, passwordIn, emailIN, repeatPass]

allInputs.forEach(input =>{
  input.addEventListener('input', ()=> {
    if(input.parentElement.classList.contains('incorrect')){
      input.parentElement.classList.remove('incorrect')
    }
  })
})


document.getElementById('myButton').addEventListener('click', (e) => {
  console.log("Button clicked!");
  console.log(e.target); // Logs the element that was clicked
});
