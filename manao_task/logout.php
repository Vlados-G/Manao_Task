<?php
// удаляем cookie
setcookie('login', '', time() - 3600 * 24);
// перенаправляем на страницу авторизации
header('Location: ../index.php');

?>