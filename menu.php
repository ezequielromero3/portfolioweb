
<nav class="navbar navbar-expand-md">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon fa fa-bars"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php echo isset($_GET['pg']) && $_GET['pg'] =='index'? 'active': '';?>" href="index.php?pg=index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo isset($_GET['pg']) && $_GET['pg'] =='sobremi'? 'active': '';?>" href="sobre-mi.php?pg=sobremi">Sobre mí</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  <?php echo isset($_GET['pg']) && $_GET['pg'] =='portfolio'? 'active': '';?>" href="portfolio.php?pg=portfolio">Portfolio</a>
      </li>
      <li class="nav-item">
      	<a class="nav-link <?php echo isset($_GET['pg']) && $_GET['pg'] =='contacto'? 'active': '';?>" href="contacto.php?pg=contacto">Contacto</a>
      </li>
      </ul>
    </nav>

