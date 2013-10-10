<?php
$pageTitle = 'Регистрация на потребител';
include 'includes/header.php';
require 'includes/db_connect.php';
$error = 0;

if (!$connection) {
    echo '<p><div class="alert alert-danger">Фатална грешка!</div></p>';
    exit();
}

if ($_POST) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $data = mysqli_query($connection, 'SELECT * FROM users');

    if (preg_match("/^[0-9a-zA-Z]{5,20}$/", $username) === 1) {
        $sql = 'SELECT username FROM users WHERE username = \'' . $username . '\';';
        $result = mysqli_query($connection, $sql);
        if (!$result) {
            die(mysql_error());
        } else {
            if (mysqli_num_rows($result) > 0) {
                $error = 2;
            } else {
                if (preg_match("/^[0-9a-zA-Z]{5,20}$/", $password) === 1) {
                    $username = mysqli_real_escape_string($connection, $username);
                    $password = mysqli_real_escape_string($connection, $password);
                    mysqli_query($connection, 'INSERT INTO users (username, password) VALUE (\'' . $username . '\',\'' . $password . '\')');
                    header('location: index.php');
                    exit();
                } else {
                    $error = 3;
                }
            }
        }
    } else {
        $error = 4;
    }
}
?>
<ul class="nav nav-tabs nav-justified btn-lg">
    <li ><a href="index.php">Вход</a></li>
    <li class="active"><a href="register.php"><span class="glyphicon glyphicon-chevron-down"></span></a></li>
</ul>
<br/><br/><br/><br/>
<div class="jumbotron">
    <div class="container">
        <div style="float: right"><h1><small>Регистрация на нови потребители!</small></h1></div>
        <form method="POST" name='Вход'>
            <div class="form-group">
                <input type="text" class="form-control" name="username"  placeholder="Потребител" style="width:200px"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Парола" style="width:200px"/>
            </div>
            <div><input type="submit" class="btn btn-default" value="Вход" style="width: 200px"/></div>

        </form>
    </div>

</div>
<?php
if ($error > 0) {
    Error($error);
}

include 'includes/footer.php';
