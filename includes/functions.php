<?php

function Error($error) {

    switch ($error):

        case 1: {
                echo '<br/><p><div class="alert alert-danger">Грешна парола или потребителско име!</div></p>';
                exit();
            }
        case 2: {
                echo '<br/><p><div class="alert alert-danger">Потребителското име е заето!</div></p>';
                exit();
            }
        case 3: {
                echo '<br/><p><div class="alert alert-danger">Паролата може да съдържа само букви и цифри!</div></p>';
                exit();
            }
        case 4: {
                echo '<br/><p><div class="alert alert-danger">Потребителското име може да съдържа само букви и цифри!</div></p>';
                exit();
            }
        case 5: {
                echo '<br/><p><div class="alert alert-danger">Съобщението трябва да е до 250 символа!</div></p>';
                exit();
            }
        case 6: {
                echo '<br/><p><div class="alert alert-danger">Заглавието трябва да е до 50 символа!</div></p>';
                exit();
            }
        case 7: {
                echo '<br/><p><div class="alert alert-danger">Не се сте избрали съобщение!</div></p>';
                exit();
            }

    endswitch;
}

;

function Success($success, $deleted = 0) {
    switch ($success):
        case 1: {
                echo '<p><div class="alert alert-success">Изтрити съобщения: ' . $deleted . '</div></p>';
                exit();
            }
    endswitch;
}

;