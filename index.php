<?php
$pageTitle = 'Вход';
include 'includes/header.php';
require 'includes/db_connect.php';
$error = 0;

if (!$connection) {
    echo '<p><div class="alert alert-danger">Фатална грешка!</div></p>';
    exit();
}

if ($_SESSION) {
    if ($_SESSION['isLogged'] == true) {
        if ($_SESSION['is_admin'] == true) {
            header('location: admin.php');
            exit();
        }
        header('location: session.php');
        exit();
    }
} else {
    if ($_POST) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $sql = 'SELECT * FROM users WHERE username = \'' . $username . '\' AND password = \'' . $password . '\'';
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = $result->fetch_assoc();
            if ($user['is_admin'] == 1) {
                $_SESSION['isLogged'] = true;
                $_SESSION['is_admin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user['user_id'];
                header('location: admin.php');
                exit();
            }

            $_SESSION['isLogged'] = true;
            $_SESSION['is_admin'] = false;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id'];
            header('location: session.php');
            exit();
        }
        $error = 1;
    }
    ?>
    <ul class="nav nav-tabs nav-justified btn-lg">
        <li class="active"><a href="index.php"><span class="glyphicon glyphicon-chevron-down"></span></a></li>
        <li><a href="register.php">Регистрация</a></li>
    </ul>

    <br/><br/><br/><br/>

    <div class="jumbotron">
        <div class="container">
            <div style="float: right"><h1><small>Вход за регистрирани потребители!</small></h1></div>
            <form method="POST" name='Вход'>
                <div class="form-group">
                    <input type="text" class="form-control" name="username"  placeholder="Потребител" style="width:200px"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Парола" style="width:200px"/>
                </div>
                <div style="position "><input type="submit" class="btn btn-default" value="Вход" style="width: 200px"/></div>
            </form>
        </div>
    </div>

    <?php
    if ($error > 0) {
        Error($error);
    }
}
include 'includes/footer.php';
