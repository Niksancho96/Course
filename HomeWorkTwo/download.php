<?php include_once("includes/header.php"); ?>
    <?php
        $fileName = $_GET['file'];
        $fileName = 'files/' . $_SESSION['loggedIn'] . "/" . $fileName;
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($fileName));
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: binary");
        readfile($fileName);
    ?>
<?php include_once("includes/footer.php"); ?>