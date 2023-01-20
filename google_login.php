
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>HRMS</title>
    <link rel="shortcut icon" href="<?php echo base_url(). 'assets/img/favicon.ico' ?>" type="image/x-icon"
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url().'assets/css/sb-admin-2.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/vendor/fontawesome-free/css/all.min.css'; ?>" rel="stylesheet" type="text/css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url().'assets/css/signin1.css'; ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'; ?>">
  </head>
 
 <body class="text-center" style="background-color:#fff !important">
  <form class="form-signin" method="post" style="max-width:500px !important" action="">
  <div class="logoimage">
  
    <img src="./assets/img/logo.png"  alt="Zetech University">
  </div>
  <h1 class="h3 mb-10 font-weight-normal textheading">HRMS</h1
  <div class="container">
   <br />
   <h2 align="center" style="color:#fff">HRMS Leave Management System</h2>
   <br />
   <div class="panel panel-default">
   <?php
   if(!isset($login_button))
   {

    $user_data = $this->session->userdata('user_data');
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$user_data['profile_picture'].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name : </b>'.$user_data["first_name"].' '.$user_data['last_name']. '</h3>';
    echo '<h3><b>Email :</b> '.$user_data['email_address'].'</h3>';
    echo '<h3><a href="'.base_url().'welcome/logout">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
 </body>
</html>
