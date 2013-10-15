<?php $pageTitle = "Нов автор"; include_once("includes/header.php"); ?>

<a href="index.php">Книги</a>
<form method="post">
    <div>Автор:</div>
    <input type="text" name="author" />
    <input type="submit" name="go" value="Запиши" />
</form>

<?php
    if (isset($_POST['go']))
    {
        $author = htmlspecialchars($_POST['author']);
        
        if (strlen($author) <= 3)
        {
            $error = "Името на автора трябва да е по-дълго от 3 символа!";
        }
        
        $query = mysqli_query($connection, "SELECT author_name FROM authors WHERE author_name = '$author'");
        $result = $query->num_rows;
        
        if ($result > 0)
        {
            $error = "Вече съществува такъв автор!";
        }
        
        if (!isset($error))
        {
            $insert = mysqli_query($connection, "INSERT INTO authors (author_id, author_name) VALUES (NULL, '$author')");
            if ($insert)
            {
                echo "Автора добавен успешно!";
            }
            else
            {
                echo "Грешка!";
            }
        }
        else
        {
            echo $error;
        }
    }
?>

<table>
    <tr>
        <th>Въведени автори:</th>
    </tr>
    <?php
        $data = mysqli_query($connection, "SELECT * FROM authors");
        while ($row = mysqli_fetch_assoc($data))
        {
    ?>
    <tr>
        <td>
            <a href="show.php?author=<?php echo $row['author_id']; ?>"><?php echo $row['author_name']; ?></a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php include_once("includes/footer.php"); ?>