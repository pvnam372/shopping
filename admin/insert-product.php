<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$category = $_POST['category'];
		$subcategory = $_POST['subcategory'];
		$productcapacity = $_POST['productcapacity'];
		$productcolor = $_POST['productColor'];
		$productprice = $_POST['productprice'];
		$productpricebd = $_POST['productpricebd'];
		$productamount = $_POST['productAmount'];
		$productscharge = $_POST['productShippingcharge'];
		$productavailability = $_POST['productAvailability'];
		$productimage1 = $_FILES["productimage1"]["name"];
		$productimage2 = $_FILES["productimage2"]["name"];
		$productimage3 = $_FILES["productimage3"]["name"];
		//for getting product id
		$query = mysqli_query($con, "select max(id) as pid from products");
		$result = mysqli_fetch_array($query);
		$productid = $result['pid'] + 1;
		$dir = "productimages/$productid";
		if (!is_dir($dir)) {
			mkdir("productimages/" . $productid);
		}

		move_uploaded_file($_FILES["productimage1"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage1"]["name"]);
		move_uploaded_file($_FILES["productimage2"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage2"]["name"]);
		move_uploaded_file($_FILES["productimage3"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage3"]["name"]);
		$sql = mysqli_query($con, "insert into products(id,category,subcategory,productcapacity,productColor,productPrice,productAmount,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount) values('$productid','$category','$subcategory','$productcapacity','$productcolor','$productprice','$productamount','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");
		$_SESSION['msg'] = "Thêm thành công !!";
	}


?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Thêm sản phẩm</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>

		<script>
			function getCapacity(val) {
				$.ajax({
					type: "POST",
					url: "get_capacity.php",
					data: 'cat_id=' + val,
					success: function(data) {
						$("#subcategory").html(data);
					}
				});
			}

			function selectCountry(val) {
				$("#search-box").val(val);
				$("#suggesstion-box").hide();
			}
		</script>


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
									<h3>Thêm sản phẩm</h3>
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

									<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

										<div class="control-group">
											<label class="control-label" for="basicinput">Phân loại</label>
											<div class="controls">
												<select name="category" class="span8 tip" onChange="getCapacity(this.value);">
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
												<select name="subcategory" id="subcategory" class="span8 tip">
												</select>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Dung lượng</label>
											<div class="controls">
												<select name="productcapacity" id="productcapacity" class="span8 tip">
													<option value="64">64 GB</option>
													<option value="128">128 GB</option>
													<option value="256">256 GB</option>
													<option value="512">512 GB</option>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Màu</label>
											<div class="controls">
												<input type="text" name="productColor" placeholder="Nhập màu" class="span8 tip">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Giá gốc</label>
											<div class="controls">
												<input type="text" name="productpricebd" placeholder="Nhập giá" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Giá sau khuyến mãi</label>
											<div class="controls">
												<input type="text" name="productprice" placeholder="Nhập giá" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Số lượng</label>
											<div class="controls">

												<input type="number" name="productAmount" placeholder="Nhập số lượng" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Phí vận chuyển</label>
											<div class="controls">
												<input type="text" name="productShippingcharge" placeholder="Nhập phí vận chuyển" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Tình trạng</label>
											<div class="controls">
												<select name="productAvailability" id="productAvailability" class="span8 tip">
													<option value="">Select</option>
													<option value="In Stock">Còn hàng</option>
													<option value="Out of Stock">Hết hàng</option>
												</select>
											</div>
										</div>



										<div class="control-group">
											<label class="control-label" for="basicinput">Ảnh 1</label>
											<div class="controls">
												<input type="file" name="productimage1" id="productimage1" value="" class="span8 tip">
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Ảnh 2</label>
											<div class="controls">
												<input type="file" name="productimage2" class="span8 tip">
											</div>
										</div>



										<div class="control-group">
											<label class="control-label" for="basicinput">Ảnh 3</label>
											<div class="controls">
												<input type="file" name="productimage3" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Thêm</button>
											</div>
										</div>
									</form>
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