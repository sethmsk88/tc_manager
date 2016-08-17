<?php
    define("APP_NAME", "Training Calendar Manager");
    define("APP_PATH", "http://" . $_SERVER['HTTP_HOST'] . "./bootstrap/apps/tc_manager/");
    define("APP_HOMEPAGE", "course_list");

    // Include database info and open connection to Database
    require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap/apps/shared/dbInfo.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap/apps/shared/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?></title>

    <!-- Linked Stylesheets -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../css/navbar-custom1.css" rel="stylesheet">
    <link href="../css/master.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) (must be above the other script includes) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Included Scripts -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/js/jquery-validation-1.15.0/dist/jquery.validate.min.js"></script>
    <script src="/bootstrap/js/jquery-validation-1.15.0/dist/additional-methods.min.js"></script>
    <script src="../../js/bootstrap-datepicker.min.js"></script>
    <script src="../../js/bootstrap-confirmation.js"></script>
    <script src="./js/main.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Analytics Tracking -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "\bootstrap\apps\shared\analyticstracking.php") ?>
</head>
<body>
    <?php
        // Analytics tracking script
        include_once($_SERVER['DOCUMENT_ROOT'] . "\bootstrap\apps\shared\analyticstracking.php");

        // Include FAMU logo header
        include "../templates/header_3.php";
    ?>
    <!-- Nav Bar -->
    <nav
        id="pageNavBar"
        class="navbar navbar-default navbar-custom1 navbar-static-top"
        role="navigation"
        >
        <div class="container">
            <div class="navbar-header">
                <button
                    type="button"
                    class="navbar-toggle"
                    data-toggle="collapse"
                    data-target="#navbarCollapse"
                    >
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?page=<?= APP_HOMEPAGE ?>"><?= APP_NAME ?></a>
            </div>

            <div id="navbarCollapse" class="collapse navbar-collapse">
                <!-- Nav Links -->
                <ul class="nav navbar-nav">
                    <li id="homepage-link">
                        <a id="navLink-homepage" href="?page=<?=APP_HOMEPAGE?>">Homepage</a> 
                    </li>
                    <li>
                        <a id="navLink-addCourse" href="?page=add_course">Add Course
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <?php
    	// If a page variable exists, include the page
    	if (isset($_GET["page"])){
    		$filePath = './content/' . $_GET["page"] . '.php';
    	}
    	else{
    		$filePath = './content/' . APP_HOMEPAGE . '.php';
    	}

    	if (file_exists($filePath)){
			include $filePath;
		}
		else{
			echo '<h2>404 Error</h2>Page does not exist';
		}
    ?>

    <!-- Footer -->
    <?php include "../templates/footer_1.php"; ?>

</body>
</html>
