<!DOCTYPE html>
<?php 
  $username = "";
  $password = "";  
  $alert = "";
  $info = NULL;
  if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])){
  } else {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    require "database-connection.php";
    $info = get_participant_info($username);
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
    <a href="#home" class="w3-bar-item w3-button"><b>WEB Summit 2018</b></a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right">
      <a href="index.php#about" class="w3-bar-item w3-button">Giới thiệu</a>
      <a href="#contact" class="w3-bar-item w3-button">Liên hệ</a>
      <?php 
        if ($username == "") {
          echo '<a href="login.php#login" class="w3-bar-item w3-button">Đăng nhập</a>';
          echo '<a href="signup.php#signup" class="w3-bar-item w3-button">Đăng ký</a>';
        } else {
          if ($info['role'] == 'Admin') echo '<a href="manager.php" class="w3-bar-item w3-button">Quản lý</a>';
          else echo '<a href="participant-information.php" class="w3-bar-item w3-button">Info</a>';
          echo '<a href="logout.php" class="w3-bar-item w3-button">Đăng xuất</a>';
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

 

  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Giới thiệu</h3>
    <p>Vietnam Web Summit là sự kiện công nghệ có quy mô lớn nhất hiện nay với việc diễn ra lần lượt tại cả 2 thành phố lớn là Hồ Chí Minh và Hà Nội. Quy tụ phần lớn người làm công nghệ, từ sinh viên cho đến chuyên gia, và các cấp quản lý trong các công ty công nghệ. Sự kiện được tổ chức bởi đơn vị đã tổ chức rất thành công sự kiện thường niên lớn nhất cả nước về di động Vietnam Mobile Day – TopDev giải pháp tuyển dụng hàng đầu trong lĩnh vực Mobile & IT chuyên cung ứng nhân sự cho các công ty công nghệ.</p>

    <p>Đây cũng là cơ hội để khán giả có thể cập nhật được những kiến thức chuyên sâu nhất từ các chuyên gia hàng đầu về các xu hướng công nghệ mới nhất hiện nay.</p>

    <p>Năm 2017, với sự tham dự của hơn 10000 lượt khán giả cùng gần 100 diễn giả, 200 doanh nghiệp cùng 50 báo đài đồng hành, Vietnam Web Summit vẫn duy trì là sân chơi nổi bật nhất làng công nghệ cứ mỗi dịp cuối năm.</p>

    <p>Năm nay, dự kiến diễn ra với quy mô lớn hơn với dàn nội dung 120 chủ đề, được xem là đồ sộ nhất từ trước đến nay, không chỉ các chủ đề về công nghệ và kỹ thuật như Cloud, Server, Architecture, Cybersecurity, Data Science, Frontend,... một thời lượng lớn liên quan đến Social Media, Digital Marketing, Blockchain, Fintech, UX/UI, AI, Bigdata, Machine Learning cũng sẽ do các chuyên gia đầu ngành tham gia chia sẻ.
    </p>
  </div>
  <?php 

  ?>
  <div class="w3-row-padding w3-grayscale">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="w3images/team2.jpg" alt="John" style="width:100%">
      <h3>John Doe</h3>
      <p class="w3-opacity">CEO & Founder</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="w3images/team1.jpg" alt="Jane" style="width:100%">
      <h3>Jane Doe</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="w3images/team3.jpg" alt="Mike" style="width:100%">
      <h3>Mike Ross</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="w3images/team4.jpg" alt="Dan" style="width:100%">
      <h3>Dan Star</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
  </div>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contact</h3>
    <p>Lets get in touch and talk about your next project.</p>
    <form action="/action_page.php" target="_blank">
      <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required name="Email">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Subject" required name="Subject">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Comment" required name="Comment">
      <button class="w3-button w3-black w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> SEND MESSAGE
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
