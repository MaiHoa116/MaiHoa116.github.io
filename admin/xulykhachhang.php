<?php
	session_start();
	if(!isset($_SESSION['dangnhap'])){
		header('Location: login.php');
	} 
	if(isset($_GET['login'])){
 	$dangxuat = $_GET['login'];
	 }else{
	 	$dangxuat = '';
	 }
	 if($dangxuat=='dangxuat'){
	 	session_destroy();
	 	header('Location: login.php');
	 }
?>
<?php
	if(isset($_POST['logout'])){
		unset($_SESSION['dangnhap']);
		header('location:login.php');
	}
?>
<?php
	include('../db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="../css/admin.css" />
<head>
	<meta charset="UTF-8">
	<title>Welcome Admin</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<div class="header">
    	<h1>Welcome to account admin:  <?php echo $_SESSION['dangnhap'] ?></h1></br>
    </div>
	<!--<nav class="navbar navbar-expand-lg navbar-light bg-light">-->
	  <div class="menu" >
	    <ul >   
	      <li >
	        <a href="xulydanhmuc.php">Loại sản phẩm</a>
	      </li>
	      <li >
	        <a  href="xulysanpham.php">Sản phẩm</a>
	      </li>
	       <li >
	        <a  href="xulydanhmucbaiviet.php">Chủ đề bài viết</a>
	      </li>
	         <li >
	        <a  href="xulybaiviet.php">Bài viết</a>
	      </li>
		  <li >
	        <a  href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
	      </li>
	       <li >
	         <a  href="xulykhachhang.php">Khách hàng</a>
	      </li>
		  <li>
		  <form action="" method="post" enctype="multipart/form-data">
            <input type="submit" name="logout" value="Đăng xuất" style="background:#06F;color:#fff;width:190px;height:50px;" />
            </form>
		  </li>
	      
	    </ul>
	  </div>
</br></br>
	<div class="container">
		<div class="row">
			
			<div class="col-md-12">
				<h4>Khách hàng</h4>
				<?php
				$sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang,tbl_giaodich WHERE tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhang.khachhang_id DESC"); 
				?> 
				<table class="table table-bordered ">
					<tr>
						<th>STT</th>
						<th>Tên khách hàng</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ</th>
						<th>Email</th>
						<th>Ngày mua</th>
						<th colspan="2">Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i; ?></td>
						
						<td><?php echo $row_khachhang['name']; ?></td>
						<td><?php echo $row_khachhang['phone']; ?></td>
						<td><?php echo $row_khachhang['address']; ?></td>
						
						<td><?php echo $row_khachhang['email'] ?></td>
						<td><?php echo $row_khachhang['ngaythang'] ?></td>
						<td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>"><img src="../images/seee.jpg" width="35" height="30"   /></a></td>
					</tr>
					 <?php
					} 
					?> 
				</table>
			</div>

			<div class="col-md-12">
				<h4>Liệt kê lịch sử đơn hàng</h4>
				<?php
				if(isset($_GET['khachhang'])){
					$magiaodich = $_GET['khachhang'];
				}else{
					$magiaodich = '';
				}
				$sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC"); 
				?> 
				<table class="table table-bordered ">
					<tr>
						<th>STT</th>
						<th>Mã giao dịch</th>
						<th>Tên sản phẩm</th>
						<th>Ngày đặt</th>
						
					</tr>
					<?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_select)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i; ?></td>
						
						<td><?php echo $row_donhang['magiaodich']; ?></td>
					
						<td><?php echo $row_donhang['sanpham_name']; ?></td>
						
						<td><?php echo $row_donhang['ngaythang'] ?></td>
					
					
					</tr>
					 <?php
					} 
					?> 
				</table>
			</div>
		</div>
	</div>
	
</body>
</html>