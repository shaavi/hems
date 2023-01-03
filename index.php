<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}


?>
<div class="card ">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>Welcome ආයුබෝවන් வணக்கம்<strong>
        <span class="badge badge-lg badge-secondary text-white">
          <?php
          $username = Session::get('username');
          if (isset($username)) {
            echo $username;
          }
          ?></span>

      </strong></span></h3>
  </div>
  <script src="https://www.gstatic.com/charts/loader.js">
  </script>
  <script async src="https://cse.google.com/cse.js?cx=d36ca9a4004004733"></script>
  <div class="gcse-search"></div>
  <div class="card-body pr-2 pl-2">
    <button type="button" class="btn btn-primary active" onclick="changeLangEnglish()">English</button>
    <button type="button" class="btn btn-primary" onclick="changeLangSinhala()">සිංහල</button>
    <button type="button" class="btn btn-primary" onclick="changeLangTamil()">தமிழ்</button>
    <hr>
    <div class="container" id="english" style="display:block">
      <center>
        <h1>My Home - Electricity Consumption</h1>
      </center>
      <hr>
      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-4">
            <h3>Daily Energy Consumption</h3>
            <p>The chart below depicts the daily energy consumption pattern.</p>
            <div id="energyChart" style="max-width:auto; height:auto"></div>
          </div>
          <div class="col-sm-4">
            <h3>Active Appliances</h3>
            <p>The chart below depicts the energy consumption of currently active appliances.</p>
            <div id="deviceChart" style="max-width:auto; height:auto"></div>
          </div>
          <div class="col-sm-4">
            <h3>Threshold Value</h3>
            <p>Set the threshold to get instant notification alerts.</p>
            <br>
            <form>
              <div class="form-outline" style="width: 22rem;">
                <input value="50" type="number" id="typeNumber" class="form-control" />
              </div>
              <br>
              <button type="submit" class="btn btn-primary">Set</button>
              <button type="reset" class="btn btn-primary">Reset</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container" id="sinhala" style="display:none">
      <center>
        <h1>මගේ ගෙදර - විදුලි පරිභෝජනය</h1>
      </center>
      <hr>
      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-4">
            <h3>වත්මන් බලශක්ති භාවිතය</h3>
            <p>පහත වගුවේ දැක්වෙන්නේ දෛනික බලශක්ති පරිභෝජන රටාවයි.</p>
            <div id="energyChart2" style="max-width:auto; height:auto"></div>
          </div>
          <div class="col-sm-4">
            <h3>ක්රියාකාරී උපකරණ</h3>
            <p>පහත ප්‍රස්ථාරයෙන් දැක්වෙන්නේ දැනට ක්‍රියාත්මක වන උපකරණවල බලශක්ති පරිභෝජනයයි.</p>
            <div id="deviceChart2" style="max-width:auto; height:auto"></div>
          </div>
          <div class="col-sm-4">
            <h3>සීමාව අගය</h3>
            <p>ක්ෂණික දැනුම්දීම් ඇඟවීම් ලබා ගැනීමට එළිපත්ත සකසන්න.</p>
            <br>
            <form>
              <div class="form-outline" style="width: 22rem;">
                <input value="50" type="number" id="typeNumber" class="form-control" />
              </div>
              <br>
              <button type="submit" class="btn btn-primary">තහවුරු කරන්න</button>
              <button type="reset" class="btn btn-primary">යළි පිහිටුවන්න</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container" id="tamil" style="display:none">
      <center>
        <h1>என் வீடு - மின்சார நுகர்வு</h1>
      </center>
      <hr>
      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-4">
            <h3>தற்போதைய ஆற்றல் பயன்பாடு</h3>
            <p>கீழே உள்ள விளக்கப்படம் தினசரி ஆற்றல் நுகர்வு முறையை சித்தரிக்கிறது.</p>
            <div id="energyChart3" style="max-width:auto; height:auto"></div>
          </div>
          <div class="col-sm-4">
            <h3>செயலில் உள்ள உபகரணங்கள்</h3>
            <p>கீழே உள்ள விளக்கப்படம் தற்போது செயலில் உள்ள சாதனங்களின் ஆற்றல் நுகர்வைக் காட்டுகிறது.</p>
            <div id="deviceChart3" style="max-width:auto; height:auto"></div>
          </div>
          <div class="col-sm-4">
            <h3>வரம்பு மதிப்பு</h3>
            <p>உடனடி அறிவிப்பு விழிப்பூட்டல்களைப் பெற, வரம்பை அமைக்கவும்.</p>
            <br>
            <form>
              <div class="form-outline" style="width: 22rem;">
                <input value="50" type="number" id="typeNumber" class="form-control" />
              </div>
              <br>
              <button type="submit" class="btn btn-primary">உறுதி</button>
              <button type="reset" class="btn btn-primary">மீட்டமை</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  google.charts.load('current', {
    packages: ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    // Set Data
    var data = google.visualization.arrayToDataTable([
      ['Day', 'Units'],
      [21, 3],
      [22, 2],
      [23, 2],
      [24, 3],
      [25, 4],
      [26, 6],
      [27, 2],
      [28, 2],
      [29, 4],
      [30, 3],
      [31, 3]
    ]);
    // Set Options
    var options = {
      hAxis: {
        title: 'Day'
      },
      vAxis: {
        title: 'Units'
      },
      legend: 'none'
    };
    // Draw
    var chart = new google.visualization.LineChart(document.getElementById('energyChart'));
    chart.draw(data, options);
    var chart = new google.visualization.LineChart(document.getElementById('energyChart2'));
    chart.draw(data, options);
    var chart = new google.visualization.LineChart(document.getElementById('energyChart3'));
    chart.draw(data, options);
  }
</script>

<script>
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Device', 'kWh'],
      ['Toaster', 55],
      ['Refrigerator', 49],
      ['Computer', 44],
      ['Microwave Oven', 24],
      ['Television', 15]
    ]);

    var options = {
      hAxis: {
        title: 'Energy Usage (kWh)'
      },
      vAxis: {
        title: 'Devices'
      },
      legend: 'none'
    };

    var chart = new google.visualization.BarChart(document.getElementById('deviceChart'));
    chart.draw(data, options);
    var chart = new google.visualization.BarChart(document.getElementById('deviceChart2'));
    chart.draw(data, options);
    var chart = new google.visualization.BarChart(document.getElementById('deviceChart3'));
    chart.draw(data, options);
  }
</script>

<script>
  function changeLangSinhala() {
    var x = document.getElementById("sinhala");
    var y = document.getElementById("english");
    var z = document.getElementById("tamil");
    if (x.style.display === "none") {
      x.style.display = "block";
      y.style.display = "none";
      z.style.display = "none";
    } else {
      x.style.display = "none";
      y.style.display = "block";
      z.style.display = "none";
    }
  }

  function changeLangEnglish() {
    var x = document.getElementById("sinhala");
    var y = document.getElementById("english");
    var z = document.getElementById("tamil");
    if (y.style.display === "none") {
      y.style.display = "block";
      x.style.display = "none";
      z.style.display = "none";
    } else {
      y.style.display = "none";
      x.style.display = "block";
      z.style.display = "none";
    }
  }

  function changeLangTamil() {
    var x = document.getElementById("sinhala");
    var y = document.getElementById("english");
    var z = document.getElementById("tamil");
    if (z.style.display === "none") {
      z.style.display = "block";
      x.style.display = "none";
      y.style.display = "none";
    } else {
      z.style.display = "none";
      y.style.display = "block";
      x.style.display = "none";
    }
  }
</script>
<?php
include 'inc/footer.php';

?>