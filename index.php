<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CheapoMail</title>
    <link rel="stylesheet" href="styles.css" media="screen" />
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="no_refresh.js" charset="utf-8"></script>
  </head>
  <body>
    <div id="wrapper" class="container">
      <header>
        <h1>CheapoMail</h1>
        <p>
          Where we pay you to use our mail! :p
        </p>
      </header>
      <nav>
        <ul>
          <li><a id="nav-home" href="home.php">Home</a></li>
          <li><a id="nav-about" href="signup.html">Sign Up</a></li>
          <li><a id="nav-contact" href="getinput.php">Login</a></li>
        </ul>
      </nav>
      <main>
        <?php include 'home.php'; ?>
      </main>
    </div>
  </body>
</html>