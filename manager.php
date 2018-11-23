<!DOCTYPE html>
<?php 
  require "database-connection.php";
  $username = "";
  $password = "";
  $alert = "";
  $info = NULL;
  $presentations = NULL;
  $speakers = NULL;
  if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])){
    header("location: login.php#login");
  } else {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $info = get_participant_info($username);
    $presentations = get_all_presentations();
    $speakers = get_all_speakers();
  }
  if ($info == NULL) {
    header('location: login.php');
  } else {
    if ($info['role'] != 'Admin') header('location: index.php');
  }
?>
<html>
<link rel="icon" href="favicon.jpg">
<title>WEB Summit Conference Hanoi</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<style type="text/css">
  .linkk:hover{
    color: green;
  }
  .linkk:visited .linkk:link .linkk:active{
    color: black;
  }
</style>
<body class="w3-light-grey">

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
        } else {
          if ($info['role'] == 'Admin') echo '<a href="manager.php" class="w3-bar-item w3-button">Quản lý</a>';
          else echo '<a href="participant-information.php" class="w3-bar-item w3-button">Info</a>';
          echo '<a href="logout.php" class="w3-bar-item w3-button">Đăng xuất</a>';
        }
       ?>   
    </div>
  </div>
</div>

<br><br><br>

<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-black w3-card-4">
        <div class="w3-display-container">
          <img src="<?php echo $info['img']; ?>" style="width:100%" alt="Avatar" id='avatar'>
        </div>
        <div class="w3-container">
          <p><i class="fa fa-user-circle fa-fw w3-margin-right w3-large"></i><?php echo $info['username']; ?></p>
          <p><i class="fa fa-user fa-fw w3-margin-right w3-large"></i><?php echo $info['fullname']; ?></p>
          <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-large"></i><?php echo $info['age']; ?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large"></i><?php echo $info['tel']; ?></p>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large"></i><?php echo $info['job']; ?></p>
          <p><i class="fa fa-building fa-fw w3-margin-right w3-large"></i><?php echo $info['company']; ?></p>
          <p><i class="fa fa-circle fa-fw w3-margin-right w3-large"></i><?php echo $info['position']; ?></p>         
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-black w3-padding-16"><i class="fa fa-bullhorn fa-fw w3-margin-right w3-xxlarge"></i>Đôi lời giới thiệu</h2>
        <div class="w3-container">
          <p><?php 
            if($info['intro'] != NULL && $info['intro'] != "") {
              echo $info['intro'];
            } else echo "Một thành viên tham dự hội thảo <3";
           ?></p>
        </div>
      </div>

      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-black w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge"></i>Quản lý hội thảo</h2>
        <div class="w3-container">
          <h6 class="w3-text-black"><i class="fa fa-list-ul fa-fw w3-margin-right"></i>Quản lý bài diễn thuyết</h6>
          <br>
          <table class="w3-table-all">
            <thead>
              <tr class="w3-grey">
                <th>Tên bài diễn thuyết</th>
                <th>Diễn giả</th>
                <th>Bắt đầu</th>
                <th>Thời gian</th>
              </tr>              
            </thead>
            <?php 
              if ($presentations != NULL){
                $len = count($presentations);
                for ($i = 0; $i < $len; $i++){
                  $pre = $presentations[$i]; 
                  ?>
                  <tr>
                    <td><a style="text-decoration: none;" href="presentation-manager.php?pre_id=<?php echo $pre['pre_id'] ?>" class='linkk'><?php echo $pre['pre_name']?></a></td>
                    <td><a style="text-decoration: none;" href="speaker.php?speaker_id=<?php echo $pre['id'] ?>" class='linkk'><?php echo $pre['fullname'] ?></a></td>
                    <td><?php echo $pre['pre_time']." ".$pre['pre_date']; ?></td>
                    <td><?php echo $pre['pre_duration']." tiếng"; ?></td>
                  </tr>
                <?php }
              }
                
             ?>
          </table>
          <br>
          <button class="w3-button w3-black" id="addPresentation">Thêm</button>
          <hr>
        </div>
        <div class="w3-container">
          <h6 class="w3-text-black"><i class="fa fa-sign-in-alt fa-fw w3-margin-right"></i>Quản lý diễn giả</h6>
          <br>
          <table class="w3-table-all">
            <thead>
              <tr class="w3-grey">
                <th>Mã diễn giả</th>
                <th>Tên diễn giả</th>
                <th>Công ty</th>
                <th>Chức vụ</th>
              </tr>              
            </thead>
            <?php 
              if ($speakers != NULL){
                $len = count($speakers);
                for ($i = 0; $i < $len; $i++){
                  $pre = $speakers[$i]; 
                  ?>
                  <tr>
                    <td><?php echo $pre['id']?></td>
                    <td><a style="text-decoration: none;" href="speaker.php?speaker_id=<?php echo $pre['id'] ?>" class='linkk'><?php echo $pre['fullname'] ?></a></td>
                    <td><?php echo $pre['company']; ?></td>
                    <td><?php echo $pre['position']; ?></td>
                  </tr>
                <?php }
              }
                
             ?>
          </table>
          <br>
          <button class="w3-button w3-black" id="addSpeaker">Thêm</button>
          <br>
          <br>
        </div>
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>
<br><br>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>
<script type="text/javascript">
  var img = document.getElementById("avatar");
  var wid = parseInt(img.width);
  var hei = parseInt(img.height);
  console.log(wid+" "+hei);
  if (hei > (1.2*wid)) hei = 1.2*wid;
  img.height = hei; 
</script>
</body>
</html>
