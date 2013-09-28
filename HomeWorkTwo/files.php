<?php $pageTitle = "Files"; include_once("includes/header.php"); ?>
    
<?php
    if (isset($_SESSION['loggedIn']))
    {
        echo "Добре дошъл, <b>" . $_SESSION['loggedIn'] . "</b> отново! <a href='logout.php'>Излез?</a><br />";
        echo "<a href='upload.php'>Качи нов файл</a>";
        
        $content = scandir($userPath);
    }
    else if (!isset($_SESSION['loggedIn']))
    {
        die("Трябва да се впишете в системата за да видите тази страница! <a href='index.php'>Назад</a>");
    }
    
    if (count($content) <= 2)
    {
        echo "Няма качени твои файлове!";
    }
    else
    {
?>
    <table border="1" align="center">
        <tr>
            <th>Име:</th>
            <th>Размер:</th>
        </tr>
        <?php
                for ($index = 2; $index < count($content); $index ++)
                {
                     $size = filesize($userPath . DIRECTORY_SEPARATOR . $content[$index]) / 1024;
                     $link = '<a href="download.php?file=' . $content[$index] . '" >' . $content[$index] . '</a>';
        ?>
            <tr>
                <td><?php echo $link; ?></td>
                <td><?php echo (int)$size . " KB"; ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
<?php
    }
?>

<?php include_once("includes/footer.php"); ?>