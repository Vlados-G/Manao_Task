$("document").ready(function () {
  $("#authorization-form").on("submit", function () {
    let dataForm = $(this).serialize();
    event.preventDefault();

    // отправляем ajax
    $.ajax({
      url: "vendor/signin.php",
      method: "post",
      dataType: "html",
      data: dataForm,
      success: function (data) {
        // если ответ не пустой парсим
        if (data !== "") {
          let response = $.parseJSON(data);
          if (response.success == true) {
            window.location.href = "/home.php";
          }
          // разбираемся с ошибками
          if (response.loginError) {
            document.querySelector("#auth-login-error").innerHTML =
              response["loginError"];
          }
          if (response.passwordError) {
            document.querySelector("#auth-password-error").innerHTML =
              response["passwordError"];
          }
          //если ошибок нет - переходим на страницу профиля

          if (response.success == false) {
            document.querySelector("#auth-error").innerHTML =
              "неверный логин и/или пароль";
          }
        }
      },
      error: function (data) {
        console.log("ошибка, AJAX не отправлен");
      },
    });
  });
});
