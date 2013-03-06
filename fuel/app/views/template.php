<!DOCTYPE html>
<html>
  <head>
	<title><?= isset($title) ? $title : 'ItemNation' ?></title>
	<?= Asset::css('main.css') ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<?= Asset::js('main.js') ?>
  </head>

  <body>

	<div id="wrap">

		<header>
			<div class="inner">

				<a class="sprites logo" href="index.html" title="ItemNation"></a>

				<div id="user">
					<i class="sprites user-none"></i>
					<span>Kyle Joseph <i class="sprites arrow-d"></i></span>
				</div>

			</div>
		</header>


		<div id="main">
			<div class="inner">

	<!--
			<div id="pagination">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><span>Home &amp; Garden</span></li>
				</ul>
			</div>
	-->

				<form id="search">
					<input type="text" placeholder="Search">
				</form>

				<div id="tabs">

					<ul>
						<li class="current">
							<i class="tab-r"></i>
							<i class="tab-current-first-l"></i>
							<i class="tab-current-r"></i>
							<a href="index.html">Products</a>
						</li>
						<li>
							<i class="tab-r"></i>
							<i class="tab-current-l"></i>
							<i class="tab-current-r"></i>
							<a href="wishlist.html">Wish Lists</a>
						</li>
						<li>
							<i class="tab-r"></i>
							<i class="tab-current-l"></i>
							<i class="tab-current-last-r"></i>
							<a href="myitems.html">My Items</a>
						</li>
					</ul>
				</div>


				<?= $body ?>

			</div>

		</div>

	</div>




	<footer>
		<div class="inner">

			<div class="footer-top">
				<div>
					<h3>Who are we?</h3>
			
					<ul>
						<li>
							<a href="">About us</a>
						</li>
						<li>
							<a href="">Our team</a>
						</li>

					</ul>	
				</div>

				<div>
					<h3>Social</h3>

					<ul>
						<li>
							<a href="">Twitter</a>
						</li>
						<li>
							<a href="">Facebook</a>
						</li>
					</ul>
				</div>

				<div>
					<h3>Invite your friends</h3>

					<form>
						<input type="email" placeholder="yourfriend@email.com">
					</form>


				</div>
			</div>

			<div class="footer-bottom">
				<span>&copy; 2013 ItemNation. All rights reserved. <a href="">Privacy Policy</a> - <a href="">Terms of Use</a></span>
			</div>

		</div>
	</footer>



<!-- Overlay and Dialog -->

<div id="overlay"></div>

<div class="dialog product">
	<div class="left">
		<div class="header">

			<div class="close">x</div>

			<h2>Grills - how do they work</h2>

			<div class="controls">
				<ul>
					<li>Propane</li>
					<li>Charcoal</li>
					<li>Smoker</li>
				</ul>
			</div>

		</div>

		<img src="img/sample-modal.png">

		<div class="terms">
			<h3>TERMS</h3>
			<ul>
				<li></li>
			</ul>
		</div>

	</div>
	<div class="right">

	</div>

</div>



</body>
</html>