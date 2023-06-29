<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Green Ville</title>
</head>
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<body>
  <nav>
    <div class="container">
      <div class="logo">Green Ville</div>
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#rooms">Rooms</a></li>
        <li><a href="#facilities">Facilities</a></li>
        <li class="contact-section">
          <a href="#" id="contact-button">Contact Us</a>
        </li>
        <?php if (!$isLoggedIn) { ?>
          <li class="login-register">
            <a href="#" id="login-button">Login</a>
          </li>
          <li class="login-register">
            <a href="#" id="register-button">Register</a>
          </li>
        <?php } else { ?>
          <li>
            <span class="session-name"><?php echo $_SESSION['name']; ?></span>
          </li>
          <form action="administrator/code.php" method="POST">
            <li class="logout-button">
              <button type="submit" id="logout" name="logout">Log Out</button>
            </li>
          </form>
        <?php } ?>
      </ul>
    </div>
  </nav>
  <header id="home">
    <div class="header-content">
      <h1>Welcome to Green Ville</h1>
      <p>Experience our cozy place</p>
    </div>
  </header>


  <?php

  if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo '<div class="my-warning-box"><span class="my-close-icon">&times;</span> <h2>Notification</h2>' . $_SESSION['message'] . '</div>';
    $_SESSION['message'] = null;
  }
  ?>
  <script>
    setTimeout(function() {
      var warningBox = document.querySelector('.my-warning-box');
      warningBox.style.display = 'none';
    }, 2000);
  </script>


  <section class="rooms" id="rooms">
    <h2>Our Rooms</h2>
    <div class="room">
      <img src="https://i.pinimg.com/736x/c9/91/bb/c991bbfa252c64e3beae5d474386c1cc.jpg" alt="Room 1" />
      <h3>Normal Room</h3>
      <p>IDR 500.000 Per Month</p>
      <?php if ($isLoggedIn) { ?>
        <a href="book.php"><button>Book Now</button></a>
      <?php } else { ?>
        <a href="index.php"><button>Please Log In First!</button></a>
      <?php } ?>
    </div>
    <div class="room">
      <img src="https://i.pinimg.com/564x/ff/98/33/ff9833add66ac22f03a473a31dc05c03.jpg" alt="Room 2" />
      <h3>Premium Room</h3>
      <p>IDR 1.000.000 per Month</p>
      <?php if ($isLoggedIn) { ?>
        <a href="book.php"><button>Book Now</button></a>
      <?php } else { ?>
        <a href="index.php"><button>Please Log In First!</button></a>
      <?php } ?>
    </div>
    <div class="room">
      <img src="https://i.pinimg.com/564x/a8/de/b9/a8deb95161ef20e2689eb2276e9a9b57.jpg" alt="Room 3" />
      <h3>Executive Room</h3>
      <p>IDR 2.000.000 per Month</p>
      <?php if ($isLoggedIn) { ?>
        <a href="book.php"><button>Book Now</button></a>
      <?php } else { ?>
        <a href="index.php"><button>Please Log In First!</button></a>
      <?php } ?>
    </div>
  </section>

  <section class="facilities" id="facilities">
    <div id="section_icon" class="section_icon section_services container mt-3">
      <h4 class="text-center mb-2">Facilities</h4>
      <div class="row d-flex justify-content-center d-md-none">
        <div class="col-3 icon-card">
          <img src="icon/kitchen.svg" alt="Kitchen" />
          <p class="mb-0">Kitchen</p>
        </div>
        <div class="col-3 icon-card">
          <img src="icon/bathroom.svg" alt="Inside Bathroom" />
          <p class="mb-0">Inside Bathroom</p>
        </div>
        <div class="col-3 icon-card">
          <img src="icon/laundry.svg" alt="Laundry" />
          <p class="mb-0">Laundry</p>
        </div>
        <div class="col-3 icon-card">
          <img src="icon/vehicle-park.svg" alt="Vehicle Park" />
          <p class="mb-0">Vehicle Park</p>
        </div>
        <div class="col-3 icon-card">
          <img src="icon/air-conditioner.svg" alt="Air Conditioner" />
          <p class="mb-0">Air Conditioner</p>
        </div>
        <div class="col-3 icon-card">
          <img src="icon/wifi-area.svg" alt="Free Wifi" />
          <p class="mb-0">Free Wifi</p>
        </div>
        <div class="col-3 icon-card">
          <img src="icon/rooftop.svg" alt="Rooftop Area" />
          <p class="mb-0">Rooftop Area</p>
        </div>
      </div>
    </div>
  </section>
  <br /><br />
  <section class="comments" id="comments">
    <div class="container">
      <div class="comments-box">
        <div class="comment-label">
          <h2>Comment</h2>
          <i class="fas fa-comment"></i>
        </div>
        <div class="comment-container">
          <div class="comment">
            <div class="avatar">
              <img src="https://i.pinimg.com/564x/4c/85/31/4c8531dbc05c77cb7a5893297977ac89.jpg" alt="User Avatar" />
            </div>
            <div class="comment-details">
              <?php
              require_once 'administrator/dbconfig.php';

              $sql = "SELECT * FROM comment ORDER BY RAND() LIMIT 5";
              $result = $db->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<h3>" . $row['name'] . "</h3>";
                  echo '<p class="comment-text">' . $row['message'] . "</p>";
                }
              } else {
                echo "No comments found.";
              }
              ?>
            </div>
          </div>
          <div class="comment">
            <div class="avatar">
              <img src="https://i.pinimg.com/564x/4c/85/31/4c8531dbc05c77cb7a5893297977ac89.jpg" alt="User Avatar" />
            </div>
            <div class="comment-details">
              <?php
              require_once 'administrator/dbconfig.php';

              $sql = "SELECT * FROM comment ORDER BY RAND() LIMIT 5";
              $result = $db->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<h3>" . $row['name'] . "</h3>";
                  echo '<p class="comment-text">' . $row['message'] . "</p>";
                }
              } else {
                echo "No comments found.";
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <br /><br />
  <footer>
    <p>&copy; Copyright by Green Ville</p>
  </footer>

  <div id="login-form-container">
    <div id="login-form">
      <h2>Login</h2>
      <form action="administrator/code.php" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password :</label>
        <input type="password" id="passwordLogin" name="passwordLogin" required />

        <button type="submit" name="login" id="login">Login</button>
      </form>
      <p><a href="#">Forgot password?</a></p>
    </div>
  </div>

  <div id="register-form-container">
    <div id="register-form">
      <h2>Register</h2>
      <form action="administrator/code.php" method="POST">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password :</label>
        <input type="password" id="password" name="password" required />

        <button type="submit" id="register" name="register">Register</button>
      </form>
    </div>
  </div>
  <div id="contact-form-container">
    <div id="contact-form">
      <h2>Contact Us</h2>
      <form action="administrator/code.php" method="POST">
        <label for="nameLabel">Name :</label>
        <input type="text" id="name" name="name" required />

        <label for="emailLabel">Email :</label>
        <input type="email" id="email" name="email" required />

        <label for="messageLabel">Message :</label>
        <input type="text" id="message" name="message" required />

        <button type="submit" id="contact" name="contact">Send Message</button>
      </form>
    </div>
  </div>

</body>


</html>
<script>
  const contactButton = document.getElementById("contact-button");
  const contactFormContainer = document.getElementById("contact-form-container");

  contactButton.addEventListener("click", function() {
    contactFormContainer.classList.toggle("show");
  });

  contactFormContainer.addEventListener("click", function(event) {
    if (event.target === contactFormContainer) {
      contactFormContainer.classList.remove("show");
    }
  });
  const loginButton = document.getElementById("login-button");
  const loginFormContainer = document.getElementById("login-form-container");

  loginButton.addEventListener("click", function() {
    loginFormContainer.classList.toggle("show");
  });

  loginFormContainer.addEventListener("click", function(event) {
    if (event.target === loginFormContainer) {
      loginFormContainer.classList.remove("show");
    }
  });
  const registerButton = document.getElementById("register-button");
  const registerFormContainer = document.getElementById(
    "register-form-container"
  );

  registerButton.addEventListener("click", function() {
    registerFormContainer.classList.toggle("show");
  });

  registerFormContainer.addEventListener("click", function(event) {
    if (event.target === registerFormContainer) {
      registerFormContainer.classList.remove("show");
    }
  });

  const navLinks = document.querySelectorAll(".nav-links a");

  for (const link of navLinks) {
    link.addEventListener("click", function(event) {
      event.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      window.scrollTo({
        top: target.offsetTop,
        behavior: "smooth"
      });
    });
  }

  var closeIcon = document.querySelector('.my-close-icon');
  var warningBox = document.querySelector('.my-warning-box');

  closeIcon.addEventListener('click', function() {
    warningBox.style.display = 'none';
  });
  window.addEventListener('load', function() {
    setTimeout(function() {
      var warningBox = document.querySelector('.my-warning-box');
      warningBox.style.display = 'none';
    }, 2000);
  });
</script>