function showPassword() {
  const passwordField = $("#password");
  const showPassword = $("#showPassword");

  if (showPassword.innerText == "Show Password") {
    showPassword.innerText = "Hide Password";
    passwordField.type = "text";
  } else if (showPassword.innerText == "Hide Password") {
    passwordField.type = "password";
    showPassword.innerText = "Show Password";
  }
}
