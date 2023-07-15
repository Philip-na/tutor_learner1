
var form = document.getElementById("form");
var password = document.getElementById("password");
var confirmPassword = document.getElementById("confirmPassword");
var message = document.getElementById("message");

form.addEventListener("submit", function(event) {
  event.preventDefault();

  // Check if all input fields have values
  var inputs = form.querySelectorAll("input");
  var isFormValid = true;
  inputs.forEach(function(input) {
    if (input.value.trim() === "") {
      isFormValid = false;
      input.classList.add("error");
    } else {
      input.classList.remove("error");
    }
  });

  // Check if the passwords match
  if (password.value !== confirmPassword.value) {
    isFormValid = false;
    password.classList.add("error");
    confirmPassword.classList.add("error");
    
  } else {
    password.classList.remove("error");
    confirmPassword.classList.remove("error");
  }

  // Validate the password length and characters
  var passwordValue = password.value;
  var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
  if (!passwordPattern.test(passwordValue)) {
    isFormValid = false;
    password.classList.add("error");
    message.style.color = "red";
    message.textContent = "Password should be at least 8 characters long and contain at least one letter and one number.";
  } else {
    password.classList.remove("error");
    message.textContent = "";
  }

  // Submit the form if all validations pass
  if (isFormValid) {
    form.submit();
  }
});



