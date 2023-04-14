<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body img src="imagen/login.jpg">
 <div class="container">
  
 	<div class="header">
   <div class="login-logo">
    <img src="imagen/mouseLamp.png"
        class="img-responsive" style="padding:0px 100px 0px 110px">
  </div>
 		<h3 style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important;">Ingrese al Sistema</h3y>
 	</div>
 	<div class="main">

 		<form method="post">
 			<span>
 				<i class="fa fa-user"></i>
 				<input type="text" placeholder="Usuario" name="ingUser" style="border-radius: 7px;">
 			</span><br>
 			<span>
 				<i class="fa fa-lock"></i>
 				<input type="password" placeholder="Contraseña" name="ingPassword" style="border-radius: 7px;">
 			</span><br>
      
      <div class="row">
        
        <button style="text-align:center; font-family: 'Roboto Condensed', sans-serif !important; border-radius: 7px;"">Ingresar</button>
        
      </div>


    <?php
       
       $login = new ControllerUser();
       $login->ctrLoginUser();
    ?>

 		</form>

 	</div>
 </div>
</body>
</html>