
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/style-login.css" />
<title>Đăng nhập admin</title>
</head>
<?php
	session_start();
    include('../db/connect.php'); 
?>
<?php
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql=mysqli_query($con,"SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1 ");
		
		$count=mysqli_num_rows($sql);
		if($count==0){
			echo "<script type='text/javascript'>alert('Tài khoản hoặc mật khẩu không đúng.Vui lòng đăng nhập lại!');</script>";
			//header('location:login.php');
			
		}else{
			$_SESSION['dangnhap']=$username;
			echo "<script type='text/javascript'>
                     if(window.confirm('Đăng nhập thành công!'))
                     { window.location.href = './dashboard.php';  }
                     </script>";
			//header('location:dashboard.php');
			
		}
	}
?>
<body>
<div id="login">
	<form action="" method="post" enctype="multipart/form-data">
    <h2>ĐĂNG NHẬP</h2>
    <input type="text" name="username" id="username"  placeholder="Nhập Email..." required="required" />
     <input type="password" name="password" id="password" placeholder="Nhập Password..." required="required" />
      <input type="submit" name="login" id="button" value="Đăng nhập"/>
    </form>

</div>
</div>
</body>
</html>