<!DOCTYPE html>
<?php 
  $username = "";
  $password = "";
  $alert = "";
  if (isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    header("location: index.php");
  }
  if (isset($_COOKIE['alert'])){
    $alert = $_COOKIE['alert'];
    setcookie("alert", "", time()-1);
  }
?>
<html>
<link rel="icon" href="favicon.jpg">
<title>WEB Summit Conference Hanoi</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="index.php" class="w3-bar-item w3-button"><b>WEB Summit 2018</b></a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right">
      <a href="index.php#about" class="w3-bar-item w3-button">Giới thiệu</a>
      <a href="#contact" class="w3-bar-item w3-button">Liên hệ</a>
      <?php 
        if ($username == "") {
          echo '<a href="login.php#login" class="w3-bar-item w3-button">Đăng nhập</a>';
          echo '<a href="signup.php#signup" class="w3-bar-item w3-button">Đăng ký</a>';
        }
       ?>   
    </div>
  </div>
</div>
<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="w3images/architect.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>WEB Summit 2018</b></span></h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">


  <!-- Contact Section -->
  <div class="w3-container w3-padding-32" id="login">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Đăng nhập</h3>
    <?php 
      if ($alert == 'login-failed') echo "<p class='w3-text-red'>Sai tên đăng nhập hoặc mật khẩu</p>";
     ?>
    <form action="validate-login.php" method="POST" id="form" enctype="multipart/form-data">
      <div class="w3-section">
        <label>Tên đăng nhập</label>
        <input type="text" name="username" class="w3-input">
      </div>
      <div class="w3-section">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="w3-input">
      </div>
      <input type="text" name="type" value="login" style="display: none">
      <button class="w3-button w3-black w3-section" type="submit" name="login" value="login">
        <i class="fa fa-paper-plane"></i> ĐĂNG NHẬP
      </button>
    </form>
  </div>
  
<!-- Image of location/map -->
<div class="w3-container">
  <img src="w3images/map.jpg" class="w3-image" style="width:100%">
</div>

<!-- End page content -->
</div>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>
</body>
</html>
