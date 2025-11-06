<?php

/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<style>
		/* --- Header Wrapper: Use Flexbox for horizontal alignment --- */
		.custom-header-bar {
			display: flex;
			align-items: center;
			/* Vertically center all items */
			justify-content: space-between;
			/* Distribute space between sections */
			padding: 0 15px;
			/* Add some padding on the sides */
			background-color: #fff;
			border-bottom: 1px solid #eee;
			height: 60px;
			/* Set a consistent height */
		}

		/* --- Group C Title --- */
		.custom-logo-area {
			/* Group C is part of the Home tab group visually */
			display: flex;
			align-items: stretch;
			/* Stretch to cover full height */
			height: 100%;
		}

		.custom-group-title {
			display: flex;
			align-items: center;
			padding: 0 15px;
			font-weight: bold;
			color: #333;
			font-size: 1.1em;
			border-right: 1px solid #ddd;
			height: 100%;
		}

		/* --- Home Tab (Active/Highlighted) --- */
		.custom-nav-main {
			height: 100%;
		}

		.custom-nav-item {
			display: inline-flex;
			align-items: center;
			padding: 0 20px;
			text-decoration: none;
			color: #333;
			font-weight: 500;
			height: 100%;
			transition: background-color 0.2s;
		}

		.custom-active {
			background-color: #f0f0f0;
			/* Light gray background for 'Home' */
		}

		/* --- Search Form Container --- */
		.custom-search-inline {
			display: flex;
			margin-left: 20px;
			align-items: center;
			/* Căn giữa dọc các thành phần input/button */
		}

		.custom-search-form {
			display: flex;
			align-items: center;
		}

		/* ------------------------------------------------------------------ */
		/* --- Search Form & Submit Button (FINAL STYLES with !important) --- */
		/* ------------------------------------------------------------------ */

		.custom-search-input {
			padding: 8px 10px !important;
			/* Viền mỏng, màu sáng */
			border: 1px solid #ccc !important;
			/* Bo góc hoàn toàn */
			border-radius: 4px !important;
			width: 250px !important;
			height: 38px !important;
			box-sizing: border-box !important;
			font-size: 1em !important;
			/* KHOẢNG CÁCH giữa input và button */
			margin-right: 8px !important;
			/* Màu chữ placeholder/text xám */
			color: #444 !important;
			/* Đảm bảo nền là màu trắng */
			background-color: #fff !important;
		}

		.custom-submit-button {
			padding: 8px 15px !important;
			/* Màu nền trắng */
			background-color: #fff !important;
			/* Viền mỏng, màu sáng */
			border: 1px solid #ccc !important;
			/* Chữ màu xám đậm */
			color: #444 !important;
			/* Chữ đậm vừa phải */
			font-weight: 500 !important;
			cursor: pointer !important;
			height: 38px !important;
			/* Chữ thường, không in hoa */
			text-transform: none !important;
			/* Bo góc hoàn toàn */
			border-radius: 4px !important;
			box-sizing: border-box !important;
			transition: background-color 0.2s !important;
		}

		.custom-submit-button:hover {
			background-color: #f0f0f0 !important;
			/* Hiệu ứng hover nhẹ (màu xám nhạt hơn) */
		}

		/* ------------------------------------------------------------------ */
		/* --- Secondary Navigation Links --- */
		.custom-nav-secondary {
			margin-left: auto;
			/* đẩy phần danh mục qua bên phải */
			display: flex;
			align-items: center;
		}

		.custom-nav-secondary ul {
			list-style: none;
			padding: 0;
			margin: 0 60px 0 0;
			/* đẩy sang phải hơn (so với search) */
			display: flex;
			gap: 35px;
			/* khoảng cách giữa các mục */
		}

		.custom-nav-secondary li a {
			text-decoration: none;
			color: #222;
			/* đậm hơn một chút */
			font-size: 1em;
			font-weight: 700;
			/* in đậm chữ */
			transition: color 0.2s;
		}

		.custom-nav-secondary li a:hover {
			color: #0073aa;
			/* đổi màu khi hover (màu xanh nhạt) */
		}

		/* --- Right-Side Toggles (Menu, Search, Account) --- */
		.custom-toggles-right {
			display: flex;
			align-items: center;
			margin-left: auto;
			/* Push to the right */
			gap: 20px;
		}

		/* --- Icon Buttons: Menu and Search --- */
		.custom-menu-toggle,
		.custom-search-icon {
			display: flex;
			flex-direction: column;
			align-items: center;
			background: none;
			border: none;
			padding: 0;
			cursor: pointer;
			color: #666;
		}

		.custom-toggle-label {
			font-size: 0.65em;
			margin-top: -3px;
			font-weight: 500;
		}

		.custom-icon-dots {
			font-size: 1.2em;
			/* Visually represents the three dots */
			line-height: 1;
		}

		.custom-icon-search svg {
			width: 20px;
			height: 20px;
			stroke-width: 2.5;
		}

		/* --- Account Dropdown --- */
		.custom-account-dropdown {
			display: flex;
			align-items: center;
			padding: 5px 10px;
			cursor: pointer;
			/* Create the light border/outline shown in the image */
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 0.9em;
		}

		.custom-icon-account {
			margin-right: 5px;
			color: #666;
			line-height: 0;
		}

		.custom-icon-account svg {
			width: 22px;
			height: 22px;
			stroke-width: 2;
			fill: #ddd;
			/* Match the gray background for the person icon */
		}

		.custom-account-label {
			font-weight: 500;
			color: #333;
		}

		.custom-dropdown-arrow {
			font-size: 0.6em;
			margin-left: 5px;
			position: relative;
			top: -1px;
			color: #666;
		}
	</style>

</head>

<body <?php body_class(); ?>>

	<?php
	wp_body_open();
	?>

	<header id="site-header" class="header-footer-group custom-header-image-match">

		<div class="custom-header-bar">

			<div class="custom-logo-area">
				<span class="custom-group-title">Group C</span>
			</div>

			<nav class="custom-nav-main">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-nav-item custom-active">Home</a>			</nav>

			<div class="custom-search-inline">
				<form role="search" method="get" class="custom-search-form" action="<?php echo esc_url(home_url('/')); ?>">
					<input type="search" class="custom-search-input" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" />
					<input type="submit" class="custom-submit-button" value="Submit" />
				</form>
			</div>

			<nav class="custom-nav-secondary">
				<ul>
					<?php
					$categories = get_categories(array(
						'orderby' => 'name',
						'order'   => 'ASC'
					));

					foreach ($categories as $category) {
						$category_link = get_category_link($category->term_id);
						echo '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
					}
					?>
				</ul>
			</nav>

			<div class="custom-toggles-right">

				<button class="custom-menu-toggle">
					<span class="custom-icon-dots">•••</span>
					<span class="custom-toggle-label">Menu</span>
				</button>

				<button class="custom-search-icon">
					<span class="custom-icon-search">
						<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
					</span>
					<span class="custom-toggle-label">Search</span>
				</button>

				<div class="custom-account-dropdown">
					<span class="custom-icon-account">
						<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
							<circle cx="12" cy="7" r="4"></circle>
						</svg>
					</span>
					<span class="custom-account-label">Account</span>
					<span class="custom-dropdown-arrow">▼</span>
				</div>
			</div>

		</div>
	</header>
	<?php
	// The menu modal and search modal from the original theme would likely be removed
	// or heavily modified to work with this new structure.
	// For now, we'll keep the function calls outside the header tags.
	get_template_part('template-parts/modal-menu');
