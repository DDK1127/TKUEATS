<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="飲料訂單系統｜112(上)資料庫概論期中作業">
        <meta name="keywords" content="飲料訂單系統,資料庫概論">
        <meta name="author" content="Howard">

        <!-- 標題 -->
        <title>飲料訂單系統｜112(上)資料庫概論</title>

        <!-- CSS -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
        <link href="assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
        <link href="assets/css/main.min.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">

    </head>
    <body>

        <!-- 上方系統選單 -->
        <div class="page-container">
            <div class="page-header">
              <nav class="navbar navbar-expand-lg d-flex justify-content-between">
                  <div class="" id="navbarNav">
                    <ul class="navbar-nav" id="leftNav">
                      <li class="nav-item">
                        <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">首頁</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">開發人員</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">書面報告</a>
                      </li>
                    </ul>
                  </div>
                    <div class="" id="headerNav">
                      <ul class="navbar-nav">
                      </ul>
                  </div>
              </nav>
            </div>

            <!-- 選單列 -->
            <div class="page-sidebar">
                <ul class="list-unstyled accordion-menu">
                  <li class="sidebar-title">控制台</li>
                  <li>
                    <a href="index.html"><i data-feather="home"></i>儀表板</a>
                  </li>
                  <li class="sidebar-title">商品管理</li>

					<!-- 選單內的分類 -->
                  	<li class="active-page">
                   		<a href="item_list.php"><i data-feather="box"></i>全部商品清單</a>
                  	</li>
                  	<li>
                    	<a href="item_edit.php"><i data-feather="box"></i>新增/刪除商品</a>
                  	</li>

				  <li class="sidebar-title">顧客管理</li>

					<!-- 選單內的分類 -->
                  	<li>
                   		<a href="customer_list.php"><i data-feather="box"></i>全部顧客資料</a>
                  	</li>
                  	<li>
                    	<a href="customer_edit.php"><i data-feather="box"></i>新增/刪除顧客</a>
                  	</li>

				  <li class="sidebar-title">訂單管理</li>

					<!-- 選單內的分類 -->
                  	<li>
                   		<a href="trade_list.php"><i data-feather="box"></i>全部訂單資料</a>
                  	</li>
                  	<li>
                    	<a href="trade_edit.php"><i data-feather="box"></i>新增/刪除訂單</a>
                  	</li>

                </ul>
            </div>
            <div class="page-content">
                <div class="main-wrapper">
                    <div class="row">
                      <div class="col">
                        <div class="card">
                          <div class="card-body">
                              <h5 class="card-title">全部商品清單</h5>
                              <p>請輸入您需查詢的項目。</p>
                              <form action="" method="post" class="row g-3 needs-validation" novalidate>

								                <!-- 商品全域搜尋（輸入編號、名稱） -->
                                <div class="col-md-6">
                                  <label for="items_number_label" class="form-label">商品全域搜尋（請正確輸入商品編號、商品名稱）</label><br>
                                  商品編號<input type="text" name="items_number" class="form-control" id="items_number_label" value="" >
                                  商品名稱<input type="text" name="items_name" class="form-control" id="items_number_label" value="">
                                  <div class="valid-feedback">
                                    輸入正確！
                                  </div>
                                </div>

                             	<!-- 查詢按鈕 -->
                                <div class="col-12">
                                  <button class="btn btn-primary" type="submit">立即查詢</button>
                                </div>

                              </form>
                          </div>
                      </div>
                      <?php
                            if(isset($_POST["items_number"]) || isset($_POST["items_name"])){

                              $items_number =$_POST["items_number"];
                              $items_name =$_POST["items_name"];
                              // echo "${items_number}";
                              // echo "${items_name}";
                              if ($items_number != "" || $items_name != ""){
                                $conn = mysqli_connect('localhost', '112dbb12', '6331-1633', "112dbb12");
                                if (!$conn)
                                        die("資料庫連線失敗: " . mysqli_connect_error());

                                mysqli_query($conn, 'SET NAMES utf8');
                                mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
                                mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');

                                $sql = "select * from Items where Items_Number = '$items_number' OR Items_Name = '$items_name'";
                                if ($items_name == "*"){
                                          $sql = "select * from Items";
                                }
                                $result = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($result) == 0){
                                          echo "查無此資料";
                                }
                              
                            
                          ?>


                  <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">以下是您查詢的結果</h5>
                                <p>不知道要打什麼的文字！</p>
                                <table id="zero-conf" class="display" style="width:100%">
                                    <thead>
										<!--欄位名稱-->       
                                        <tr>
                                            <th>商品編號</th>
                                            <th>商品名稱</th>
                                            <th>商品數量</th>
                                            <th>商品價格</th>
                                        </tr>
                                        <tr>
                                            <?php
                                                 
                                            while ($row = mysqli_fetch_assoc($result)){
                                            echo "<tr>";
                                            echo "<td>#" . $row["Items_Number"] . "</td>";
                                            echo "<td>" . $row["Items_Name"] . "</td>";
                                            echo "<td> " . $row["Items_Amount"] . "杯</td>";
                                            echo "<td>$ " . $row["Items_Price"] . "</td>";
                                            echo "</tr>";
                                            }
                                          }

                                          }
                                            else
                                              echo "請提供商品編號及商品名稱";
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
										<!--欄位內容-->
                                        <tr>
                                            <td>#</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td>
											</td>
                                        </tr>
								</tbody>
                              </table>
					</div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
                </div>
				</div>

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="assets/plugins/DataTables/datatables.min.js"></script>
        <script src="assets/js/main.min.js"></script>
        <script src="assets/js/pages/datatables.js"></script>
    </body>
</html>
