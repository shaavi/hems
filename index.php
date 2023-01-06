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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
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
        <h1>My Home - Electricity Monitoring & Management</h1>
      </center>
      <hr>
      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-4">
            <h3>Cumulative Power</h3>
            <hr>
            <p>Usage History as at, <span id='date-time'></span>. </p>
            <p> % of Power Used</p>
            <br>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
            </div>
            <br>
            <p> % of Power Remaining</p>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">75%</div>
            </div>
          </div>
          <div class="col-sm-4">
            <h3>Active Appliances</h3>
            <hr>
            <p>Top 3 appliances make up 70.3% of the net usage.</p>

            <div id="deviceChart" style="width:auto; height:280px;"></div>
          </div>
          <div class="col-sm-4">
            <?php
            $useridentity = Session::get('id');
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "energy";

            // connect db with server
            $conn = new mysqli($servername, $username, $password, $dbname);

            // if error occurs
            if ($conn->connect_errno) {
              die("Connection failed: " . $conn->connect_error);
            }

            // execute query
            $sql = "SELECT device.device_name, power.current FROM power INNER JOIN device ON power.device_fk = device.device_id WHERE power.user_fk=$useridentity ORDER BY power.current DESC";
            $sql2 = "SELECT current, temperature FROM power WHERE user_fk=$useridentity";
            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);

            ?>
            <h3>Threshold Values</h3>
            <hr>
            <p>Set the power usage limits.</p>
            <form action="threshold_action.php">
              <div class="form-outline" style="width: 22rem;">
                <label for="threshold1">Daily Limit (kWh):</label>
                <input type="number" value="2" id="threshold1" class="form-control" />
              </div>
              <br>
              <div class="form-outline" style="width: 22rem;">
                <label for="threshold2">Weekly Limit (kWh):</label>
                <input type="number" value="14" id="threshold2" class="form-control" />
              </div>
              <br>
              <div class="form-outline" style="width: 22rem;">
                <label for="threshold3">Monthly Limit (kWh):</label>
                <input type="number" value="60" id="threshold3" class="form-control" />
              </div>
              <br>
              <button type="submit" class="btn btn-primary">Set</button>
              <button type="reset" class="btn btn-primary">Reset</button>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <br>
            <h3>Manage Devices</h3>
            <hr>
            <p>Turn ON/OFF active devices.</p>
            <form action="switch_action.php">
              <?php
              $query = "SELECT device_name FROM device WHERE user_fk=$useridentity";
              $output = mysqli_query($conn, $sql);
              while ($rowOutput = mysqli_fetch_assoc($output)) {
                echo "<div class='custom-control custom-switch'>";
                echo "<input type='checkbox' class='custom-control-input' id='";
                echo $rowOutput['device_name'];
                echo "' checked/>";
                echo "<label class='custom-control-label' for='";
                echo $rowOutput['device_name'];
                echo "'>";
                echo $rowOutput['device_name'];
                echo "</label>";
                echo "</div>";
              }
              ?>
              <button type=" submit" class="btn btn-primary mt-3">Submit</button>
              <button type="reset" class="btn btn-primary mt-3">Reset</button>
            </form>
          </div>
          <div class="col-sm-4">
            <br>
            <h3>Predicted Power</h3>
            <hr>
            <p>Predicted Temperature & Power.</p>
            <div id="energyChart" style="max-width:auto; height:auto"></div>
          </div>
          <div class="col-sm-4">
            <br>
            <h3>Bill Calculation</h3>
            <hr>
            <p>Calculate your electricity bill.</p>
            Units: <input type="number" id="units" name="units" min="1" max="300" value="1">
            <input type="button" value="Calculate" onclick="calculate()">
            <br><br>
            <p>The total expected cost is Rs: <span id="bill"></span></p>
            <p> ** Note: The value above can change based on electricity suppliers tariff changes.</p>
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
            <div id="deviceChart2" style="width:auto; height:280px;"></div>
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
            <div id="deviceChart3" style="width:auto; height:280px;"></div>
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
      ['Power', 'temperature'],
      <?php
      // fetch data
      while ($test = mysqli_fetch_array($result2)) {
        echo "['" . $test['current'] . "', " . $test['temperature'] . "],";
      }
      ?>
    ]);
    // Set Options
    var options = {
      hAxis: {
        title: 'Power (W)'
      },
      vAxis: {
        title: 'Temperature (°c)'
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
      <?php
      // fetch data
      while ($rows = mysqli_fetch_array($result)) {
        echo "['" . $rows['device_name'] . "', " . $rows['current'] . "],";
        $current = $rows['current'];
      }
      ?>
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

<script>
  const currentDate = new Date();
  const currentDayOfMonth = currentDate.getDate();
  const currentMonth = currentDate.getMonth();
  const currentYear = currentDate.getFullYear();
  const dateString = currentDayOfMonth + "-" + (currentMonth + 1) + "-" + currentYear;
  document.getElementById('date-time').innerHTML = dateString;
</script>

<script>
  // Enter electricity unit and calculate amount to pay
  // For 61-90 units, Rs: 16/unit + Rs: 90 fixed charge
  // For 91-120 units, Rs: 50/unit + Rs: 480 fixed charge
  // For 121-180 units, Rs: 50/unit + Rs: 480 fixed charge
  // For 180 units and above, Rs: 75/unit + Rs: 540 fixed charge   
  function calculate() {
    let x = document.getElementById("units").value;
    if (x <= 90) {
      document.getElementById('bill').innerHTML = (x * 16) + 90
    } else if (x <= 120) {
      document.getElementById('bill').innerHTML = (90 * 16) + ((x - 90) * 50) + 480
    } else if (x <= 180) {
      document.getElementById('bill').innerHTML = (90 * 16) + (30 * 50) + ((x - 120) * 50) + 480
    } else if (x > 180) {
      document.getElementById('bill').innerHTML = (90 * 16) + (120 * 50) + (40 * 50) + ((x - 250) * 75) + 540
    }
  }
</script>

<?php
include 'inc/footer.php';

//close the connection
mysqli_close($conn);
?>