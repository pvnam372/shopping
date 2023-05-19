<?php
//session_start();

?>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">

					<?php if (strlen($_SESSION['login'])) {   ?>
						<li><a href="#"><i class="icon fa fa-user"></i>Chào mừng - <?php echo htmlentities($_SESSION['username']); ?></a></li>
					<?php } ?>

					<li><a href="my-account.php"><i class="icon fa fa-user"></i>Tài khoản của tôi</a></li>
					<li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Danh sách mong muốn</a></li>
					<li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng của tôi</a></li>
					<li><a href="#"><i class="icon fa fa-key"></i>Thanh toán</a></li>
					<?php if (strlen($_SESSION['login']) == 0) {   ?>
						<li><a href="login.php"><i class="icon fa fa-sign-in"></i>Đăng nhập</a></li>
					<?php } else { ?>

						<li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Đăng xuất</a></li>
					<?php } ?>
				</ul>
			</div><!-- /.cnt-account -->

			<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="track-orders.php" class="dropdown-toggle"><span class="key">Theo dõi đơn hàng</b></a>

					</li>


				</ul>
			</div>

			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->