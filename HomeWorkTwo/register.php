<?php $pageTitle = "Register"; include_once("includes/header.php"); ?>

<?php
    if (isset($_SESSION['loggedIn']))
    {
        header("Location: files.php");
    }
    
    if (isset($_POST['send']))
    {
        $username = htmlspecialchars($_POST['username']);
        $username = str_replace("-", "", $username);
        
        $password = htmlspecialchars($_POST['password']);
        $password = str_replace("-", "", $password);
        
        if (strlen($username) < 3)
        {
            $error = "Прекалено късо име!";
        }
        
        if (strlen($password) < 3)
        {
            $error = "Прекалено къса парола!";
        }
        
        $file = "database/users.txt";
        $read = file($file);

        foreach ($read as $var)
        {
            $col = explode("-", $var);
            if ($col[0] == $username)
            {
                die("Потребителя вече съществува! <a href='register.php'>Назад</a>");
            }
        }

        $newLine = $username . "-" . $password . PHP_EOL;
        $operation = file_put_contents("database/users.txt", $newLine, FILE_APPEND);

        if ($operation)
        {
            $userDir = "files/" . $username;
            mkdir($userDir);
            echo "Регистрацията мина успешно!";
        }
        else
        {
            echo "Регистрацията не мина успешно!";
        }
        
        if (isset($error))
        {
            echo $error;
        }
    }
?>

<form method="post">
    <div>Потребителско име:</div>
    <input type="text" name="username" />
    <div>Парола:</div>
    <input type="password" name="password" />
    <br />
    <input type="submit" name="send" value="Регистрация" />&nbsp;<a href="index.php">Начало</a>
</form>

<?php include_once("includes/footer.php"); ?>