<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Just Shoes</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Catalogo <span class="sr-only">(current)</span></a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Ricerca Rapida">
        </div>
        <button type="submit" class="btn btn-default">Cerca</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Carrello</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="accedi"><a href="./login.php" >Accedi</a></li>
            <li  id="esci"><a href="./logout.php">Esci</a></li>
            <li><a href="#">Crea Account</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a id="admin-panel" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Amministrazione<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li ><a href="./admin/gestione-categorie.php" >Categorie</a></li>
            <li ><a href="./logout.php">Esci</a></li>
            <li><a href="#">Crea Account</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <?php
    if(isset($_SESSION['logged']) && $_SESSION['logged']==false){
      echo '<script type="text/javascript">'.'$("#esci").hide();$("#accedi").show();</script>';
    }
    else{
      echo '<script type="text/javascript">'.'$("#esci").show();$("#accedi").hide();</script>';
    }

    if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
      echo '<script type="text/javascript">$("#admin-panel").show();</script>';
    }
    else{
      echo '<script type="text/javascript">$("#admin-panel").hide();</script>';
    }
  ?>
