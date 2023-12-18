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
        position:absolute;
        top:0px; 
        width: 1540px;
      }
      footer{
        background-color:#18022f;
        width:1533px;
        height:70px;
        position:absolute;
        bottom:0px; 
        left:0px;
      }
      .fond-jaune {
        background-color:#f7c12b;
        width:88px;
        height: 12px;
        position:absolute;
        bottom:59px;
        left:0px;
      }
      .fond-jjaune {
        background-color:#f7c12b;
        width:1375px;
        height: 12px;
        position:absolute;
        bottom:59px;
        right:0px;
      }
   


#out{ background-color: #18022f;}
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-navy">
  <div class="container-fluid">


    <a class="navbar-brand" href="findallpostier.php"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
      <div class="nav-item dropdown">
        <button class="btn btn-secondary dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-user" style="color:white"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="Modifiermdp.php"><i class="fa fa-cog"></i>Paramétre</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Êtes-Vous Sûr De Vous Être connectée!')"><i class="fa fa-sign-out"></i>Se déconnecter</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<script>
  const dropdownMenu = document.querySelector('.dropdown-menu');
const userBtn = document.querySelector('.dropdown-toggle');

userBtn.addEventListener('click', () => {
  dropdownMenu.classList.toggle('show');
});

document.addEventListener('click', (e) => {
  if (!dropdownMenu.contains(e.target) && !userBtn.contains(e.target)) {
    dropdownMenu.classList.remove('show');
  }
});

</script>


    <div class="container">
      <h1><?=$title?></h1>
      <?=$container?>
    </div>
    <footer style="background-color:#18022f">
      <img src="images/hhh.jpg" class="img" style="height: 110px;width: 110px;position:absolute;top:-50px;left:70px">
      <div class="fond-jaune"></div>
      <div class="fond-jjaune"></div>
    </footer> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  </body>
</html>










