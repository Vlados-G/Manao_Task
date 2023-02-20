$("document").ready(function () {
  $("#registration-form").on("submit", function () {
    let dataForm = $(this).serialize();
    event.preventDefault();
    // отправляем ajax

    $.ajax({
      url: "vendor/signup.php",
      method: "post",
      dataType: "html",
      data: dataForm,
      success: function (data) {
        // если ошибок нет перенапрявляем на страницу профиля
        if (data == "[]") {
          window.location.href = "/home.php";
        }

        // парсим данные
        const response = $.parseJSON(data);

        // разбираемся с ошибками
        if (response.uniqLogin == false) {
          document.querySelector("#login-error").innerHTML = "этот логин занят";
        }

        if (response.loginError) {
          document.querySelector("#login-error").innerHTML =
            response["loginError"];
        }
        if (response.passwordError) {
          document.querySelector("#password-error").innerHTML =
            response["passwordError"];
        }
        if (response.passwordConfirmError) {
          document.querySelector("#password-confirm-error").innerHTML =
            response["passwordConfirmError"];
        }
        if (response.emailError) {
          document.querySelector("#email-error").innerHTML =
            response["emailError"];
        }
        if (response.uniqEmail == false) {
          document.querySelector("#email-error").innerHTML =
            "используйте другую почту";
        }
        if (response.fullNameLengthError) {
          document.querySelector("#full-name-error").innerHTML =
            response["fullNameLengthError"];
        }
        if (response.fullNameStructureError) {
          document.querySelector("#full-name-error").innerHTML =
            response["fullNameStructureError"];
        }
        if (response.spaceError) {
          document.querySelector("#space-error").innerHTML =
            response["spaceError"];
        }
      },
      error: function (data) {
        console.log("ошибка");
      },
    });
  });
});
