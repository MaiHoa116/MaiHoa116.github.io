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
<?php
	if(isset($_POST['themdanhmuc'])){
		$tendanhmuc = $_POST['danhmuc'];
		$sql_insert = mysqli_query($con,"INSERT INTO tbl_category(category_name) values ('$tendanhmuc')");
	}elseif(isset($_POST['capnhatdanhmuc'])){
		$id_post = $_POST['id_danhmuc'];
		$tendanhmuc = $_POST['danhmuc'];
		$sql_update = mysqli_query($con,"UPDATE tbl_category SET category_name='$tendanhmuc' WHERE category_id='$id_post'");
		header('Location:xulydanhmuc.php');
	}
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_category WHERE category_id='$id'");
	}
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
			<?php
			if(isset($_GET['quanly'])=='capnhat'){
				$id_capnhat = $_GET['id'];
				$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_category WHERE category_id='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
				?>
				<div class="col-md-4">
				<h4>Cập nhật loại sản phẩm </h4>
				<label>Tên loại sản phẩm</label>
				<form action="" method="POST">
					<input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name'] ?>"><br>
					<input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>">

					<input type="submit" name="capnhatdanhmuc" value="Cập nhật " class="btn btn-default" style="background:#07F;color:#fff;width:120px;height:35px;">
				</form>
				</div>
			<?php
			}else{
				?>
				<div class="col-md-4">
				<h4>Thêm loại sản phẩm</h4>
				<label>Tên loại sản phẩm</label>
				<form action="" method="POST">
					<input type="text" class="form-control" name="danhmuc" placeholder="Tên loại sản phẩm"><br>
					<input type="submit" name="themdanhmuc" value="Thêm " class="btn btn-default" style="background:#07F;color:#fff;width:100px;height:35px;" >
				</form>
				</div>
				<?php
			} 
			
				?>
			<div class="col-md-8">
				<h4>Tất cả loại sản phẩm</h4>
				<?php
				$sql_select = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
				?>
				<table class="table table-bordered ">
					<tr>
						<th>STT</th>
						<th>Tên loại sản phẩm</th>
						<th colspan="2">Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while($row_category = mysqli_fetch_array($sql_select)){ 
						$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_category['category_name'] ?></td>
						<td><a href="?xoa=<?php echo $row_category['category_id'] ?>"><img src="../images/delete.png" width="30" height="30"   /></a> </td>
						<td> <a href="?quanly=capnhat&id=<?php echo $row_category['category_id'] ?>"><img src="../images/edit.png" width="30" height="30" /></a></td>
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