<?php
	if(isset($_POST["items_number"]) && isset($_POST["items_name"])){

		$items_number =$_POST["items_number"];
		$items_name =$_POST["items_name"];
		// echo "${items_number}";
		// echo "${items_name}";
		if ($items_number != "" && $items_name != ""){
			$conn = mysqli_connect('localhost', 'root', '', "order_db");
			mysqli_query($conn, 'SET NAMES utf8');mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
			mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');

			$sql = "select * from items where Items_Number = '$items_number' AND Items_Name = '$items_name'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 0){
                echo "查無此資料";
            }
            
			$row = mysqli_fetch_row($result);

			while ($row != NULL){
				list($Items_Number, $Items_Name, $Items_Amount, $Items_Price) = $row;
				echo "商品編號：" . $Items_Number . "</br>";
				echo "商品名稱：" . $Items_Name . "</br>";
				echo "商品剩餘數量：" . $Items_Amount . "</br>"; 
				echo "商品價格：" . $Items_Price . "</br>"; 
				$row = mysqli_fetch_row($result);
			}
		}
	}
	else
		echo "請提供商品編號及商品名稱";
?>