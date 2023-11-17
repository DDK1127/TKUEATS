
<?php
	if(isset($_POST["customer_number"]) && isset($_POST["customer_name"]) && isset($_POST["customer_phone"]) && isset($_POST["customer_address"])){

		$customer_number = $_POST["customer_number"];
		$customer_name = $_POST["customer_name"];
		$customer_phone = $_POST["customer_phone"];
		$customer_address = $_POST["customer_address"];

		if ($customer_number != "" && $customer_name != "" && $customer_phone != "" && $customer_address != ""){
			$conn = mysqli_connect('localhost', 'root', '', "order_db");
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');

			$sql_check = "SELECT * FROM customer WHERE Customer_Number = '$customer_number' OR Phone_Number = '$customer_phone'";
			$result_check = mysqli_query($conn, $sql_check);

			if(mysqli_num_rows($result_check) > 0){
				echo "相同顧客編號或手機號碼已存在";
			}
			else{
				$sql_insert = "INSERT INTO customer (Customer_Number, Name, Phone_Number, Address) VALUES ('$customer_number', '$customer_name', '$customer_phone', '$customer_address')";
				$result_insert = mysqli_query($conn, $sql_insert);

				if($result_insert)
					echo "顧客編號 :$customer_number, 顧客名稱 :$customer_name , 顧客電話: $customer_phone, 顧客地址: $customer_address 新增成功";
				else 
					echo "商品新增失敗：" . mysqli_error($conn);
			}
		
		}
	}
	else
		echo "請完整提供顧客資訊";
?>