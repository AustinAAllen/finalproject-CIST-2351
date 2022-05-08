<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM tickets ORDER BY created DESC');
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
    <h2> My Tickets</h2>
	<div class="item1">
    </div>

	<div class="item2">
            <div class="nav">
                <nav>
                    <b>
                    <a href="index.php">Home</a>  &nbsp;
					<a href="create.php">Create Ticket</a> &nbsp;  
					<a href="logout.php">Sign Out</a>
                    </b>
                </nav>
            </div> 
    </div>    


<div class="item3">

	<div class="tickets-list">
		<?php foreach ($tickets as $ticket): ?>
		<a href="view.php?id=<?=$ticket['id']?>" class="ticket">
			<span class="con">
				<?php if ($ticket['status'] == 'open'): ?>
				<i class="far fa-clock fa-2x"></i>
				<?php elseif ($ticket['status'] == 'resolved'): ?>
				<i class="fas fa-check fa-2x"></i>
				<?php elseif ($ticket['status'] == 'closed'): ?>
				<i class="fas fa-times fa-2x"></i>
				<?php endif; ?>
			</span>
			<span class="con">
				<span class="title"><?=htmlspecialchars($ticket['title'], ENT_QUOTES)?></span>
				<br>
				<span class="msg"><?=htmlspecialchars($ticket['msg'], ENT_QUOTES)?></span>
				<br>
			</span>
			<span class="con created"><?=date('F dS, G:ia', strtotime($ticket['created']))?> <hr></span>
		</a>
		<?php endforeach; ?>
	</div>
  </div>
</div>

        <footer>
            <small><i>2020 &copy; Austin Allen Portfolio<br>
            <a href="austinadairtestemail@yahoo.com">austinadair39@yahoo.com.com</a></i></small>
        </footer>
</body>
</html>



