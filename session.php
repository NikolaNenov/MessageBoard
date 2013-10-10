<?php
$pageTitle = 'регистриран потребител';
include 'includes/header.php';
require 'includes/db_connect.php';

$filter = '';
if (!$_SESSION) { //Login check.
    if (!$_SESSION['isLogged']) {
        header('location: index.php');
        exit();
    }
}

if ($_SESSION) { //Admin check.
    if ($_SESSION['is_admin'] == true) {
        header('location: admin.php');
        exit();
    }
}

if ($_POST) {
    if ($_POST['logout']) {
        session_destroy();
        header('location: index.php');
        exit();
    }
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
        <table class="table">
            <tr style="font-weight: bold">
                <td>дата</td>
                <td>категория</td>
                <td>автор</td>
                <td>заглавие</td>
                <td>съобщение</td>
            </tr>
            <?php
            $sql = 'SELECT * FROM messages as m INNER JOIN users as u ON m.user_id = u.user_id INNER JOIN groups as g ON m.category_id = g.category_id ORDER BY date DESC' . $filter;
            $messages = mysqli_query($connection, $sql);
            echo mysqli_error($connection);
            while ($row = $messages->fetch_assoc()) {
                echo '<tr style="color: white">
                    <td>' . date("m.d.Y", strtotime($row["date"])) . ' </td>
                    <td>' . $row['name'] . ' </td>
                    <td>' . $row['username'] . ' </td>
                    <td>' . $row['title'] . ' </td> 
                    <td>' . $row['text'] . '</td>
                 </tr>';

                $filter_username[] = $row['username'];
                $filter_group[] = $row['name'];
            }
            ?>
        </table>
    </div>
</div>

<?php
include 'includes/footer.php';






