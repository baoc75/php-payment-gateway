<?php
session_start();
require '../config/dbconfig.php';
require_once '../class/class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('../login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Tài khoản của bạn - PiggyBank</title>
        <?php include("../template/header.php") ?>
        
    </head>
    
    <body>
	 <?php include("../template/menu_ac.php") ?>
	 </br></br>
       <div class="container">
	      	<div class="jumbotron">
  <div class="container">
    <h1 style="font-size: 30px; ">Chào mừng bạn <?php echo $row['userName']; ?>, </h1>
	<p style="font-weight: 400;">Số tiền trong tài khoản của bạn hiện giờ là <?php echo $row['userBalance']; ?>Đ</p>
  </div>
  </div>
  
  <div class="row">
  <div class="col-md-8"><h2>Giao dịch gần đây</h2>
	<?php 
$query = $user_home->runQuery("SELECT * from activity where fromEmail=:userEmail OR toEmail=:userEmail ORDER BY `activity`.`id` DESC LIMIT 0 , 4");
$query->execute(array(":userEmail"=>$row['userEmail']));
// Display search result
         if (!$query->rowCount() == 0) {
				echo "<table class=\"table table-hover\">";	
                echo "<tr><th>Thời gian</th><th>Người nhận</th><th>Số tiền</th></tr>";				
            while ($results = $query->fetch()) {
				echo "<tr><td>";			
                echo "".date("d-m-Y", strtotime($results['date']));
				echo "</td><td>";
				if (($results['toEmail'])==($row['userEmail'])) 
				{
					echo "<b>Bạn</b>";
					echo "</td><td>";
					echo "+".$results['cash'].'đ';
					echo "</td><td>";
					echo "</td></tr>";	
				}
				else 
				{
					echo "".$user_home->emailtoname($results['toEmail']);
					echo "</td><td>";
					echo "-".$results['cash'].'đ';
					echo "</td><td>";
					echo "</td></tr>";	
				}
			    
            }
				echo "</table>";		
        } else {
            echo '<h3>Chúng tôi không tìm thấy kết quả nào, xin hãy thử lại!</h3>';
        }
	?>
  <p><a href="activity.php">Xem chi tiết lịch sử giao dịch<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
  </div>
  <div class="col-md-4"><h2>Bạn có thể làm gì với PiggyBank?</h2></br>
  <h2>Ưu đãi cho bạn </h2></div>
</div>
	   </div>
       <?php include("../template/footer_ac.php") ?> 
       <?php include("../template/misc.php") ?>
        
    </body>

</html>