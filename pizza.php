<!DOCTYPE html>
<html>
<head>
	<title>피자</title>
</head>
<body>
	<h1>피자</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>토핑1:</label>
		<input type="text" name="topping1" required><br><br>
		<label>토핑2:</label>
		<input type="text" name="topping2" required><br><br>
		<label>토핑3:</label>
		<input type="text" name="topping3" required><br><br>
		<label>토핑4:</label>
		<input type="text" name="topping4" required><br><br>
		<label>토핑5:</label>
		<input type="text" name="topping5" required><br><br>
		<input type="submit" value="등록">
	</form>
	<?php
	// 폼이 제출되면 회원 정보를 처리하는 코드
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 데이터베이스 연결
		$servername = "localhost";
		$username = "root";
		$password = "root02";
		$dbname = "pizza";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// 이름과 이메일 데이터 가져오기
		$t_array = array($_POST["topping1"], $_POST["topping2"], $_POST["topping3"], $_POST["topping4"], $_POST["topping5"]);

		// SQL 쿼리 실행
		$sql = "INSERT INTO pizza (topping) VALUES ('" . implode("'), ('", $t_array) . "')";
		if ($conn->query($sql) === TRUE) {
			echo "입력 성공";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	?>
</body>
</html>
