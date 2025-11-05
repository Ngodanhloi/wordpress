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

							<!-- 1. Tiêu đề bài viết (Đẩy sang trái) -->
							<h1 class="post-title"><?php the_title(); ?></h1>

							<!-- 2. Khối ngày tháng hình tròn (lớn, màu vàng - Đẩy sang phải) -->
							<div class="post-meta">
								<span class="post-date" aria-hidden="false">
									<div class="date-inner">
										<div class="day-month">
											<span class="day"><?php echo get_the_date('d'); ?></span>
											<span class="divider"></span>
											<span class="month"><?php echo get_the_date('m'); ?></span>
										</div>
										<!-- Year được đặt ở đây và sẽ được định vị tuyệt đối bằng CSS -->
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

	<!-- Phần điều hướng bài viết trước/sau (GỌI TEMPLATE MỚI) -->
	<?php get_template_part('navigation'); ?>

	<!-- Phần bình luận -->
	<div class="">
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
			border: 1px solid #ddd;
			padding: 20px;
			border-radius: 8px;
		}

		/* CẬP NHẬT CSS: Đặt màu nền xanh nhạt cho khối điều hướng (Đã xóa các quy tắc Navigation) */
		.nav-section-box {
			background: #E0F2F1;
			/* Màu xanh lá/xanh lam nhạt */
			border: none;
		}

		/* ----------------------------------------------------- */
		/* --- KHỐI NGÀY THÁNG LỚN (CHI TIẾT BÀI VIẾT) --- */
		/* ----------------------------------------------------- */
		.sidebar-title {
			font-size: 1.5em;
			margin-bottom: 15px;
			border-bottom: 2px solid #00b3b3;
			padding-bottom: 5px;
		}

		.post-header {
			border-bottom: 2px solid #ddd;
			padding-bottom: 15px;
			margin-bottom: 20px;
			display: flex;
			flex-direction: row;
			align-items: center;
			justify-content: space-between;
			gap: 20px;
		}

		.single-post .post-title {
			flex-grow: 1;
			order: 1;
			font-size: 32px;
			font-weight: bold;
			color: #333;
			margin: 0;
		}

		.post-meta {
			flex-shrink: 0;
			order: 2;
		}

		.post-meta .post-date {
			background-color: #FFCC00;
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

		.post-meta .post-date .date-inner {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		.post-meta .post-date .day-month {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			margin-right: 15px;
		}

		.post-meta .post-date .day {
			font-size: 26px;
			line-height: 1;
			border-bottom: 2px solid #222;
			padding-bottom: 2px;
			margin-bottom: 2px;
		}

		.post-meta .post-date .divider {
			display: none;
		}

		.post-meta .post-date .month {
			font-size: 16px;
			line-height: 1;
			margin-top: 3px;
		}

		.post-meta .post-date .year {
			position: absolute;
			font-size: 18px;
			font-weight: bold;
			line-height: 1;
			top: 50%;
			right: 15px;
			transform: translateY(-50%);
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

		/* ----------------------------------------------------- */
		/* --- BÀI VIẾT GẦN ĐÂY (Recent Posts) --- */
		/* ----------------------------------------------------- */
		.right-sidebar .latest-post-item {
			background-color: #00b3b3;
			padding: 10px;
			margin-bottom: 15px;
			border-radius: 8px;
			color: #fff;
			transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
			display: flex;
			align-items: center;
			gap: 15px;

			height: 60px;
		}

		.right-sidebar .latest-post-item:hover {
			transform: translateY(-3px) scale(1.01);
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
			background-color: #009999;
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

		}

		/* Dùng Flexbox cho khối date-inner mini */
		.right-sidebar .latest-date-inner {
			display: flex;
			flex-direction: row;
			align-items: center;
			justify-content: center;
		}

		.right-sidebar .latest-day-month {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			margin-right: 0px;
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

		/* Loại bỏ định vị tuyệt đối, chỉ cần margin-left */
		.right-sidebar .latest-year {
			position: static;
			font-size: 10px;
			font-weight: bold;
			line-height: 1;
			margin-left: 2px;
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
		/* ====== CSS THEO PHÁC HỌA (Khung trắng bên trong) ====== */

/* 1. KHU VỰC SIDEBAR BÊN NGOÀI
 * Chỉ làm nền xám và tạo khoảng đệm.
 */
.left-sidebar {
    background-color: #f8f8f8; /* NỀN XÁM NHẠT (như phác họa) */
    padding: 15px; /* Đệm xung quanh để hở khung trắng bên trong */
    width: 250px; 
    margin-bottom: 20px;
    border-radius: 5px; /* Bo góc cho khu vực xám */
}

/* 2. TIÊU ĐỀ "CATEGORIES"
 * Vẫn giữ nguyên, nằm trên khung trắng.
 */
.left-sidebar .sidebar-title {
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
    margin-top: 0;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding-left: 5px; /* Thêm đệm trái 1 chút cho đẹp */
}

/* 3. KHUNG TRẮNG (UL.CATEGORY-LIST)
 * Đây là cái khung trắng bạn vẽ.
 */
.left-sidebar .category-list {
    background-color: #ffffff; /* NỀN TRẮNG */
    border: 1px solid #e0e0e0; /* VIỀN KHUNG */
    border-radius: 4px; /* Bo góc cho khung trắng */
    padding: 15px 15px 5px 15px; /* Đệm bên trong khung trắng */
    /* (padding-bottom 5px vì mục cuối đã có margin 10px) */
    
    list-style: none; /* Xóa dấu chấm mặc định */
    margin: 0;
}

/* 4. MỖI MỤC DANH MỤC (LI)
 * Nằm bên trong khung trắng, có gạch chân.
 */
.left-sidebar .category-list li {
    position: relative; 
    padding-left: 18px; /* Khoảng trống cho dấu chấm */
    
    border-bottom: 1px solid #eee; /* Gạch chân dưới MỖI mục */
    padding-bottom: 10px; 
    margin-bottom: 10px; 
}

/* 5. XÓA GẠCH CHÂN CHO MỤC CUỐI CÙNG */
.left-sidebar .category-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

/* 6. DẤU CHẤM TÙY CHỈNH */
.left-sidebar .category-list li:before {
    content: "\2022"; 
    color: #888; 
    font-size: 1.2em; 
    position: absolute; 
    left: 0; 
    top: 0;
    line-height: inherit; 
}

/* 7. LIÊN KẾT (A) */
.left-sidebar .category-list li a {
    text-decoration: none; 
    color: #555; 
    font-size: 0.95em; 
    transition: color 0.3s ease; 
    display: block; 
}

/* 8. HIỆU ỨNG HOVER */
.left-sidebar .category-list li a:hover {
    color: #0073aa; 
}
	</style>

	<?php get_footer(); ?>