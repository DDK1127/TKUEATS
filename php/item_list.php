<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
<link href="../assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
<link href="../assets/css/main.min.css" rel="stylesheet">
<link href="../assets/css/custom.css" rel="stylesheet">

<?php
	if(isset($_POST["items_number"]) || isset($_POST["items_name"])){

		$items_number =$_POST["items_number"];
		$items_name =$_POST["items_name"];
		// echo "${items_number}";
		// echo "${items_name}";
		if ($items_number != "" || $items_name != ""){
			$conn = mysqli_connect('localhost', 'root', '', "order_db");
			if (!$conn)
            	die("資料庫連線失敗: " . mysqli_connect_error());

			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');

			$sql = "select * from items where Items_Number = '$items_number' OR Items_Name = '$items_name'";
			if ($items_name == "*"){
								$sql = "select * from items";
			}
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) == 0){
                echo "查無此資料";
      }
			else {
	            echo "<h2>商品資訊</h2>";
	            echo "<div><table border='1'>";
	            echo "<tr><th>商品編號</th><th>商品名稱</th><th>剩餘數量</th><th>商品價格</th></tr>";

            	while ($row = mysqli_fetch_assoc($result)){
	                echo "<tr>";
	                echo "<td>" . $row["Items_Number"] . "</td>";
	                echo "<td>" . $row["Items_Name"] . "</td>";
	                echo "<td>" . $row["Items_Amount"] . "</td>";
	                echo "<td>" . $row["Items_Price"] . "</td>";
	                echo "</tr>";
	            }
            	echo "</table></div>";
        	}
		}
	}
	else
		echo "請提供商品編號及商品名稱";
?>
