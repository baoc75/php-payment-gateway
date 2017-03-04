<?php
session_start();
require '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.money.php';
require_once '../class/class.error.php';

$user_home = new USER();
$money_home = new Money();
$error_home = new ErrorRep();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('../login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['transfer']))
{
	$sentemail = addslashes($row['userEmail']);
	$pass = addslashes($_POST['password']);
	$receemail = addslashes($_POST['email']);
	$ccash = addslashes($row['userBalance']);
	$balance = addslashes($_POST['balance']);
	$content = addslashes($_POST['content']);
	$money_home->transfercash($sentemail,$pass,$receemail,$ccash,$balance,$content);
}
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Nạp tiền vào tài khoản - PiggyBank</title>
        <?php include("../template/header.php") ?>
        
    </head>
    <body>
	<?php include("../template/menu_ac.php") ?>
	 <div class="container">
	</br></br>
    <center><h1 style="font-size: 30px; ">Nạp tiền vào tài khoản</h1>
	<p style="font-weight: 400; width:50%;">Chuyển tiền vào tài khoản PiggyBank của bạn và tiến hành mua sắm, chuyển tiền cho người thân, bạn bè ngay từ bây giờ. </p></center>
    </br>
 <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#bank">Chuyển khoản ngân hàng</a></li>
  <li><a data-toggle="tab" href="#topup">Thẻ cào điện thoại</a></li>
  <li><a data-toggle="tab" href="#creditc">Thẻ tín dụng (Credit Card)</a></li>
  <li><a data-toggle="tab" href="#office">Trực tiếp tại văn phòng</a></li>
</ul>

<div class="tab-content">
  <div id="bank" class="tab-pane fade in active">
    <h3>Chuyển khoản ngân hàng</h3>
	<p style="width:50%;">Chúng tôi sẽ tiếp nhận việc nạp tiền vào tài khoản của bạn thông qua chuyển khoản ngân hàng và sẽ không tính phí quý khách. Xin hãy chuyển khoản vào giờ hành chính (8h-16h) để 
	có yêu cầu có thể được xử lí nhanh chóng.</br>Nội dung chuyển khoản: "Email tài khoản muốn chuyển" + PiggyBank. </br>
	<b>VD:</b> nguyenvanhai@abc.com PiggyBank</p>
    </br>
	<p><b>Ngân hàng TMCP Ngoại Thương Việt Nam (Vietcombank)</b></br>
	Chi nhánh: Tân Định - TP.HCM </br>
	Số tài khoản: 0371000397238 </br>
	Chủ tài khoản: Lê Thị Nga </br>
	Swift Code: BFTVVNVX</p>
  </div>
  <div id="topup" class="tab-pane fade">
    <h3>Thẻ cào điện thoại/thẻ dịch vụ</h3>
    <p style="width:50%;">Sử dụng thẻ cào điện thoại để nạp tiền vào tài khoản của bạn. Lưu ý rằng việc sử dụng thẻ cào điện thoại để nạp tiền sẽ bị tính phí 10%. </br>
	Chúng tôi hiện đang hỗ trợ: Viettel, Vinaphone, Mobifone, Vietnammobile, Gate.</p>
 <table class="table table-hover">
    <thead>
      <tr>
        <th>Vinaphone</th>
        <th>Mobifone</th>
        <th>Viettel</th>
		<th>Vietnammobile</th>
        <th>Gate</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>20%</td>
        <td>20%</td>
        <td>20%</td>
        <td>21%</td>
		<td>14%</td>
      </tr>
    </tbody>
  </table>
	<p style="color: #01AB4F"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Giao dịch của bạn hiện đang được bảo mật bởi SSL </p>
  </div>
  <div id="creditc" class="tab-pane fade">
    <h3>Thẻ tín dụng</h3>
    <p style="width:50%;">Sử dụng thẻ thẻ tín dụng để nạp tiền vào tài khoản của bạn. Lưu ý rằng việc sử dụng thẻ tín dụng sẽ bị tính phí chuyển đổi ngoại tệ sang VNĐ. </br>
	Chúng tôi hiện đang hỗ trợ: Visa, Mastercard</p>
	<p style="color: #01AB4F"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Giao dịch của bạn hiện đang được bảo mật bởi SSL </p>
  </div>
  <div id="office" class="tab-pane fade">
    <h3>Trực tiếp tại văn phòng</h3>
    <p style="width:50%;">Bạn có thể đến trực tiếp tại văn phòng của chúng tôi để nạp tiền vào tài khoản PiggyBank. Phương thức chuyển tiền này sẽ không bị tính phí, vô cùng thuận tiện và nhanh chóng.</p>
    </br>
	<p><b>Trụ sở TP.HCM: </b></br>
	Địa chỉ: 427/2 Tân Kỳ Tân Quý, phường Tân Quý, quận Tân Phú, thành phố Hồ Chí Minh.</br>
	<b>Văn phòng An Giang: </b></br>
	Địa chỉ: 724 Chu Văn An, thị trấn Phú Mỹ, huyện Phú Tân, tỉnh An Giang.</p>
  </div>
</div>
</div>
 
<?php include("../template/footer_ac.php") ?>
<?php include("../template/misc.php") ?>
        
    </body>

</html>