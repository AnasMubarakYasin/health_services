const elm = document.getElementById("password_toggle");
const password = document.getElementById('password');
elm.addEventListener("change", (ev) => {
  password.type = password.type == 'password' ? 'text' : 'password';
});
