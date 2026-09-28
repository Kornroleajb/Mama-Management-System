<?php

ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');

if (isset($_REQUEST['option']))
{
    $option = $_REQUEST['option'];
}
else 
{
    $option = "logs";
}

if (isset($_REQUEST['task']))
{
    $task = $_REQUEST['task'];
}
else 
{
    $task = "logs_form";
}
?>


<!DOCTYPE html> 
<html>
<head>
    <title>
        Mama
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="styles.css">

  

</head>
<body>
    <?php 
    if(isset($_SESSION['alert'])){
    ?>
     <div class="container-fluid fixed-top pt-2">
        <div class="alert alert-<?php echo $_SESSION['type']; ?> top-0 start-50 translate-middle-x w-25 alert-dismissible" role="alert">
            <button class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo $_SESSION['alert']; ?>
        </div>
    </div>
<?php
    unset($_SESSION['alert'],$_SESSION['type']);
    }

require_once("class.connect.php");
if(isset($_SESSION['uid'])){
    require_once("class.menu.php");
}
require_once("class.".$option.".php");
$clas = new $option();
$clas->$task();
?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<script language='javascript' src='jab.js'></script>
<script src="project.js"></script>
</html>