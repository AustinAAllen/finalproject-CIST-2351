<?php
include 'functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// Check if the ID param in the URL exists
if (!isset($_GET['id'])) {
    exit('No ID specified!');
}
// MySQL query that selects the ticket by the ID column, using the ID GET request variable
$stmt = $pdo->prepare('SELECT * FROM tickets WHERE id = ?');
$stmt->execute([ $_GET['id'] ]);
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if ticket exists
if (!$ticket) {
    exit('Invalid ticket ID!');
}

if (isset($_GET['status']) && in_array($_GET['status'], array('open', 'closed', 'resolved'))) {
    $stmt = $pdo->prepare('UPDATE tickets SET status = ? WHERE id = ?');
    $stmt->execute([ $_GET['status'], $_GET['id'] ]);
    header('Location: view.php?id=' . $_GET['id']);
    exit;
}

if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // Insert the new comment into the "tickets_comments" table
    $stmt = $pdo->prepare('INSERT INTO tickets_comments (ticket_id, msg) VALUES (?, ?)');
    $stmt->execute([ $_GET['id'], $_POST['msg'] ]);
    header('Location: view.php?id=' . $_GET['id']);
    exit;
}
$stmt = $pdo->prepare('SELECT * FROM tickets_comments WHERE ticket_id = ? ORDER BY created DESC');
$stmt->execute([ $_GET['id'] ]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    .btn {
    display: inline-block;
    outline: 0;
    cursor: pointer;
    text-align: center;
    border: 0;
    padding: 7px 16px;
    min-height: 36px;
    min-width: 36px;
    color: #ffffff;
    background:  #52ab989a;
    border-radius: 4px;
    font-weight: 500;
    font-size: 14px;
    box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 0px 0px, rgba(0, 0, 0, 0.2) 0px -1px 0px 0px inset;
    }
</style>
</head>


<body>
<div class="grid-container5">
<h2>CONGRATS! Help is on the way!</h2>
        <div class="item1">
        </div>

        <div class="item2">
            <div class="nav">
                <nav>
                    <b>
                    <a href="index.php">Home</a>  &nbsp;
                    <a href="index1.php">Tickets</a>  &nbsp;
                    <a href="create.php">Create Ticket</a>  &nbsp;
                    <a href="logout.php">Sign Out</a>
                    </b>
                </nav>
            </div> 
        </div>    


    <div class="item3">   

	    <?=htmlspecialchars($ticket['title'], ENT_QUOTES)?> <span class="<?=$ticket['status']?>">(<?=$ticket['status']?>)</span>

        <div class="ticket">
            <p class="created"><?=date('F dS, G:ia', strtotime($ticket['created']))?></p>
            <p class="msg"><?=nl2br(htmlspecialchars($ticket['msg'], ENT_QUOTES))?></p>
        </div>

        <div class="btns">
            <a href="view.php?id=<?=$_GET['id']?>&status=closed" class="btn">Close</a>
            <a href="view.php?id=<?=$_GET['id']?>&status=resolved" class="btn">Resolve</a>
        </div>

        <div class="comments">
            <?php foreach($comments as $comment): ?>
            <div class="comment">
                <div>
                    <i class="fas fa-comment fa-2x"></i>
                </div>
                <p>
                    <span><?=date('F dS, G:ia', strtotime($comment['created']))?></span>
                    <?=nl2br(htmlspecialchars($comment['msg'], ENT_QUOTES))?>
                </p>
            </div>
            <?php endforeach; ?>
            <form action="" method="post">
                <textarea name="msg" placeholder="Enter your comment..."></textarea>
                <input type="submit" value="Post Comment">
            </form>
        </div>
    </div>
</div>

        <footer>
            <small><i>2020 &copy; Austin Allen Portfolio<br>
            <a href="austinadairtestemail@yahoo.com">austinadair39@yahoo.com.com</a></i></small>
        </footer>

</body>
</html>
