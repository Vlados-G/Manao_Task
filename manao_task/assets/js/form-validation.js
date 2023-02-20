// помогаем пользователю ввести данные логина корректно
let loginForm = document.querySelector("#loginid");
loginForm.addEventListener("input", function () {
  if (loginForm.value.length < 6 && loginForm.value.length > 0) {
    document.querySelector("#login-error").innerHTML =
      "введите больше символов";
  } else if (loginForm.value.indexOf(" ") > -1) {
    document.querySelector("#login-error").innerHTML = "без пробелов";
  } else {
    document.querySelector("#login-error").innerHTML = "";
  }
});

// помогаем пользователю ввести данные пароля корректно
let passwordForm = document.querySelector("#password");
passwordForm.addEventListener("input", function () {
  let letters = /(([a-zA-Zа-яА-ЯЁё-і].*\d)|(\d.*[a-zA-Zа-яА-ЯЁё-і]))/;

  // сообщаем о слишком коротком пароле
  if (passwordForm.value.length < 6 && passwordForm.value.length > 0) {
    document.querySelector("#password-error").innerHTML =
      "введите больше символов";
  } else if (
    passwordForm.value.length > 5 &&
    passwordForm.value.match(letters) === null
  ) {
    document.querySelector("#password-error").innerHTML =
      "введите соответсвующий пароль";
  } else if (passwordForm.value.indexOf(" ") > -1) {
    document.querySelector("#password-error").innerHTML = "без пробелов";
  } else {
    document.querySelector("#password-error").innerHTML = "";
  }
});

// помогаем пользователю ввести данные дублированного пароля без пробелов
let confirmPasswordForm = document.querySelector("#passwordConfirm");
confirmPasswordForm.addEventListener("input", function () {
  // сообщаем о наличии пробелов
  if (confirmPasswordForm.value.indexOf(" ") > -1) {
    document.querySelector("#password-confirm-error").innerHTML =
      "без пробелов";
  } else {
    document.querySelector("#password-confirm-error").innerHTML = "";
  }
});

// помогаем пользователю ввести данные почты корректно
let emailForm = document.querySelector("#email");
emailForm.addEventListener("input", function () {
  // сообщаем о наличии пробелов
  if (emailForm.value.indexOf(" ") > -1) {
    document.querySelector("#email-error").innerHTML = "без пробелов";
  } else {
    document.querySelector("#email-error").innerHTML = "";
  }
});

// помогаем пользователю ввести данные имени корректно
let nameForm = document.querySelector("#name");
nameForm.addEventListener("input", function () {
  let nameLetters = /[0-9]/;
  console.log(nameForm.value.match(nameLetters));
  if (nameForm.value.length < 3 || nameForm.value.match(nameLetters) !== null) {
    document.querySelector("#full-name-error").innerHTML =
      "введите больше 2 символов, без цифр";
  } else if (nameForm.value.indexOf(" ") > -1) {
    document.querySelector("#full-name-error").innerHTML = "без пробелов";
  } else {
    document.querySelector("#full-name-error").innerHTML = "";
  }
});
