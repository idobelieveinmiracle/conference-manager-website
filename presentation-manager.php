<!DOCTYPE html>
<?php 
  require "database-connection.php";
  $username = "";
  $password = "";  
  $alert = "";
  $info = NULL;
  $role = "";
  $areas = NULL;
  if (isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $role = get_participant_info($username)['role'];
  }
  if (isset($_COOKIE['alert'])){
    $alert = $_COOKIE['alert'];
    setcookie("alert", "", time()-1);
  }

  if (isset($_GET['pre_id'])){
    $info = get_presentation_by_id($_GET['pre_id']);
    $areas = get_seat_areas($_GET['pre_id']);

  }
  if ($info == NULL) {
    echo "wrong info";
    header("location: index.php");
  }
  if ($role != "Admin") {
    echo "wrong role";
    header("location: index.php");
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
          if ($role == 'Admin') echo '<a href="manager.php" class="w3-bar-item w3-button">Quản lý</a>';
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
          <img src="<?php echo $info['pre_img']; ?>" style="width:100%" alt="Avatar" id='avatar'>
        </div>
        <div class="w3-container">
          <p><i class="fa fa-globe-americas fa-fw w3-margin-right w3-large"></i><?php echo $info['pre_name']; ?></p>
          <p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large"></i><?php echo $info['pre_time']." ".$info['pre_date']; ?></p>
          <p><i class="fa fa-clock fa-fw w3-margin-right w3-large"></i><?php echo $info['pre_duration']." tiếng"; ?></p>
          <p><i class="fa fa-user fa-fw w3-margin-right w3-large"></i><?php echo $info['fullname']; ?></p>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large"></i><?php echo $info['position']; ?></p>
          <p><i class="fa fa-building fa-fw w3-margin-right w3-large"></i><?php echo $info['company']; ?></p>     
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-black w3-padding-16"><i class="fa fa-bullhorn fa-fw w3-margin-right w3-xxlarge"></i>Giới thiệu về bài diễn thuyết</h2>
        <div class="w3-container">
          <p><?php 
            if($info['pre_intro'] != NULL && $info['pre_intro'] != "") {
              echo $info['pre_intro'];
            } else echo "Một bài diễn thuyết đáng xem <3";
           ?></p>
        </div>
      </div>
      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-black w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge"></i>Sắp xếp chỗ ngồi</h2>
        <div class="w3-container">
          <h6 class="w3-text-black"><i class="fa fa-list-ul fa-fw w3-margin-right"></i>Danh sách chỗ ngồi</h6>
          <br>
          <div id="pick-area">
            <p>Khu vực</p>
            <select class="w3-select" name="option" id="area-selectors">
              <option value="area" selected>Chưa chọn khu vực</option>
              <?php 
                for ($i = 0; $i < count($areas); $i++){
                  echo '<option value="area">'.$areas[$i].'</option>';
                }
               ?>
            </select>
            
          </div>
          <div id="pick-row">
            <p>Hàng</p>
            <select class="w3-select" name="option" id="row-selectors">
              <option value="" disabled selected>Chọn hàng</option>
            </select>
          </div>
          <br>
          <table class="w3-table-all">
            <thead>
              <tr class="w3-grey">
                <th>Mã chỗ ngồi</th>
                <th>Vị trí</th>
                <th>Mã người ngồi</th>
                <th>Tên người ngồi</th>
              </tr>              
            </thead>
            
          </table>          
          <hr>
        </div>
        <div class="w3-container" id='add-area'>
          <h6 class="w3-text-black"><i class="fa fa-sign-in-alt fa-fw w3-margin-right"></i>Thêm khu vực ngồi ngồi</h6>
          <label>Khu vực</label>
          <input class="w3-input" type="text" id="txt-area"><br>
          <label>Số hàng</label>
          <input class="w3-input" type="text" id="txt-row"><br>
          <label>Số cột</label>
          <input class="w3-input" type="text" id="txt-col"><br>
          <button class="w3-button w3-black" id="add-seats">Thêm</button>
        </div>
        <br>
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
  //  fix image
  var img = document.getElementById("avatar");
  var wid = parseInt(img.width);
  var hei = parseInt(img.height);
  console.log(wid+" "+hei);
  if (hei > (1.2*wid)) hei = 1.2*wid;
  img.height = hei; 

  //  ajax add seats
  document.getElementById("add-seats").addEventListener('click', addSeats);

  function addSeats(){
    var xhr = new XMLHttpRequest();

    var data = "";
    data += "pre_id=<?php echo $info['pre_id'];?>";
    data += "&area="+document.getElementById("txt-area").value;
    data += "&row="+document.getElementById("txt-row").value;
    data += "&col="+document.getElementById("txt-col").value;

    console.log(data);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(xhr.responseText);
        var al = xhr.responseText;
        if (al == 'success'){
          var op = document.createElement('option');
          //var node = document.createTextNode(document.getElementById("txt-area").value);
          op.innerHTML = document.getElementById("txt-area").value;
          op.value = 'area';
          document.getElementById('area-selectors').appendChild(op);

          document.getElementById('txt-area').value = "";
          document.getElementById('txt-row').value = "";
          document.getElementById('txt-col').value = "";
          checkArea();
        }
      }
    };
    xhr.open("POST", "add-seats.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);
  }

  //  ajax get rows after change area
  document.getElementById("area-selectors").addEventListener("change", changeAreaHandling);
  function changeAreaHandling(){
    var selectors = this.childNodes;
    var selected = "";
    for (var i = 0; i < selectors.length; i++){
      if (selectors[i].selected) {
        selected = selectors[i].innerHTML;
      }
    }
    //console.log(selected);
    if (selected != 'Chưa chọn khu vực'){
      var xhr = new XMLHttpRequest();
      //console.log(selected);

      var data = "pre_id=<?php echo $info['pre_id'];?>";
      data += "&area="+selected;

      //console.log(data);

      xhr.open("GET", "get-rows.php?"+data, true);

      xhr.onload = function(){
        if(xhr.status == 200){
          var txt = xhr.responseText;
          //console.log(txt);
          var rowNum = parseInt(txt);
          txt = "<option>Chọn hàng</option>";
          for (var i = 1; i <= rowNum; i++){
            txt += "<option>"+i+"</option>";
          }

          document.getElementById("row-selectors").innerHTML = txt;
        }
      }

      //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send();
    } else {
      document.getElementById("row-selectors").innerHTML = "<option>Chọn hàng</option>";
    }
  }

  function getAreaSelected(){
    var a = document.getElementById('area-selectors');

    var selectors = a.childNodes;
    var selected = "";
    for (var i = 0; i < selectors.length; i++){
      if (selectors[i].selected) {
        return selectors[i].innerHTML;
      }
    }
  }

  //  ajax get seat tables
  document.getElementById("row-selectors").addEventListener("change", changeRowHandling);
  function changeRowHandling(){
    var selectors = this.childNodes;
    var selected = "";
    for (var i = 0; i < selectors.length; i++){
      if (selectors[i].selected) {
        selected = selectors[i].innerHTML;
        break;
      }
    }

    if (selected != 'Chọn hàng'){
      var xhr = new XMLHttpRequest();
      var data = "pre_id=<?php echo $info['pre_id'];?>";
      data += "&area="+getAreaSelected();
      data += "&row="+selected;

      xhr.open("GET", "get-seats.php?"+data, true);

      xhr.onload = function(){
        if(xhr.status == 200){
          var txt = xhr.responseText;
          console.log(txt);
          var seats = JSON.parse(txt);
          
          console.log(seats);

          //document.getElementById("row-selectors").innerHTML = txt;
        }
      }

      xhr.send();
    }
  }


  //  check area
  function checkArea(){
    var areaSelectors = document.getElementById('area-selectors').childNodes;
    
    var co = 0;
    for (var i = 0; i < areaSelectors.length; i++) {
      if (areaSelectors[i].value == 'area') co++;
    }
    console.log(co);
    if (co > 3){
      document.getElementById('add-area').style = 'display: none';
    }
  }
  checkArea();
</script>
</body>
</html>
