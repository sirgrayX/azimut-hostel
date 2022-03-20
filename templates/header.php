<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Фавикон -->
    <link rel="shortcut icon" href="../images/icon.svg" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="script" href="js/bootstrap.js">
    <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <!-- Свои стили -->
    <link rel="stylesheet" type="text/css" href="css/hotel.css">

    <!-- Google Fonts, Font-family: Comfortaa -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/2bfd91de00.js" crossorigin="anonymous"></script>

    <title>Аzимут</title>
  </head>
  <body>
    <header class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <div id="logo"></div>
            <h1><a href="/">Аzимут</a></h1>
          </div>
          <nav class="col-8">
             <ul>
               <li><a href="index.php?page=index"><i class="fa-solid fa-hotel"></i>Главная</a></li>
               <li><a href="index.php?page=rooms"><i class="fa-solid fa-book"></i>Номера</a></li>
               <?php if(isset($_SESSION['id_user'])): ?>
                <li><a href='index.php?page=profile'><i class ='fa fa-user'></i><?php echo $_SESSION['user_email'];?></a>
                  <ul>
                    <li><a href="index.php?page=logout">Выход</a></li>
                  </ul>
                </li> 
              <?php else: ?>
                <li><a href='index.php?page=login'><i class ='fa fa-user'></i>Вход</a>
                  <ul>
                    <li><a href="index.php?page=registration">Регистрация</a></li>
                  </ul>
                </li>
              <?php endif; ?> 
             </ul>
          </nav>
        </div>
      </div>
    </header>