<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title></title>
    <style>
      a{font-family:Georgia, serif;}
      .bg-navy {
        background-color: #18022f; 
        height:40px;
      }

      .btn-logout {
  border: 2px solid white;
  border-radius: 5px;
  padding: 7px 5px;
  color: white;
  background-color: transparent;
  transition: all 0.3s ease-in-out;
  font-size:10px;
}

.btn-logout:hover {
  background-color: white;
  color: #18022f;
}

    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy">
      <div class="container-fluid">
        <a class="navbar-brand" href="findallpostier.php" ></a>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
          </ul>


        </div>
      </div>
    </nav>
    <div class="container">
      <!--afichera le contenu de la variable $title comme le titre principal de la page-->
      <h1><?=$title?></h1>
      <!--affichera le contenu de la variable $container comme le contenu principal de la page.-->
      <?=$container?>
    </div>

  </body>
</html>