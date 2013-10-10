<?php
$pageTitle = "Панел за администрация";
include 'includes/header.php';
require 'includes/db_connect.php';
$error = 0;
$success = 0;


if ($_SESSION) {
    if ($_SESSION['is_admin'] == false) {
        header('location: index.php');
        exit();
    }
    if ($_POST) {

        $deleted = 0;

        foreach ($_POST as $key => $value) {

            if ($value > 0) {
                $sql = 'DELETE FROM messages WHERE message_id=' . $key;
                mysqli_query($connection, $sql);
                $deleted++;
            }
        }

        if ($deleted > 0) {
            $success = 1;
        } else {
            $error = 7;
        }
    }
} else {
    header('location: index.php');
    exit();
}
?>
<ul class="nav nav-tabs nav-justified btn-lg">
    <li class="active"><a href="session.php">Всички съобщения</a></li>
    <li ><a href="new_message.php">Ново съобщение</a></li>
    <li ><a href="logout.php">Изход</a></li>
</ul>
<br/><br/><br/><br/>
<div class="jumbotron">
    <div class="container">
        <form method="POST" name="msgDelete">
            <div>    
                <table class="table" >
                    <tr style="font-weight: bold">
                        <td></td>
                        <td>дата</td>
                        <td>публикувал</td>
                        <td>категория</td>
                        <td>заглавие</td>
                        <td>текст</td>
                    </tr>
                    <?php
                    $sql = 'SELECT * FROM messages as m INNER JOIN users as u ON m.user_id = u.user_id INNER JOIN groups as g ON m.category_id = g.category_id ORDER BY date DESC';
                    $messages = mysqli_query($connection, $sql);
                    while ($row = $messages->fetch_assoc()) {
                        echo '<tr style="color:white">
                                  <td><input type="checkbox" name="' . $row['message_id'] . '" value="1"/></td>
                                   <td>' . date("m.d.Y", strtotime($row["date"])) . ' </td>
                                   <td>' . $row['username'] . ' </td>
                                   <td>' . $row['name'] . ' </td>
                                   <td>' . $row['title'] . ' </td> 
                                   <td>' . $row['text'] . '</td>
                              </tr>';
                        $filter_username[] = $row['username'];
                        $filter_group[] = $row['name'];
                    }
                    ?>
                </table>            
            </div>
            <div><input type="submit" class="btn btn-default" value="Изтрий" style="width: 150px"/></div>
        </form>
    </div>
</div>

<?php
if ($error > 0) {
    Error($error);
}
if ($success > 0) {
    Success($success, $deleted);
}

include 'includes/footer.php';

