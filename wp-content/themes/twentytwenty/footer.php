<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- Footer -->
<!-- Footer -->
<section id="footer">
	<div class="row">
		<div class="col-md-4 sidebar-widget">
			<h3>Danh Mục</h3>
			<?php if (is_active_sidebar('sidebar-4')) : ?>
				<?php dynamic_sidebar('sidebar-4'); ?>
			<?php endif; ?>
		</div>
		<div class="col-md-4 sidebar-widget">
			<h3>Bài Viết</h3>
			<?php if (is_active_sidebar('sidebar-5')) : ?>
				<?php dynamic_sidebar('sidebar-5'); ?>
			<?php endif; ?>
		</div>
		<div class="col-md-4 sidebar-widget">
			<h3>Bình Luận</h3>
			<?php if (is_active_sidebar('sidebar-6')) : ?>
				<?php dynamic_sidebar('sidebar-6'); ?>
			<?php endif; ?>
		</div>
	</div>


	<div class="row mt-4">
		<div class="col-12 text-center">
			<ul class="list-inline social">
				<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-facebook"></i></a></li>
				<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-twitter"></i></a></li>
				<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-instagram"></i></a></li>
				<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-google-plus"></i></a></li>
				<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02" target="_blank"><i class="fa fa-envelope"></i></a></li>
			</ul>
		</div>
	</div>

	<hr class="bg-white">

	<div class="row">
		<div class="col-12 text-center text-white">
			<p><u><a href="https://www.nationaltransaction.com/" class="text-white">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
			<p class="h6">© All rights Reserved. <a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a></p>
		</div>
	</div>
	</div>
</section>

<!-- ./Footer -->


<style>
	/* Footer */
	@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	/* Social Icons Section */
	#footer ul.social {
		text-align: center;
		/* Center align the icons */
		padding: 0;
		margin-top: 40px;
		/* Spacing for the social icons */
	}

	#footer ul.social li {
		display: inline-block;
		margin-right: 20px;
		/* Space between each icon */
	}

	#footer ul.social li a {
		color: #ffffff;
		text-decoration: none;
		transition: 0.3s;
	}

	#footer ul.social li a i {
		font-size: 40px;
		/* Larger icon size */
		transition: 0.3s ease-in-out;
	}

	#footer ul.social li::before {
		content: "";
		/* Remove the "»" symbol */
	}

	#footer ul.social li:hover a i {
		font-size: 50px;
		/* Icon grows on hover */
		margin-top: -5px;
		/* Optional slight shift for effect */
		transform: scale(1.2);
		/* Smooth scaling of the icon */
	}

	#footer ul.social li a:hover {
		color: #eeeeee;
		/* Change icon color when hovered */
	}


	/* Widget Section Styling */
	#footer {
		background: #007b5e !important;
		padding: 60px 40px;
		/* Padding for sides */
	}

	#footer h3 {
		font-size: 1.6rem;
		/* Increase header font size */
		padding-left: 10px;
		border-left: 3px solid #eeeeee;
		padding-bottom: 6px;
		margin-bottom: 20px;
		color: #ffffff;
	}

	#footer ul {
		list-style: none;
		padding-left: 0;
		margin: 0;
	}

	#footer ul li {
		font-size: 20px;
		/* Bigger text size */
		margin-bottom: 0.6em;
	}

	#footer ul li::before {
		content: "»";
		color: #ffffff;
		font-weight: bold;
		margin-right: 5px;
	}

	#footer ul li a {
		color: #ffffff;
		text-decoration: none;
		transition: 0.3s;
		font-weight: normal;
		/* Normal weight for non-hover state */
	}

	#footer ul li:hover a {
		font-size: 30px;
		font-weight: bold;
		/* Make text bold when hovered */
		color: #eeeeee;
		/* Change color when hovered */
		transform: scale(1.05);
		/* Slight scale up on hover */
	}

	#footer .container {
		max-width: 1200px;
		/* Max width for container */
		margin: 0 auto;
		/* Center align */
	}
</style>
</body>

</html>