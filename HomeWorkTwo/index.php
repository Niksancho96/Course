<?php $pageTitle = "Index"; include_once("includes/header.php"); ?>

<table align="center">
    <form method="post">
        <div>Username:</div>
        <input type="text" name="username" />
        <div>Password:</div>
        <input type="password" name="password" />
        <br />
        <input type="submit" name="login" value="Влез" />&nbsp;<a href="register.php">Регистрация</a>
    </form>
</table>

<?php
    if (isset($_POST['login']))
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        if (file_exists("database/users.txt"))
        {
            $fetch = file("database/users.txt");
            
            foreach ($fetch as $value)
            {
                $record = explode("-", $value);
                $getUser = $record[0];
                $getPassword = $record[1];
            }
        }
        else
        {
            $error = "Users.txt не съществува!";
        }
        
        if ($username == $getUser && $password == $getPassword)
        {
            $_SESSION['loggedIn'] = $username;
            header("Location: files.php");
        }
        else
        {
            $error = "Грешно потребителско име или парола!";
        }
        
        if ($error)
        {
            echo $error;
        }
    }
    else if (isset ($_SESSION['loggedIn']))
    {
        header("Location: files.php");
    }
?>

<?php include_once("includes/footer.php"); ?>