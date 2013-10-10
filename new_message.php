<?php
$pageTitle = 'Публикувай ново съобщение';
include 'includes/header.php';
require 'includes/db_connect.php';
$error = 0;

if (!$_SESSION) { //Login check.
    if (!$_SESSION['isLogged']) {
        header('location: index.php');
        exit();
    }
}
if ($_POST) {
    $group = trim($_POST['group']);
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);

    if (mb_strlen($title, 'utf8') > 0 AND mb_strlen($title, 'utf8') < 51) {
        if (mb_strlen($message, 'utf8') > 0 AND mb_strlen($message, 'utf8') < 250) {
            $group = mysqli_real_escape_string($connection, $group);
            $title = mysqli_real_escape_string($connection, $title);
            $message = mysqli_real_escape_string($connection, $message);
            $data = mysqli_query($connection, 'INSERT INTO messages (category_id, title, text, user_id) VALUE (\'' . $group . '\',\'' . $title . '\',\'' . $message . '\',\'' . $_SESSION['user_id'] . '\')');
            header('location: session.php');
            exit();
        } else {
            $error = 5;
        }
    } else {
        $error = 6;
    }
}
?>
<ul class="nav nav-tabs nav-justified btn-lg">
    <li ><a href="session.php">Всички съобщения</a></li>
    <li class="active"><a href="new_message.php">Ново съобщение</a></li>
    <li ><a href="logout.php">Изход</a></li>
</ul>
</br></br></br></br>

<div class="jumbotron">
    <div class="container">
        <form method="POST" name='Вход'>
            <div class="input-group input-group">
                <span class="input-group-addon" style="color:white">Група</span>
                <select class="form-control" style="width:235px" name="group">
                    <?php
                    $groups = mysqli_query($connection, 'SELECT * FROM groups');
                    while ($row = $groups->fetch_assoc()) {
                        echo '<option value=' . $row['category_id'] . '>' . $row['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <br/>
            <div>
                <input class="form-control" style="width:300px" type="text" name="title" placeholder="заглавие"/>
            </div>
            <br/>
            <div><textarea class="form-control" style="width:300px" name="message"  rows="5" cols="50" placeholder="текст"></textarea>
                <br/>
                <div>
                    <input type="submit" class="btn btn-default" style="width: 300px" value="Публикувай"/>
                </div>
        </form>
    </div>
</div>
</div>

<?php
if ($error > 0) {
    Error($error);
} 


