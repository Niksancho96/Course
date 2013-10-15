<?php $pageTitle = "Книги от Автор"; include_once("includes/header.php"); ?>

<?php
    
    $authorID = (int) $_GET['author'];
    if ($authorID <= 0)
    {
        die("Невалидно ID!");
    }
    
    $sql = "SELECT books.book_title, authors.author_name, authors.author_id
    FROM books
    LEFT JOIN books_authors ON books.book_id = books_authors.book_id
    LEFT JOIN authors ON authors.author_id = books_authors.author_id
    WHERE books.book_title in (SELECT books.book_title
    FROM books
    LEFT JOIN books_authors ON books.book_id = books_authors.book_id
    LEFT JOIN authors ON authors.author_id = books_authors.author_id
    WHERE authors.author_id = '$authorID')";
    
    $query = mysqli_query($connection, $sql);
    $res = $query->num_rows;
    
    if ($res == 0)
    {
        die("Този автор все още няма издадени книги!");
    }
    else
    {
?>
<center><a href='index.php'>Книги</a></center>
        <table align='center' border='1'>
            <tr>
                <th>Книги от този автор:</th>
                <th>Други автори:</th>
            </tr>
            <?php
                while ($data = mysqli_fetch_assoc($query))
                {
            ?>
            <tr>
                <td>
                    <?php echo $data['book_title']; ?>
                </td>
                <td>
                    <a href="show.php?author=<?php echo $data['author_id']; ?>"><?php echo $data['author_name']; ?></a>
                </td>
            </tr>
                <?php } ?>
        </table>
<?php
    }
?>
    
<?php include_once("includes/footer.php"); ?>