<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
<link href="../assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
<link href="../assets/css/main.min.css" rel="stylesheet">
<link href="../assets/css/custom.css" rel="stylesheet">

<?php
	if(isset($_POST["customer_number"])){

		$customer_number =$_POST["customer_number"];
		// echo "$customer_number";

		if ($customer_number != ""){
			$conn = mysqli_connect('localhost', 'root', '', "order_db");
			if (!$conn)
            	die("資料庫連線失敗: " . mysqli_connect_error());

			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');

			$sql = "select * from trade where Customer_Number = '$customer_number'";
			if ($customer_number == "*"){
								$sql = "select * from trade";
			}

			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) == 0){
                echo "查無此資料";
            }

			else {
	            echo "<h2>商品資訊</h2>";
	            echo "<div><table border='1'>";
	            echo "<tr><th>顧客編號</th><th>訂單編號</th><th>訂單時間</th></tr>";

            	while ($row = mysqli_fetch_assoc($result)){
	                echo "<tr>";
	                echo "<td>" . $row["Customer_Number"] . "</td>";
	                echo "<td>" . $row["Order_Number"] . "</td>";
	                echo "<td>" . $row["Order_time"] . "</td>";
	                echo "</tr>";
	            }
            	echo "</table></div>";
        	}
		}
	}
	else
		echo "請提供商品編號及商品名稱";
?>
