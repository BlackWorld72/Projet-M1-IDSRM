<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/styles.css">
    <title>Mes Demandes</title>
    <script src="./JS/include_html.js"></script>
    <script src="./JS/STL/three.min.js"></script>
        <script src="./JS/STL/STLLoader.js"></script>
        <script src="./JS/STL/OrbitControls.js"></script>
        <script src="./JS/visualiser_fichier.js"></script>
</head>
<section class="menu">
        <img class="logoLeMansUniversite"
             src="./res/logo-le-mans-universite.png"
             alt="Logo Le Mans Université">
        <ul class="navbar">
            <li><a href="faireunedemande.html">Faire une demande</a>
            <li><a href="prendrerendezvous.html">Prendre un rendez-vous</a>
            <li><a class="active" href="mesdemandes.html">Consulter mes demandes</a>
            <li><a href="?logout=">Déconnexion</a>
        </ul>
</section>
<section>
    <main class="pageDroite">
    <div class="contenuPageDroite">
    <div class="container">
      <header>
			<!-- NAVs de Bootstrap -->
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link active" href="#">Active</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
          <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
        </ul>
        <!-- Fin NAVs de Bootstrap -->
		</header>
		 
		 <br>
	
			<!-- Bootstrap Semantic Buttons -->
			<button type="button" class="btn btn-primary">Primary</button>
			<button type="button" class="btn btn-secondary">Secondary</button>
			<button type="button" class="btn btn-success">Success</button>
			<button type="button" class="btn btn-danger">Danger</button>
			<button type="button" class="btn btn-warning">Warning</button>
			<button type="button" class="btn btn-info">Info</button>
			<button type="button" class="btn btn-light">Light</button>
			<button type="button" class="btn btn-dark">Dark</button>
			<button type="button" class="btn btn-link">Link</button>
			<!-- Fin Bootstrap Semantic Buttons -->
			
	  		<br><br>
	
			<!-- Bootstrap Button Tags -->
			<a class="btn btn-primary" href="#" role="button">Link</a>
			<button class="btn btn-primary" type="submit">Button</button>
			<input class="btn btn-primary" type="button" value="Input">
			<input class="btn btn-primary" type="submit" value="Submit">
			<input class="btn btn-primary" type="reset" value="Reset">
			<!-- Fin Bootstrap Button Tags -->
      		
			<br><br>
	
			<!-- Bootstrap Outline Buttons -->
			<button type="button" class="btn btn-outline-primary">Primary</button>
			<button type="button" class="btn btn-outline-secondary">Secondary</button>
			<button type="button" class="btn btn-outline-success">Success</button>
			<button type="button" class="btn btn-outline-danger">Danger</button>
			<button type="button" class="btn btn-outline-warning">Warning</button>
			<button type="button" class="btn btn-outline-info">Info</button>
			<button type="button" class="btn btn-outline-light">Light</button>
			<button type="button" class="btn btn-outline-dark">Dark</button>
			<!-- Fin Bootstrap Outline Buttons -->

			<br><br>
	
			<!-- Bootstrap Size Buttons: large & small -->
			<button type="button" class="btn btn-primary btn-lg">Large button</button>
			<button type="button" class="btn btn-secondary btn-lg">Large button</button>
			<button type="button" class="btn btn-primary btn-sm">Small button</button>
			<button type="button" class="btn btn-secondary btn-sm">Small button</button>
			<!-- Fin Bootstrap Size Buttons: large & small -->

			<br><br>

			<!-- Bootstrap Block Buttons -->
			<button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
			<button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button>
			<!-- Fin Bootstrap Block Buttons -->

			<br><br>

			<!-- Bootstrap Active Buttons -->
			<a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Primary link</a>
			<a href="#" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Link</a>
			<!-- Fin Bootstrap Active Buttons -->

			<br><br>

			<!-- Bootstrap Disabled/Inactive Buttons -->
			<button type="button" class="btn btn-lg btn-primary" disabled>Primary button</button>
			<button type="button" class="btn btn-secondary btn-lg" disabled>Button</button>
			<!-- Fin Bootstrap Disabled/Inactive Buttons -->

			<br><br>

			<!-- Bootstrap Jumbotron -->
			<div class="jumbotron">
			  <h1 class="display-4">Hello, world!</h1>
			  <p class="lead">This is a simple hero unit, a simple jumbotron-style component.</p>
			  <hr class="my-4">
			  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
			</div>
			<!-- Fin Bootstrap Jumbotron -->

			<br><br>

			<!-- Bootstrap Jumbotron esquinas rectas -->
			<div class="jumbotron jumbotron-fluid">
			  <div class="container">
				 <h1 class="display-4">Fluid jumbotron</h1>
				 <p class="lead">Jumbotron full width without rounded corners: add the .jumbotron-fluid modifier class and add a .container or .container-fluid within.</p>
			  </div>
			</div>
			<!-- Fin Bootstrap Jumbotron esquinas rectas-->

			<br><br>

			<!-- Bootstrap Alertas con link-->
			<div class="alert alert-primary" role="alert">
			  A primary alert with <a href="#" class="alert-link">a link</a> here.
			</div>
			<div class="alert alert-secondary" role="alert">
			  A secondary alert with <a href="#" class="alert-link">a link</a> here.
			</div>
			<div class="alert alert-success" role="alert">
			  A success alert with <a href="#" class="alert-link">a link</a> here.
			</div>
			<div class="alert alert-danger" role="alert">
			  A danger alert with <a href="#" class="alert-link">an link</a> here.
			</div>
			<div class="alert alert-warning" role="alert">
			  A warning alert with <a href="#" class="alert-link">a link</a> here. 
			</div>
			<div class="alert alert-info" role="alert">
			  A info alert with <a href="#" class="alert-link">a link</a> here.
			</div>
			<div class="alert alert-light" role="alert">
			  A light alert with <a href="#" class="alert-link">a link</a> here.
			</div>
			<div class="alert alert-dark" role="alert">
			  A dark alert with <a href="#" class="alert-link">a link</a> here.
			</div>
			<!-- Fin Bootstrap Alertas con link-->

			<br><br>

			<!-- Bootstrap Carousel con controles, indicadores y caption -->
			<div class="bd-example">
		  		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			 		<ol class="carousel-indicators">
						<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
						<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
			 		</ol>
			 		<div class="carousel-inner">
						<div class="carousel-item active">
				  			<img src="https://cdn.dribbble.com/users/255754/screenshots/2939079/vp.jpg" class="d-block w-100 mi-imagen" alt="...">
				  			<div class="carousel-caption d-none d-md-block">
					 			<h5>First slide label</h5>
					 			<p>Párrafo de texto</p>
				  			</div>
						</div>
						<div class="carousel-item">
						  <img src="https://cdn.dribbble.com/users/255754/screenshots/2066715/martian_music.jpg" class="d-block w-100 mi-imagen" alt="...">
						  <div class="carousel-caption d-none d-md-block">
							 <h5>Second slide label</h5>
							 <p>Párrafo de texto</p>
						  </div>
						</div>
						<div class="carousel-item">
						  <img src="https://cdn.dribbble.com/users/255754/screenshots/1602865/raining_light.jpg" class="d-block w-100 mi-imagen" alt="...">
						  <div class="carousel-caption d-none d-md-block">
							 <h5>Third slide label</h5>
							 <p>Párrafo de texto</p>
						  </div>
						</div>
			 		</div>
				 <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				 </a>
				 <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				 </a>
		  		</div>
			</div>
			<!-- Fin Bootstrap Carousel con controles, indicadores y caption -->

			<br><br>

    </div>
    </div>
    </main>
</section>