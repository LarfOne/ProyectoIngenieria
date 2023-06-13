<nav class="navbar navbar-inverse fixed-top" style="background-color: rgb(0, 80, 146)">
  <div class="container-fluid" >
    <div class="navbar-header">
     
      <img style=" width: 55px; height: 46px; margin: 5px;margin-top: 2.5px " src="view/img/empresa/logoBlanco.png">
      <!--<img style=" width: 80px; height: 30px; margin: 0px;margin-top: 0px " src="view/img/empresa/LetrasStock.png">-->
      
    </div>
    <div>
    <!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
        <ul class="nav navbar-nav navbar-right">
         <li>
             <img style=" width: 25px; margin: 0.4px;margin-top: 13px " src=""> 
          </li> 

          <li class="dropdown user user-menu">

             
          <a class="nombreUsuario" style=" color:azure; ">  
          
              <span class="hidden-xs"><?php  echo $_SESSION["nombre"]; ?></span>
              <span class="hidden-xs"><?php  echo $_SESSION["apellidos"]; ?></span>
            </a>
          </div>
          </li>
        </ul>
  </div>
  </div>
</nav>