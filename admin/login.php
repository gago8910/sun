<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../libs/db.php';
if (isset($_POST['login'])) {
    $db = new DB();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = 'SELECT username, password FROM admin WHERE username = :username AND password = :password';
    $db->query($query);
    $db->bind(':username', $username);
    $db->bind(':password', $password);
    $row = $db->single();

    if ($row) {
        echo 'Đăng nhập thành công';
    } else {
        echo 'Đăng nhập thất bại';
    }
}
?>

<form method="post" action="">
    <input type="text" name="username">
    <br>
    <br>
    <input type="password" name="password">
    <br>
    <br>
    <input type="submit" name="login" value="Login">
</form>