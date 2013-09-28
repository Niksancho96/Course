<?php
    session_start();
    if (isset($_SESSION['loggedIn'])) $userPath = realpath("files/" . $_SESSION['loggedIn']);
?>
<!DOCTYPE html>

<html>
    <header>
        <title><?php echo $pageTitle; ?></title>
        <meta charset="UTF-8">
    </header>
    
    <body>