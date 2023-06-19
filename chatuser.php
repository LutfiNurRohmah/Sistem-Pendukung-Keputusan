<?php 
require "konek.php";
require_once("auth.php");

function loginForm() {
  echo '
<center>
<div class="form-group">
  <th class="nav" align="center"><img src="images/logo.png" width="180" height="180"  style="margin:10px 0px 10px 0px"></th>
  <strong><marquee behavior="alternate">Welcome to MyLiveChat</marquee></span></font></strong>
</div>
</center>

<div id="loginform" style="padding: 5px 30px">
  </br>
  <form action="chatuser.php" method="post">
  <h1>Live Chat</h1><hr/>
    <label for="name">Masukkan nama untuk memulai chat</label>
    <input style="width: 300px; margin-bottom: 5px;" type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name" value="'.$_SESSION["user"]["nama_lengkap"].'"/>
    <input type="submit" class="btn btn-default" name="enter" id="enter" value="Enter" />
  </form>
</div>
 ';
}

if (isset ( $_POST ['enter'] )) {
  if ($_POST ['name'] != "") {
      $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
  $user = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
  $cb = fopen ( "log.html", 'a' );
      fwrite ( $cb, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat.</i><br></div>" );
      fclose ( $cb );
  } else {
      echo '<span class="error">Please Enter a Name</span>';
  }
}

if (isset ( $_GET ['logout'] )) {
  $cb = fopen ( "log.html", 'a' );
  fwrite ( $cb, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat.</i><br></div>" );
  fclose ( $cb );
  // session_destroy ();
  header ( "Location: chatuser.php" );

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Live Chat</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css">
	<script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <ul class="navbar-nav">
      <li>
        <a class="nav-link text-white"  href="#" role="button"> <large><b>Desicion Support System - Rekomendasi Laptop</b></large></a>
      </li>
    </ul>
	<ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="logout_admin.php" role="button">
          Logout
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-light elevation-4">
    <a href="#" class="brand-link bg-light" aria-expanded="true">
      <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo "" ?></span>
      <span class="brand-text text-primary"><?php echo $_SESSION["user"]["nama_lengkap"] ?></span>
    </a>
   	
    <div class="sidebar">
      <nav class="mt-2">
      <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="home_user.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                  </a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="fuzzy2.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Rekomendasi Laptop
                  </a>
                </li>
                <li class="nav-item active bg-primary text-light">
                  <a class="nav-link" href="chatuser.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Live Chat
                  </a>
                </li>
                
              </ul>
        
      </nav>
    </div>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light">
  	 <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-body text-white">
	    </div>
	  </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="col-lg-12">
      
                        <?php
		
        if (!isset( $user )) {
        loginForm();
        } else {
	      ?>
				<div id="wrapper" style="padding: 5px 30px">
		<div id="menu">
			<h1>Live Chat!</h1><hr/>
			<p class="welcome"><b>HI - <a><?php echo $_SESSION["user"]["nama_lengkap"]; ?></a></b></p>
			<p class="logout"><a id="exit" href="#" class="btn btn-default">Exit Live Chat</a></p>
			<div style="clear: both"></div>
		</div>

		<div id="chatbox">
			<?php
			if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
				$handle = fopen ( "log.html", "r" );
				$contents = fread ( $handle, filesize ( "log.html" ) );
				fclose ( $handle );
				echo $contents;
			}
			?>
		</div>

		<form name="message" action="">
			<input style="margin:10px 0px 5px 0px" name="usermsg" class="form-control" type="text" id="usermsg" placeholder="Create A Message" />
			<input name="submitmsg" class="btn btn-default" type="submit" id="submitmsg" value="Send" />
		</form>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#submitmsg").click(function(){
				var clientmsg = $("#usermsg").val();
				$.post("post.php", {text: clientmsg});             
				$("#usermsg").attr("value", "");
				loadLog;
				return false;
			});

			function loadLog(){    
				var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
				$.ajax({
					url: "log.html",
					cache: false,
					success: function(html){       
						$("#chatbox").html(html);       
						var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
						if(newscrollHeight > oldscrollHeight){
							$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
						}              
					},
				});
			}

			setInterval (loadLog, 2500);

			$("#exit").click(function(){
				var exit = confirm("Are You Sure You Want To Leave This Page?");
				if(exit==true){window.location = 'chatuser.php?logout=true';}
				

			});
		});
	</script>
	<?php
	}
	?>	
            </div>
      
  </div>
          <!-- </main> -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
</div>
</body>

</html>