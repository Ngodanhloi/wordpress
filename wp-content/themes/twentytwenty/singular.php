<?php
get_header();
?>

<div class="main-layout">
	<!-- Cột trái: Danh mục -->
	<aside class="left-sidebar">
		<h3 class="sidebar-title">Danh mục</h3>
		<ul class="category-list">
			<?php
			$categories = get_categories();
			foreach ($categories as $cat) {
				echo '<li><a href="' . get_category_link($cat->term_id) . '">' . esc_html($cat->name) . '</a></li>';
			}
			?>
		</ul>
	</aside>

	<!-- Cột giữa: Chi tiết bài viết -->
	<section class="content-area">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
				<article class="single-post">
					<div class="post-header">
						<h1 class="post-title"><?php the_title(); ?></h1>
						<div class="post-meta">
							<span class="post-date" aria-hidden="false">
								<div class="date-inner">
									<div class="day-month">
										<span class="day"><?php echo get_the_date('d'); ?></span>
										<span class="divider"></span>
										<span class="month"><?php echo get_the_date('m'); ?></span>
									</div>
									<span class="year"><?php echo get_the_date('y'); ?></span>
								</div>
							</span>
						</div>
					</div>

					<div class="post-content">
						<?php the_content(); ?>
					</div>

					<!-- ✅ Tác giả ở cuối bài viết -->
					<div class="post-author-bottom">
						<span>✍️ Tác giả: <?php the_author(); ?></span>
					</div>
				</article>
		<?php endwhile;
		endif;
		?>
	</section>

	<!-- Cột phải: Bài viết gần đây (Background màu xanh ngọc/teal) -->
	<aside class="right-sidebar">
		<h3 class="sidebar-title">Bài viết gần đây</h3>
		<?php
		$recent_posts = wp_get_recent_posts(array(
			'numberposts' => 5,
			'post_status' => 'publish',
		));
		foreach ($recent_posts as $p) {
			// Lấy ngày, tháng, năm riêng biệt
			$post_day = get_the_date('d', $p['ID']);
			$post_month = get_the_date('m', $p['ID']);
			$post_year = get_the_date('y', $p['ID']);

			echo '<div class="latest-post-item">';

			// CẬP NHẬT PHP: Sử dụng cấu trúc tương tự khối lớn nhưng với class riêng
			echo '<div class="latest-post-meta-box">';
			echo '<span class="latest-post-date-circle" aria-hidden="false">';
			echo '<div class="latest-date-inner">';
			echo '<div class="latest-day-month">';
			echo '<span class="latest-day">' . $post_day . '</span>';
			// Sử dụng divider mini
			echo '<span class="latest-divider"></span>';
			echo '<span class="latest-month">' . $post_month . '</span>';
			echo '</div>'; // End latest-day-month
			echo '<span class="latest-year">' . $post_year . '</span>';
			echo '</div>'; // End latest-date-inner
			echo '</span>'; // End latest-post-date-circle
			echo '</div>'; // End latest-post-meta-box

			echo '<div class="latest-post-content">';
			echo '<a href="' . get_permalink($p['ID']) . '">' . esc_html($p['post_title']) . '</a>';
			echo '</div>'; // End latest-post-content

			echo '</div>';
		}
		?>
	</aside>
</div>
</div>

<!-- Phần điều hướng bài viết trước/sau -->
<div class="below-layout-box">
	<div class="post-navigation">
		<div class="prev"><?php previous_post_link('%link', '← Bài trước'); ?></div>
		<div class="next"><?php next_post_link('%link', 'Bài sau →'); ?></div>
	</div>
</div>

<!-- Phần bình luận -->
<div class="below-layout-box">
	<div class="post-comments">
		<?php
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
		?>
	</div>
</div>

<style>
	/* Cấu trúc Layout 3 cột */
	.main-layout {
		display: grid;
		grid-template-columns: 1fr 2fr 1fr;
		gap: 20px;
		max-width: 1200px;
		margin: 20px auto;
		padding: 0 15px;
		/* Thêm padding để responsive tốt hơn */
	}

	.left-sidebar,
	.right-sidebar,
	.content-area {
		background: #fff;
		border: 1px solid #ddd;
		padding: 15px;
		border-radius: 8px;
	}

	.below-layout-box {
		max-width: 1200px;
		margin: 20px auto 40px;
		background: #fff;
		border: 1px solid #ddd;
		padding: 20px;
		border-radius: 8px;
	}

	/* Tiêu đề và Navigation */
	.post-navigation {
		display: flex;
		justify-content: space-between;
	}

	.sidebar-title {
		font-size: 1.5em;
		margin-bottom: 15px;
		border-bottom: 2px solid #00b3b3;
		padding-bottom: 5px;
	}

	/* ----------------------------------------------------- */
	/* --- KHỐI NGÀY THÁNG LỚN (CHI TIẾT BÀI VIẾT) --- */
	/* ----------------------------------------------------- */
	.post-header {
		border-bottom: 2px solid #ddd;
		padding-bottom: 15px;
		margin-bottom: 20px;
		display: flex;
		align-items: center;
		gap: 20px;
	}

	.single-post .post-title {
		flex: 1;
		font-size: 32px;
		font-weight: bold;
		color: #333;
		margin: 0;
	}

	/* 1. Vòng tròn màu vàng (Position Context) */
	.post-meta .post-date {
		background-color: #FFCC00;
		/* Màu vàng */
		color: #333;
		width: 90px;
		height: 90px;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		font-weight: bold;
		font-family: 'Inter', sans-serif;
		flex-shrink: 0;
		position: relative;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}

	/* ĐÃ CHỈNH SỬA: Dùng Flexbox cho khối date-inner */
	.post-meta .post-date .date-inner {
		display: flex;
		flex-direction: row;
		/* Xếp ngày/tháng và năm ngang hàng */
		align-items: center;
		/* Căn giữa theo chiều dọc */
		justify-content: center;
	}

	.post-meta .post-date .day-month {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		/* ĐÃ CHỈNH SỬA: Giảm margin để số năm sát vào hơn */
		margin-right: 0px;
	}

	.post-meta .post-date .day {
		font-size: 26px;
		line-height: 1;
		border-bottom: 2px solid #222;
		/* Dùng border thay cho text-decoration: underline */
		padding-bottom: 2px;
		margin-bottom: 2px;
	}

	.post-meta .post-date .divider {
		display: none;
		/* Ẩn divider cũ */
	}

	.post-meta .post-date .month {
		font-size: 16px;
		line-height: 1;
		margin-top: 3px;
	}

	/* ĐÃ CHỈNH SỬA: Loại bỏ định vị tuyệt đối, chỉ cần margin-left */
	.post-meta .post-date .year {
		position: static;
		/* Quan trọng: Đổi sang static để Flexbox hoạt động */
		font-size: 18px;
		font-weight: bold;
		line-height: 1;
		/* Điều chỉnh khoảng cách ngang */
		margin-left: 2px;
	}


	/* --- NỘI DUNG BÀI VIẾT & TÁC GIẢ --- */
	.post-content {
		font-size: 16px;
		line-height: 1.6;
		color: #333;
	}

	.post-author-bottom {
		margin-top: 30px;
		padding-top: 15px;
		border-top: 1px solid #ddd;
		font-size: 15px;
		color: #555;
		font-style: italic;
		text-align: right;
	}

	.right-sidebar .latest-post-item {
		background-color: #00b3b3;
		padding: 10px;
		margin-bottom: 15px;
		border-radius: 8px;
		color: #fff;
		/* Cập nhật transition mượt mà hơn */
		transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
		display: flex;
		align-items: center;
		gap: 15px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		/* Đổi shadow mặc định */
		height: 60px;
	}

	.right-sidebar .latest-post-item:hover {
		/* Nổi lên và trượt nhẹ lên trên */
		transform: translateY(-3px) scale(1.01);
		box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
		/* Shadow sâu hơn khi hover */
		background-color: #009999;
		/* Hơi tối màu khi hover */
	}

	/* Khối chứa Ngày Tháng Mini (Màu Vàng, Hình Tròn) */
	.right-sidebar .latest-post-meta-box {
		flex-shrink: 0;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 50px;
		height: 50px;
		border-radius: 50%;
		color: #333;
		position: relative;
		font-weight: bold;
		/* Thêm shadow cho khối vàng */
	}

	.right-sidebar .latest-date-inner {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}

	.right-sidebar .latest-day-month {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		margin-right: 8px;
	}

	.right-sidebar .latest-day {
		font-size: 16px;
		line-height: 1;
		border-bottom: 1px solid #222;
		padding-bottom: 1px;
		margin-bottom: 1px;
	}

	.right-sidebar .latest-month {
		font-size: 10px;
	}

	/* Năm (Year) - Định vị tuyệt đối */
	.right-sidebar .latest-year {
		position: absolute;
		font-size: 10px;
		top: 50%;
		/* Đặt năm ở giữa chiều dọc */
		right: 8px;
		/* Điều chỉnh vị trí sang phải */
		transform: translateY(-50%);
		/* Dịch lên nửa chiều cao để căn giữa hoàn hảo */
		font-weight: bold;
		line-height: 1;
	}

	/* Khối chứa tiêu đề bài viết */
	.right-sidebar .latest-post-content {
		flex: 1;
		display: flex;
		flex-direction: column;
		overflow: hidden;
	}

	.right-sidebar .latest-post-content a {
		font-size: 14px;
		color: #fff;
		text-decoration: none;
		font-weight: 500;
		margin-bottom: 0;
		line-height: 1.4;
	}

	.right-sidebar .latest-post-content a:hover {
		text-decoration: underline;
	}

	/* Ẩn class latest-post-date cũ */
	.right-sidebar .latest-post-item .latest-post-date {
		display: none;
	}

	/* --- RESPONSIVE CHO MOBILE --- */
	@media (max-width: 1024px) {
		.main-layout {
			grid-template-columns: 1fr 2fr;
		}

		.left-sidebar {
			grid-column: 1 / 3;
			order: 3;
			margin-top: 0;
		}
	}

	@media (max-width: 768px) {
		.main-layout {
			grid-template-columns: 1fr;
		}

		.left-sidebar,
		.right-sidebar {
			grid-column: 1;
			order: unset;
		}

		.post-header {
			flex-direction: column;
			align-items: flex-start;
		}

		.post-meta {
			margin-bottom: 15px;
		}
	}
</style>

<?php get_footer(); ?>