<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['submit'])) {
		$category = $_POST['category'];
		$subcategory = $_POST['subcategory'];
		$sql = mysqli_query($con, "insert into subcategory(categoryid,subcategory) values('$category','$subcategory')");
		$_SESSION['msg'] = "Thêm thành công !!";
	}

	if (isset($_GET['del'])) {
		mysqli_query($con, "delete from subcategory where id = '" . $_GET['id'] . "'");
		$_SESSION['delmsg'] = "Đã xóa !!";
	}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Quản lý phân loại con</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	</head>

	<body>
		<?php include('include/header.php'); ?>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Phân loại</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>


									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />

									<form class="form-horizontal row-fluid" name="subcategory" method="post">

										<div class="control-group">
											<label class="control-label" for="basicinput">Phân loại máy</label>
											<div class="controls">
												<select name="category" class="span8 tip">
													<option value="">Chọn phân loại</option>
													<?php $query = mysqli_query($con, "select * from category");
													while ($row = mysqli_fetch_array($query)) { ?>

														<option value="<?php echo $row['id']; ?>"><?php echo $row['categoryName']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Tên máy</label>
											<div class="controls">
												<input type="text" placeholder="Nhập loại dung lượng" name="subcategory" class="span8 tip">
											</div>
										</div>



										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Tạo</button>
											</div>
										</div>
									</form>
								</div>
							</div>


							<div class="module">
								<div class="module-head">
									<h3>Phân loại dung lượng</h3>
								</div>
								<div class="module-body table">
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Dòng máy</th>
												<th>Dung lượng</th>
												<th>Ngày tạo</th>
												<th>Cập nhật</th>
												<th>Tùy chỉnh</th>
											</tr>
										</thead>
										<tbody>

											<?php $query = mysqli_query($con, "select subcategory.id,category.categoryName,subcategory.subcategory,subcategory.creationDate,subcategory.updationDate from subcategory join category on category.id=subcategory.categoryid");
											$cnt = 1;
											while ($row = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo htmlentities($row['categoryName']); ?></td>
													<td><?php echo htmlentities($row['subcategory']); ?></td>
													<td> <?php echo htmlentities($row['creationDate']); ?></td>
													<td><?php echo htmlentities($row['updationDate']); ?></td>
													<td>
														<a href="edit-capacity.php?id=<?php echo $row['id'] ?>"><i class="icon-edit"></i></a>
														<a href="subcategory.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Chắc chắn xóa?')"><i class="icon-remove-sign"></i></a>
													</td>
												</tr>
											<?php $cnt = $cnt + 1;
											} ?>

									</table>
								</div>
							</div>



						</div><!--/.content-->
					</div><!--/.span9-->
				</div>
			</div><!--/.container-->
		</div><!--/.wrapper-->

		<?php include('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function() {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>
<?php } ?>