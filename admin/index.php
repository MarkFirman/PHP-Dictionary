<?php
/**********************************************************************************
* Project : MyDictionary.co.uk
* Author  : Mark Firman - www.markfirman.co.uk
* Date	  : 19/02/2020
* index.php - This page handles all administrator
* *********************************************************************************

	/* Turn off error reporting for this page only */
	error_reporting(0);

	/* Include the header */
	include_once('header.php');

	/* Check if a valid user session has been set */
	if(!isset($_SESSION['id']) && $_SESSION['id'] != "24061994"){
		
		/* You are not authorised to view this page */
		include_once("./pages/401.php");
		exit;

	}

	/* Check if we are requesting a specific page */
	if(isset($_GET['page'])){
		
		/* Check if the page can be found */
		$page = $_GET['page'];
		
	} else {
		
		/* Page was not specified, so load the dashboard */
		$page = "dashboard";
		
	}

?>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">MyDictonary.co.uk</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
			
			<!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" id="searchform" action="./index.php?page=search" method="post">
                <div class="input-group">
                    <input class="form-control" id="searchtext" name="searchtext" type="text" placeholder="Word quick find..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" id="searchbutton"></input>
                    </div>
                </div>
            </form>
			
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?page=settings">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                    </div>
                </li>
            </ul>
			
        </nav>
		
		
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
				<!-- Sidebar Navigation -->
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php"><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard</a>
							
                            <div class="sb-sidenav-menu-heading">Dictionary</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-word"></i></div>
                                Words
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="index.php?page=words">Manage</a><a class="nav-link" href="index.php?page=newword">Add New</a></nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Manage</div>
                            <a class="nav-link" href="index.php?page=users">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Users</a>
								
								
							<div class="sb-sidenav-menu-heading">Application</div>
							<a class="nav-link" href="index.php?page=settings">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Settings</a>	
                            <a class="nav-link" href="index.php?page=quiz">
                                <div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>
                                Quiz Game</a>	
								
                            <a class="nav-link" href="index.php?page=twitterbot">
                                <div class="sb-nav-link-icon"><i class="fab fa-twitter"></i></div>
                                Twitter Bot</a>
								
								<a class="nav-link" href="index.php?page=api">
                                <div class="sb-nav-link-icon"><i class="fas fa-spell-check"></i></div>
                                Dictionary API</a>
								
								
							<div class="sb-sidenav-menu-heading">Pages</div>
							<a class="nav-link" href="index.php?page=pagefooter"><div class="sb-nav-link-icon"><i class="fas fa-shoe-prints"></i></div>Footer</a>
							<a class="nav-link" href="index.php?page=pagewordoftheday"><div class="sb-nav-link-icon"><i class="fas fa-sun"></i></div>Homepage</a>
							<a class="nav-link" href="index.php?page=pagecss"><div class="sb-nav-link-icon"><i class="fab fa-css3-alt"></i></div>CSS</a>
								
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$_SESSION['username'];?>
                    </div>
                </nav>
				<!-- End sidebar navigation -->
            </div>
			
            <div id="layoutSidenav_content">
          
				<?php
					/* Content Pages go Here */
					include_once("./pages/".$page.".php");
				?>
				
				<!-- Page Footer -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; MyDictionary.co.uk 2020</div>
                            <div style="display:none">
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
				<!-- End Page Footer -->
				
            </div>
        </div>
		<!-- Include Jquery, Bootstrap, Charts and DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
		
		<script>
			// Call the dataTables jQuery plugin
			$(document).ready(function() {
			  $('#dataTable').DataTable();
			});
		</script>
		
    </body>
</html>
