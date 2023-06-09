<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] == "add") {
	$id = intval($_GET['id']);
	if (isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]['quantity']++;
	} else {
		$sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p);
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
			header('location:my-cart.php');
		} else {
			$message = "Product ID is invalid";
		}
	}
}
$pid = intval($_GET['pid']);
if (isset($_GET['pid']) && $_GET['action'] == "wishlist") {
	if (strlen($_SESSION['login']) == 0) {
		header('location:login.php');
	} else {
		mysqli_query($con, "insert into wishlist(userId,productId) values('" . $_SESSION['id'] . "','$pid')");
		echo "<script>alert('Product aaded in wishlist');</script>";
		header('location:my-wishlist.php');
	}
}
if (isset($_POST['submit'])) {
	$qty = $_POST['quality'];
	$price = $_POST['price'];
	$value = $_POST['value'];
	$name = $_POST['name'];
	$summary = $_POST['summary'];
	$review = $_POST['review'];
	mysqli_query($con, "insert into productreviews(productId,quality,price,value,name,summary,review) values('$pid','$qty','$price','$value','$name','$summary','$review')");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">
	<title>Chi tiết sản phẩm</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/green.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="assets/css/config.css">

	<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">

	<header class="header-style-1">

		<!-- ============================================== TOP MENU ============================================== -->
		<?php include('includes/top-header.php'); ?>
		<!-- ============================================== TOP MENU : END ============================================== -->
		<?php include('includes/main-header.php'); ?>
		<!-- ============================================== NAVBAR ============================================== -->
		<?php include('includes/menu-bar.php'); ?>
		<!-- ============================================== NAVBAR : END ============================================== -->

	</header>

	<!-- ============================================== HEADER : END ============================================== -->
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<?php
				$ret = mysqli_query($con, "select category.categoryName as catname,subcategory.subcategory as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subcategory where products.id='$pid'");
				while ($rw = mysqli_fetch_array($ret)) {

				?>


					<ul class="list-inline list-unstyled">
						<li><a href="index.php">Home</a></li>
						<li class='active'><?php echo htmlentities($rw['pname']); ?></li>
					</ul>
				<?php } ?>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->
	<div class="body-content outer-top-xs">
		<div class='container'>
			<div class='row single-product outer-bottom-sm '>
				<div class='col-md-3 sidebar'>
					<div class="sidebar-module-container">


						<!-- ==============================================CATEGORY============================================== -->
						<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
							<h3 class="section-title">Phân loại</h3>
							<div class="sidebar-widget-body m-t-10">
								<div class="accordion">

									<?php $sql = mysqli_query($con, "select id,categoryName  from category");
									while ($row = mysqli_fetch_array($sql)) {
									?>
										<div class="accordion-group">
											<div class="accordion-heading">
												<a href="category.php?cid=<?php echo $row['id']; ?>" class="accordion-toggle collapsed">
													<?php echo $row['categoryName']; ?>
												</a>
											</div>

										</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<!-- ============================================== CATEGORY : END ============================================== --> <!-- ============================================== HOT DEALS ============================================== -->
						<div class="sidebar-widget hot-deals wow fadeInUp">
							<h3 class="section-title">Bán chạy</h3>
							<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">

								<?php
								$ret = mysqli_query($con, "select products.*,subcategory.subcategory as productName from products join subcategory on subcategory.id=products.subcategory order by rand() limit 4 ");
								while ($rws = mysqli_fetch_array($ret)) {

								?>


									<div class="item">
										<div class="products">
											<div class="hot-deal-wrapper">
												<div class="image">
													<img src="admin/productimages/<?php echo htmlentities($rws['id']); ?>/<?php echo htmlentities($rws['productImage1']); ?>" width="200" height="334" alt="">
												</div>

											</div><!-- /.hot-deal-wrapper -->

											<div class="product-info text-left m-t-20">
												<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($rws['id']); ?>"><?php echo htmlentities($rws['productName']); ?> <?php echo htmlentities($rws['productcapacity']); ?> <?php echo htmlentities($rws['productColor']); ?></a></h3>
												<div class="rating rateit-small"></div>

												<div class="product-price">
													<span class="price">
														<?php echo htmlentities(number_format($rws['productPrice'])); ?> đ
													</span>

													<span class="price-before-discount"><?php echo htmlentities(number_format($row['productPriceBeforeDiscount'])); ?> đ</span>

												</div><!-- /.product-price -->

											</div><!-- /.product-info -->

											<div class="cart clearfix animate-effect">
												<div class="action">

													<div class="add-cart-button btn-group">
														<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
															<i class="fa fa-shopping-cart"></i>
														</button>
														<a href="product-details.php?page=product&action=add&id=<?php echo $rws['id']; ?>" class="lnk btn btn-primary">Thêm vào giỏ hàng</a>


													</div>

												</div><!-- /.action -->
											</div><!-- /.cart -->
										</div>
									</div>
								<?php } ?>


							</div><!-- /.sidebar-widget -->
						</div>

						<!-- ============================================== COLOR: END ============================================== -->
					</div>
				</div><!-- /.sidebar -->
				<?php
				$ret = mysqli_query($con, "select products.*,subcategory.subcategory as productName from products join subcategory on subcategory.id=products.subcategory where products.id='$pid'");
				while ($row = mysqli_fetch_array($ret)) {

				?>


					<div class='col-md-9'>
						<div class="row  wow fadeInUp">
							<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
								<div class="product-item-holder size-big single-product-gallery small-gallery">

									<div id="owl-single-product">

										<div class="single-product-gallery-item" id="slide1">
											<a data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']); ?>" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="370" height="350" />
											</a>
										</div>




										<div class="single-product-gallery-item" id="slide1">
											<a data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']); ?>" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="370" height="350" />
											</a>
										</div><!-- /.single-product-gallery-item -->

										<div class="single-product-gallery-item" id="slide2">
											<a data-lightbox="image-1" data-title="Gallery" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>" />
											</a>
										</div><!-- /.single-product-gallery-item -->

										<div class="single-product-gallery-item" id="slide3">
											<a data-lightbox="image-1" data-title="Gallery" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>" />
											</a>
										</div>

									</div><!-- /.single-product-slider -->


									<div class="single-product-gallery-thumbs gallery-thumbs">

										<div id="owl-single-product-thumbnails">
											<div class="item">
												<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
													<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" />
												</a>
											</div>

											<div class="item">
												<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
													<img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>" />
												</a>
											</div>
											<div class="item">

												<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="3" href="#slide3">
													<img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>" height="200" />
												</a>
											</div>




										</div><!-- /#owl-single-product-thumbnails -->



									</div>

								</div>
							</div>




							<div class='col-sm-6 col-md-7 product-info-block'>
								<div class="product-info">
									<h1 class="name"><?php echo htmlentities($row['productName']); ?></h1>
									<?php $rt = mysqli_query($con, "select * from productreviews where productId='$pid'");
									$num = mysqli_num_rows($rt); {
									?>
										<div class="rating-reviews m-t-20">
											<div class="row">
												<div class="col-sm-3">
													<div class="rating rateit-small"></div>
												</div>
												<div class="col-sm-8">
													<div class="reviews">
														<a href="#" class="lnk">(<?php echo htmlentities($num); ?> Đánh giá)</a>
													</div>
												</div>
											</div><!-- /.row -->
										</div><!-- /.rating-reviews -->
									<?php } ?>
									<div class="stock-container info-container m-t-10">
										<div class="row">
											<div class="col-sm-3">
												<div class="stock-box">
													<span class="label">Tình trạng :</span>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="stock-box">
													<span class="value"><?php echo htmlentities($row['productAvailability']); ?></span>
												</div>
											</div>
										</div><!-- /.row -->
									</div>



									<div class="stock-container info-container m-t-10">
										<div class="row">
											<div class="col-sm-3">
												<div class="stock-box">
													<span class="label">Màu sắc :</span>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="stock-box">
													<span class="value"><?php echo htmlentities($row['productColor']); ?></span>
												</div>
											</div>
										</div><!-- /.row -->
									</div>


									<div class="stock-container info-container m-t-10">
										<div class="row">
											<div class="col-sm-3">
												<div class="stock-box">
													<span class="label">Phí ship :</span>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="stock-box">
													<span class="value"><?php if ($row['shippingCharge'] == 0) {
																			echo "Free";
																		} else {
																			echo htmlentities($row['shippingCharge']);
																		}

																		?></span>
												</div>
											</div>
										</div><!-- /.row -->
									</div>

									<div class="price-container info-container m-t-20">
										<div class="row">


											<div class="col-sm-6">
												<div class="price-box">
													<span class="price"><?php echo htmlentities(number_format($row['productPrice'])); ?> đ</span>
													<span class="price-strike"><?php echo htmlentities(number_format($row['productPriceBeforeDiscount'])); ?> đ</span>
												</div>
											</div>




											<div class="col-sm-6">
												<div class="favorite-button m-t-10">
													<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id']) ?>&&action=wishlist">
														<i class="fa fa-heart"></i>
													</a>

													</a>
												</div>
											</div>

										</div><!-- /.row -->
									</div><!-- /.price-container -->






									<div class="quantity-container info-container">
										<div class="row">

											<div class="col-sm-2">
												<span class="label">SL :</span>
											</div>

											<div class="col-sm-2">
												<div class="cart-quantity">
													<div class="quant-input">
														<div class="arrows">
															<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
															<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
														</div>
														<input type="text" value="1">
													</div>
												</div>
											</div>

											<div class="col-sm-7">
												<a href="product-details.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> Thêm vào giỏ hàng</a>
											</div>


										</div><!-- /.row -->
									</div><!-- /.quantity-container -->

									<div class="product-social-link m-t-20 text-right">
										<span class="social-label">Chia sẻ :</span>
										<div class="social-icons">
											<ul class="list-inline">
												<li><a class="fa fa-facebook" href="#"></a></li>
												<li><a class="fa fa-twitter" href="#"></a></li>
												<li><a class="fa fa-linkedin" href="#"></a></li>
												<li><a class="fa fa-rss" href="#"></a></li>
												<li><a class="fa fa-pinterest" href="#"></a></li>
											</ul><!-- /.social-icons -->
										</div>
									</div>




								</div><!-- /.product-info -->
							</div><!-- /.col-sm-7 -->
						</div><!-- /.row -->


						<div class="product-tabs inner-bottom-xs  wow fadeInUp">
							<div class="row">
								<div class="col-sm-3">
									<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
										<li class="active"><a data-toggle="tab" href="#description">Mô tả</a></li>
										<li><a data-toggle="tab" href="#review">ĐÁNH GIÁ</a></li>
									</ul><!-- /.nav-tabs #product-tabs -->
								</div>
								<div class="col-sm-9">

									<div class="tab-content">

										<div id="description" class="tab-pane in active">
											<div class="product-tab">
												<p class="text"><?php echo $row['productDescription']; ?></p>
											</div>
										</div><!-- /.tab-pane -->

										<div id="review" class="tab-pane">
											<div class="product-tab">

												<div class="product-reviews">
													<h4 class="title">Các đánh giá của khách hàng</h4>
													<?php $qry = mysqli_query($con, "select * from productreviews where productId='$pid'");
													while ($rvw = mysqli_fetch_array($qry)) {
													?>

														<div class="reviews" style="border: solid 1px #000; padding-left: 2% ">
															<div class="review">
																<div class="review-title"><span class="summary"><?php echo htmlentities($rvw['summary']); ?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo htmlentities($rvw['reviewDate']); ?></span></span></div>

																<div class="text">"<?php echo htmlentities($rvw['review']); ?>"</div>
																<div class="text"><b>Chất lượng :</b> <?php echo htmlentities($rvw['quality']); ?> Star</div>
																<div class="text"><b>Giá cả :</b> <?php echo htmlentities($rvw['price']); ?> Star</div>
																<div class="text"><b>Giá trị :</b> <?php echo htmlentities($rvw['value']); ?> Star</div>
																<div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name"><?php echo htmlentities($rvw['name']); ?></span></div>
															</div>

														</div>
													<?php } ?><!-- /.reviews -->
												</div><!-- /.product-reviews -->
												<form role="form" class="cnt-form" name="review" method="post">


													<div class="product-add-review">
														<h4 class="title">Viết đánh giá của bạn</h4>
														<div class="review-table">
															<div class="table-responsive">
																<table class="table table-bordered">
																	<thead>
																		<tr>
																			<th class="cell-label">&nbsp;</th>
																			<th>1 sao</th>
																			<th>2 sao</th>
																			<th>3 sao</th>
																			<th>4 sao</th>
																			<th>5 sao</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td class="cell-label">Giá trị</td>
																			<td><input type="radio" name="quality" class="radio" value="1"></td>
																			<td><input type="radio" name="quality" class="radio" value="2"></td>
																			<td><input type="radio" name="quality" class="radio" value="3"></td>
																			<td><input type="radio" name="quality" class="radio" value="4"></td>
																			<td><input type="radio" name="quality" class="radio" value="5"></td>
																		</tr>
																		<tr>
																			<td class="cell-label">Giá cả</td>
																			<td><input type="radio" name="price" class="radio" value="1"></td>
																			<td><input type="radio" name="price" class="radio" value="2"></td>
																			<td><input type="radio" name="price" class="radio" value="3"></td>
																			<td><input type="radio" name="price" class="radio" value="4"></td>
																			<td><input type="radio" name="price" class="radio" value="5"></td>
																		</tr>
																		<tr>
																			<td class="cell-label">Giá trị</td>
																			<td><input type="radio" name="value" class="radio" value="1"></td>
																			<td><input type="radio" name="value" class="radio" value="2"></td>
																			<td><input type="radio" name="value" class="radio" value="3"></td>
																			<td><input type="radio" name="value" class="radio" value="4"></td>
																			<td><input type="radio" name="value" class="radio" value="5"></td>
																		</tr>
																	</tbody>
																</table><!-- /.table .table-bordered -->
															</div><!-- /.table-responsive -->
														</div><!-- /.review-table -->

														<div class="review-form">
															<div class="form-container">


																<div class="row">
																	<div class="col-sm-6">
																		<div class="form-group">
																			<label for="exampleInputName">Tên bạn <span class="astk">*</span></label>
																			<input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="name" required="required">
																		</div><!-- /.form-group -->
																		<div class="form-group">
																			<label for="exampleInputSummary">Tóm tắt <span class="astk">*</span></label>
																			<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="" name="summary" required="required">
																		</div><!-- /.form-group -->
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<label for="exampleInputReview">Đánh giá <span class="astk">*</span></label>

																			<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="review" required="required"></textarea>
																		</div><!-- /.form-group -->
																	</div>
																</div><!-- /.row -->

																<div class="action text-right">
																	<button name="submit" class="btn btn-primary btn-upper">ĐÁNH GIÁ</button>
																</div><!-- /.action -->

												</form><!-- /.cnt-form -->
											</div><!-- /.form-container -->
										</div><!-- /.review-form -->

									</div><!-- /.product-add-review -->

								</div><!-- /.product-tab -->
							</div><!-- /.tab-pane -->



						</div><!-- /.tab-content -->
					</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.product-tabs -->

	<?php $cid = $row['category'];
					$subcid = $row['subcategory'];
				} ?>

	</div><!-- /.col -->
	<div class="clearfix"></div>
	</div>
	</div>
	</div>
	<?php include('includes/footer.php'); ?>

	<script src="assets/js/jquery-1.11.1.min.js"></script>

	<script src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>

	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
	<script src="assets/js/jquery.rateit.min.js"></script>
	<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
	<script src="assets/js/bootstrap-select.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->

	<script src="switchstylesheet/switchstylesheet.js"></script>

	<script>
		$(document).ready(function() {
			$(".changecolor").switchstylesheet({
				seperator: "color"
			});
			$('.show-theme-options').click(function() {
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
			$('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->



</body>

</html>
<!-- <div class="HoUsOy" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;">Tổng quan</div><ul style="box-sizing: border-box; margin-bottom: 0px; margin-left: 0px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-size: 14px;"><li class="_1KuY3T row" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; list-style: none; display: flex; flex-flow: row wrap; width: 731px;"><div class="vmXPri col col-3-12" style="box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 182.75px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);">Trọng lượng sản phẩm</div><ul class="_3dG3ix col col-9-12" style="box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;"><li class="sNqDog" style="box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;">240 g</li></ul></li><li class="_1KuY3T row" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; list-style: none; display: flex; flex-flow: row wrap; width: 731px;"><div class="vmXPri col col-3-12" style="box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 182.75px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);">Phiên bản CPU</div><ul class="_3dG3ix col col-9-12" style="box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;"><li class="sNqDog" style="box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;">Apple A16 Bionic</li></ul></li><li class="_1KuY3T row" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; list-style: none; display: flex; flex-flow: row wrap; width: 731px;"><div class="vmXPri col col-3-12" style="box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 182.75px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);">Số nhân</div><ul class="_3dG3ix col col-9-12" style="box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;"><li class="sNqDog" style="box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;">6</li></ul></li><li class="_1KuY3T row" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; list-style: none; display: flex; flex-flow: row wrap; width: 731px;"><div class="vmXPri col col-3-12" style="box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 182.75px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);">Kích thước màn hình</div><ul class="_3dG3ix col col-9-12" style="box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;"><li class="sNqDog" style="box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;">6.7 inch</li></ul></li><li class="_1KuY3T row" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; list-style: none; display: flex; flex-flow: row wrap; width: 731px;"><div class="vmXPri col col-3-12" style="box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 182.75px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);">Độ phân giải</div><ul class="_3dG3ix col col-9-12" style="box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;"><li class="sNqDog" style="box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;">2796 x 1290 Pixels</li></ul></li><li class="_1KuY3T row" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; list-style: none; display: flex; flex-flow: row wrap; width: 731px;"><div class="vmXPri col col-3-12" style="box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 182.75px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);">Bộ nhớ trong</div><ul class="_3dG3ix col col-9-12" style="box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;"><li class="sNqDog" style="box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;">128 GB</li></ul></li><li class="_1KuY3T row" style="box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; list-style: none; display: flex; flex-flow: row wrap; width: 731px;"><div class="vmXPri col col-3-12" style="box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 182.75px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);">Màu sắc</div><ul class="_3dG3ix col col-9-12" style="box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;"><li class="sNqDog" style="box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;">Đen</li></ul></li></ul> -->