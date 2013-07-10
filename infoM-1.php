<?php session_start(); ?>
<!DOCTYPE html>
<?php
mb_http_input("utf-8");
mb_http_output("utf-8");
?>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>資訊管理系設備出借系統</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />	
<style type="text/css">
a:hover {
	color: #CCC;
}
a:active {
	color: #FFF;
}
</style>
</head>

<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<span id="infos">
                <a href="logout.php">管理者登出</a>
                </span>
				<a href="index.html" id="logo"></a> <!-- /#logo -->
                <center>
				<ul id="navigation"> 
              <li><a href="member2.php" >借閱審核</a></li>
        	  <li><a href="return.php">設備歸還</a></li>
              <li><a href="infoM.php">報表管理</a></li>
              <li><a href="info2.php">設備管理</a></li                            ><li><a href="updata2.php">會員資料管理</a></li>
              	</ul>
              </center>	
	    </div> <!-- /#header -->
			<div id="contents">
			  <div id="main">
 <?php
 include("mysql_in.php");
 $number=$_GET['number'];
 $query = sprintf("SELECT * FROM history WHERE number='$number' ORDER BY bd DESC");
 $result = mysqli_query($db, $query) or die(mysqli_error());
 $totalRows = mysqli_num_rows($result);
 ?>

    <div id="wrap">
	
    <div id="wrap">

	<div id="top">

    </div>
<div class=out1 style='text-align:center; line-height:20px'>

            <table width="900">
             
                <th width="130">財產編號</th>
               
                <th width="100">財產種類</th>
               
                <th width="150">廠牌型號</th>
               
                <th width="80">借閱人</th>
               
                <th width="80">借閱時間</th>
               
                <th width="80">歸還時間</th>   
                
                <th width="80">備註</th>         
               
                <?php

 while ($row = mysqli_fetch_array($result))
 {
                	echo "<tr>";

					echo "<td>".$row["number"]."</td>";

                    echo "<td>".$row["name"]."</td>";

					echo "<td>".$row["model"]."</td>";
			
      				echo "<td>".$row["user"]."</td>";
                
                    echo "<td>".$row["bd"]."</td>";

					echo "<td>".$row["rd"]."</td>";
					
					echo "<td>".$row["ps"]."</td>";

                    ?>                           
             
                <?php
                
                    echo "</td>";

                    echo "</tr>";

                }

            ?>            
                               
            </table>

            <p>&nbsp;</p>

          </div>

        </div>

   </div>

</div>
	 
    <div id="footer"></div>

		  <!-- /#contents -->
			<div id="footer">
				<div id="description">
					<div>
						<a href="index.html" class="logo"></a>
<span>&copy; Copyright &copy; 2013. <a href="index.html">Company name</a> All rights reserved</span>
					</div>
					<p>透過本系統，不僅可以縮短查詢資料的時間，使用者與管理者對於設備出借狀況一目了然，再透過電腦key in借用資料，省去人工對於傳統出借單不知如何寫起與漏寫的種種問題；再者，一本又一本的出借單究竟是要留著還是丟掉?實在是令人頭疼，因此開發此系統，已達到數位化管理。
              歡迎使用本系統!! </div>
				<div class="navigation">
					<a href="index.html">系統簡介</a>|
					<a href="http://www.nutc.edu.tw">臺中科技大學</a>|
					<a href="http://im.nutc.edu.tw">資訊管理系</a>|
					<a href="register.php">註冊會員</a>|
					
				</div>
</div> <!-- /#footer -->
		</div> <!-- /#page -->
	</div> <!-- /#background -->
</body>
</html>