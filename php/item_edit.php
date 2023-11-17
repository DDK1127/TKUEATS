
<?php
	if(isset($_POST["items_number"]) && isset($_POST["items_name"]) && isset($_POST["items_amount"]) && isset($_POST["items_price"])){

		$items_number = $_POST["items_number"];
		$items_name = $_POST["items_name"];
		$items_amount = $_POST["items_amount"];
		$items_price = $_POST["items_price"];
		// echo "${items_number}";
		// echo "${items_name}";
		// echo "${items_price}";
		if ($items_number != "" && $items_name != ""){
			$conn = mysqli_connect('localhost', 'root', '', "order_db");
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');

			$sql_check = "SELECT * FROM items WHERE Items_Number = '$items_number' OR Items_Name = '$items_name'";
			$result_check = mysqli_query($conn, $sql_check);

			if(mysqli_num_rows($result_check) > 0){
				echo "相同商品名稱或編號已存在";
			}
			else{
				$sql_insert = "INSERT INTO items (Items_Number, Items_Name, Items_Amount, Items_Price) VALUES ('$items_number', '$items_name', '$items_amount', '$items_price')";
				$result_insert = mysqli_query($conn, $sql_insert);

				if($result_insert)
					echo "商品編號 :$items_number, 商品名稱 :$items_name 新增成功";
				else 
					echo "商品新增失敗：" . mysqli_error($conn);
			}
		
		}
	}
	else
		echo "請提供商品編號、商品名稱、和商品價格";
?>