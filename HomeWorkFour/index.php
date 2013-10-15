<?php $pageTitle = "Начало"; include_once("includes/header.php"); ?>

<table align="center" border="1">
    
    <center><a href="new_book.php">Нова книга</a>&nbsp;<a href="new_author.php">Нов автор</a></center>  
    <tr>
        <th>Книга:</th>
        <th>Автор(и):</th>
    </tr>
    
    <?php
        $sql = "
            SELECT books.book_id, books.book_title, authors.author_id, authors.author_name
            FROM books
            LEFT JOIN books_authors
            ON books.book_id = books_authors.book_id
            LEFT JOIN authors
            ON authors.author_id = books_authors.author_id
            WHERE books.book_title in (
            SELECT books.book_title
            FROM books
            LEFT JOIN books_authors ON books.book_id = books_authors.book_id
            LEFT JOIN authors ON authors.author_id = books_authors.author_id
            )";
        
        $query = mysqli_query($connection, $sql);
        if (!$query)
        {
            echo "Грешка в заявката!";
        }
        
        while ($data = mysqli_fetch_assoc($query))
        {
    ?>
    <tr>
        <td><?php echo $data['book_title']; ?></td>
        <td>
              <a href="show.php?author=<?php echo $data['author_id']; ?>"><?php echo $data['author_name']; ?></a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php include_once("includes/footer.php"); ?>