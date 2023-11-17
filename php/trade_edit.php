
<?php
	if(isset($_POST["customer_number"]) && isset($_POST["order_number"]) && isset($_POST["order_time"])){

		$customer_number = $_POST["customer_number"];
		$order_number = $_POST["order_number"];
		$order_time = $_POST["order_time"];

		if ($customer_number != "" && $order_number != "" && $order_time != ""){
			$conn = mysqli_connect('localhost', 'root', '', "order_db");
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');

			$sql_check = "SELECT * FROM trade WHERE Customer_Number = '$customer_number' AND Order_Number = '$order_number'";
			$result_check = mysqli_query($conn, $sql_check);

			if(mysqli_num_rows($result_check) > 0){
				echo "相同訂單已存在";
			}
			else{
				$sql_insert = "INSERT INTO trade (Customer_Number, Order_Number, Order_time) VALUES ('$customer_number', '$order_number', '$order_time')";
				$result_insert = mysqli_query($conn, $sql_insert);

				if($result_insert)
					echo "商品編號 :$customer_number, 訂單編號 :$order_number, 訂單時間 : $order_time 新增成功";
				else 
					echo "商品新增失敗：" . mysqli_error($conn);
			}
		
		}
	}
	else
		echo "請完整提供訊息";
?>