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
        background-image: url(desk.jpg);
        background-position: center;
        background-repeat: no-repeat;
        min-width: 50vw;
    }      

    
    .item3 {
        background-image: url(helpdesk1.jpg);
        background-position: center;
        background-repeat: no-repeat;
        padding-left: 0.5em;
        padding-right: 0.5em;
        padding-bottom: 5em;
        padding-top: 5em;
        font-size: 2em;
        min-width: 5vw;
        border-radius: 15%;
    }      


</style>
</head>


<body>
<body>
  <div class="grid-container5">
    <h2 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to AlphaTech IT Support!</h2>
    

    <div class="item1">
    </div>

    <div class="item2">
            <div class="nav">
                <nav>
                    <b>
                    <a href="index.php">Home</a>  &nbsp;
                    <a href="index1.php">Tickets</a>  &nbsp;
                    <a href="create.php">Create a Ticket</a> &nbsp;
                    <a href="help.php">Help</a> &nbsp;
                    <a href="logout.php">Sign Out</a>
                    </b>
                </nav>
            </div> 
    </div>    

    <div class="item3">
        <p>
            Here at AlphaTech we strive to handle your IT support needs in an efficient and timely matter! To get started,
            <a href="create.php">Click Here</a> or use our navigation panel located in the upper right hand corner. While you 
            wait for your ticket resolution please feel free to visit our <a href="help.php">Help Page</a> for additional support!  
        </p>
    </div>
  </div>

        <footer>
            <small><i>2020 &copy; Austin Allen Portfolio<br>
            <a href="austinadairtestemail@yahoo.com">austinadair39@yahoo.com.com</a></i></small>
        </footer>

</body>
</html>