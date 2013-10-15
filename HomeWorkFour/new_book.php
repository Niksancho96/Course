<?php $pageTitle = "Нова книга"; include_once("includes/header.php"); ?>

<a href="index.php">Книги</a>
<form method="post">
    <div>Книга:</div>
    <input type="text" name="book" />
    <div>Автори:</div>
    <select multiple name="authors[]">
        <?php
            $data = mysqli_query($connection, "SELECT * FROM authors");
            while ($row = mysqli_fetch_assoc($data))
            {
        ?>
        <option value="<?php echo $row['author_id']; ?>"><?php echo $row['author_name']; ?></option>
        <?php
            }
        ?>
    </select>
    <br />
    <input type="submit" name="go" value="Запиши" />
</form>

<?php
    if (isset($_POST['go']))
    {
        $bookName = htmlspecialchars($_POST['book']);
        
        if (@$_POST['authors'] == NULL)
        {
            $error = "Трябва да изберете поне 1 автор!";
        }
        else
        {
            foreach ($_POST['authors'] as $value)
            {
                $authors[] = (int)$value;
            }
        }
        
        if (strlen($bookName) <= 3)
        {
            $error = "Твърде късо име!";
        }
        
        if (!isset($error))
        {
            $addBook = mysqli_query($connection, "INSERT INTO books (book_id, book_title) VALUES (NULL, '$bookName')");
            if (!$addBook)
            {
                echo "Грешка при добавянето заглавие на книгата!";
            }
            
            $res = mysqli_insert_id($connection);
            
            foreach ($authors as $val)
            {
                $vales[] = "($res, $val)";
            }
            
            $addAuthors = mysqli_query($connection, "INSERT INTO books_authors VALUES " . implode(',', $vales) . "");
            if (!$addAuthors)
            {
                echo "Грешка при добавянето на автори!";
            }
            
            echo "Успешно добавена нова книга!";
        }
        else
        {
            echo $error;
        }
    }
?>

<?php include_once("includes/footer.php"); ?>