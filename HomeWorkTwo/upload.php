<?php $pageTitle = "Upload"; include_once("includes/header.php"); ?>

<?php
    if (isset($_SESSION['loggedIn']))
    {
        if (isset($_POST['upload']))
        {
            if($_FILES)
            {
                if ($userPath == false)
                {
                    $userPath = "files/" . $_SESSION['loggedIn'];
                    mkdir($userPath);
                }
                
                if(move_uploaded_file($_FILES['forUpload']['tmp_name'], $userPath . "/" . $_FILES['forUpload']['name']))
                {
                    echo "Файлът е качен!";
                }
                else
                {
                    echo "Файлът не е качен!";
                }
            }
        }
    }
    else
    {
        die("Трябва да влезнете в системата, за да можете да качвате файлове! <a href='index.php'>Начало</a>");
    }
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="forUpload" />
    <input type="submit" name="upload" value="Качи" />
    <br />
    <a href="files.php">Качени файлове</a>
</form>

<?php include_once("includes/footer.php"); ?>