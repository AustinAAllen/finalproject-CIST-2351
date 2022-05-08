<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
// Output message variable
$msg = '';
// Check if POST data exists (user submitted the form)
if (isset($_POST['title'], $_POST['email'], $_POST['msg'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['title']) || empty($_POST['email']) || empty($_POST['msg'])) {
        $msg = 'Please complete the form!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please provide a valid email address!';
    } else {
        // Insert new record into the tickets table
        $stmt = $pdo->prepare('INSERT INTO tickets (title, email, msg) VALUES (?, ?, ?)');
        $stmt->execute([ $_POST['title'], $_POST['email'], $_POST['msg'] ]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        header('Location: view.php?id=' . $pdo->lastInsertId());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="description" content="Austin Allen's test website. Welcome to my site!">
<meta name="keywords" content="Austin Allen, test, site, welcome, web, design">
<meta name="author" content="Austin Allen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="stylesheet" href= "final.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
<style>
    .item1 {
        background-image: url(projects.jpg);
        background-position: center;
        background-repeat: no-repeat;
        min-width: 50vw;
    }    
</style>
</head>

<body>
<div class="grid-container5">
	<h2>Create A Ticket</h2>
    <div class="item1">
    </div>

    <div class="item2">
            <div class="nav">
                <nav>
                    <b>
                    <a href="index.php">Home</a>  &nbsp;
                    <a href="index1.php">Tickets</a>  &nbsp;
                    <a href="create.php">Create a Ticket</a>  &nbsp;
                    <a href="help.php">Help</a> &nbsp;
                    <a href="logout.php">Sign Out</a>
                    </b>
                </nav>
            </div> 
    </div>    


    <div class="item3">

    <p>Please use the form below to create a ticket</p>


    <form action="create.php" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title" id="title" required>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="johndoe@example.com" id="email" required>
        <label for="msg">Message</label>
        <textarea name="msg" placeholder="Enter your message here..." id="msg" required></textarea>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
    </div>
</div>

        <footer>
            <small><i>2020 &copy; Austin Allen Portfolio<br>
            <a href="austinadairtestemail@yahoo.com">austinadair39@yahoo.com.com</a></i></small>
        </footer>

</body>
</html>

