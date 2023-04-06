<?php
  // 데이터베이스 연결 정보 설정
  $servername = "localhost";
  $username = "root";
  $password = "root02";
  $dbname = "pizza";

  // MySQL 데이터베이스 연결
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // 연결 오류 발생 시 스크립트 중단
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // MySQL에서 데이터 가져오기
  $sql = "SELECT topping, count(*) as cnt FROM pizza GROUP BY topping";
  $result = mysqli_query($conn, $sql);

  // 가져온 데이터를 Google Pie Chart에 맞게 변환
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array($row['topping'], intval($row['cnt']));
  }
  $data = array_merge(array(array('Topping', 'Count')), $data);

  // MySQL 연결 종료
  mysqli_close($conn);
?>

<!-- Google Pie Chart를 그리는 HTML 코드 -->
<html>
  <head>
    <title>My Pizza Chart</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

        var options = {
          title: 'My Pizza Chart'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>