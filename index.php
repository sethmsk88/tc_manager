<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle="Training Calendar Manager"; ?></title>

    <!-- Linked Stylesheets -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../css/master.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) (must be above the other script includes) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Included Scripts -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/js/jquery-validation-1.13.1/dist/jquery.validate.js"></script>
    <script src="../../js/bootstrap-datepicker.min.js"></script>
    <script src="../../js/bootstrap-confirmation.js"></script>
    <script src="./scripts/main.js"></script>
    <script src="./scripts/manager.js"></script>

    <!-- Included UDFs -->
    <?php include "../shared/query_UDFs.php" ?>

    <!-- Included Scripts -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>    
    <!-- Google Analytics Tracking -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "bootstrap\apps\shared\analyticstracking.php") ?>

    <?php

        // Global Variables
        $eventTable = "tc_event";

        // Include my database info
        include "../shared/dbInfo.php";

        // Set Application Path
        $appPath = "http://10.123.100.18/bootstrap/apps/tc_manager/";

        // Set application homepage
        $homepage = "manager";

    	// If a page variable exists, include the page
    	if (isset($_GET["page"])){
    		$filePath = './content/' . $_GET["page"] . '.php';
    	}
    	else{
    		$filePath = './content/' . $homepage . '.php';
    	}


        // Include Header
        $headerText = "Training Calendar Manager";
        include "../templates/header_1.php";

    	if (file_exists($filePath)){
			include $filePath;
		}
		else{
			echo '<h2>404 Error</h2>Page does not exist';
		}

    ?>




  </body>
</html>
