<?php $pageTitle = "Регистрация"; include_once("includes/header.php"); ?>

<table align="center">
    
    <?php include_once("includes/security.php"); ?>
    
    <tr>
        <td>
            <form method="post">
                <div>Потребител:</div>
                <input type="text" name="username" />
                <div>Парола:</div>
                <input type="password" name="password" />
                <br />
                <input type="submit" name="go" value="Регистрация" />&nbsp;<a href="index.php">Начало</a>
            </form>
        </td>
    </tr>
    
    <tr>
        <td>
            <!-- errors go here -->
            <?php
                if (isset($_POST['go']))
                {
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);
                    
                    if (strlen($username) < 5)
                    {
                        $error = "Името трябва да е поне 5 символа!";
                    }
                    
                    if (strlen($password) < 5)
                    {
                        $error = "Паролата трябва да е поне 5 символа!";
                    }
                    
                    $check = mysqli_query($connection, "SELECT username FROM users WHERE username = '$username'");
                    $result = $check->num_rows;
                    
                    if ($result > 0)
                    {
                        $error = "Вече съществува такъв потребител!";
                    }
                    else if ($result == 0)
                    {
                        $insert = mysqli_query($connection, "INSERT INTO `users`(`id`, `username`, `password`) VALUES (NULL, '$username', '$password')");
                        
                        if ($insert)
                        {
                            echo "Регистрацията е успешна! Влез <a href='index.php'>тук</a>!";
                        }
                        else
                        {
                            echo "Грешка при регистрацията!";
                        }
                    }
                    
                    if (isset($error))
                    {
                        echo $error;
                    }
                }
            ?>
        </td>
    </tr>
</table>

<?php include_once("includes/footer.php"); ?>