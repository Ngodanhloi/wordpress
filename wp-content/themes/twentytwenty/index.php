<?php get_header(); ?>

<?php if (is_search()) : ?>

	<div class="main-content-grid">
		<?php // 
		?>

		<aside class="left-sidebar-custom">
			<h3 class="sidebar-title">Bài viết mới nhất</h3>
			<ul class="recent-posts-list">
				<?php
				// Tạo một vòng lặp (Query) mới để lấy 3 bài mới nhất
				$args_moi = array(
					'posts_per_page' => 3,
					'ignore_sticky_posts' => 1
				);
				$query_moi = new WP_Query($args_moi);
				if ($query_moi->have_posts()) :
					while ($query_moi->have_posts()) : $query_moi->the_post();
				?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
				<?php
					endwhile;
					wp_reset_postdata(); // else :
					echo '<li>Không có bài viết mới.</li>';
				endif;
				?>
			</ul>
		</aside>

		<main class="middle-content">

			<?php // 
			?>
			<div class="kq-tim-kiem">
				<div class="kq-tim-kiem-header">
					<h2>Kết quả tìm kiếm cho: <span class="highlight">"<?php echo esc_html(get_search_query()); ?>"</span></h2>
				</div>

				<div class="ket-qua">
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<article class="bai-tim-kiem">
								<?php
								if (has_post_thumbnail()) : ?>
									<div class="anh-dai-dien">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium'); ?>
										</a>
									</div>
								<?php endif; ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
							</article>
						<?php endwhile; ?>
					<?php else : ?>
						<div class="khong-tim-thay">
							<p>Không tìm thấy kết quả nào cho từ khóa này.</p>
							<p>Thử tìm lại với từ khóa khác:</p>
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>
				</div> <?php
						if (have_posts()) : ?>
					<div class="phan-trang">
						<?php the_posts_pagination(array(
								'mid_size'  => 2,
								'prev_text' => __('« Trước', 'textdomain'),
								'next_text' => __('Sau »', 'textdomain'),
							)); ?>
					</div>
				<?php endif; ?>

			</div>
		</main>

		<aside class="right-sidebar-empty">
			<?php // 
			?>
		</aside>

	</div> <?php // 
			?>


<?php else : ?>

	<!-- Trang chủ -->
	<div class="trang-chu">
		<!-- Cột trái: Lưu trữ theo tháng -->
		<aside class="cot-trai">
			<h3 class="tieu-de-cot">Lưu trữ bài viết</h3>
			<ul class="danh-sach-luu-tru">
				<?php
				wp_get_archives(array(
					'type'  => 'monthly', // theo tháng
					'limit' => 12,
				));
				?>
			</ul>
		</aside>

		<!-- Cột giữa: Nội dung chính -->
		<section class="noi-dung-chinh">
			<?php if (have_posts()) :
				while (have_posts()) : the_post();
					get_template_part('template-parts/content');
				endwhile;

				the_posts_pagination(array(
					'mid_size'  => 2,
					'prev_text' => __('« Trước', 'textdomain'),
					'next_text' => __('Sau »', 'textdomain'),
				));
			else :
				echo '<p>Hiện chưa có bài viết nào.</p>';
			endif; ?>
		</section>

		<!-- Cột phải: Bình luận gần đây -->
		<aside class="cot-phai">
			<h3 class="tieu-de-cot">Bình luận gần đây</h3>
			<?php
			$binh_luan_moi = get_comments(array(
				'number' => 5,
				'status' => 'approve',
			));

			if ($binh_luan_moi) {

				echo '<ul class="comment-list">';

				foreach ($binh_luan_moi as $bl) {
					$link_binh_luan = get_comment_link($bl->comment_ID);

					$comment_snippet = wp_trim_words($bl->comment_content, 10, '...');

					echo '<li class="binh-luan-moi">';

					echo '<a href="' . esc_url($link_binh_luan) . '">' . esc_html($comment_snippet) . '</a>';


					echo '</li>';
				}

				echo '</ul>';
			} else {

				echo '<p>Chưa có bình luận nào.</p>';
			}
			?>
		</aside>
	</div>

<?php endif; ?>

<style>
	/* ====== Trang tìm kiếm ====== */

	/* ====== Trang chủ ====== */
	.trang-chu {
		display: grid;
		grid-template-columns: 1fr 2fr 1fr;
		gap: 20px;
		max-width: 1200px;
		margin: 20px auto;
	}

	.cot-trai,
	.cot-phai,
	.noi-dung-chinh {
		background: #fff;
		border: 1px solid #ddd;
		padding: 15px;
		border-radius: 8px;
	}

	.danh-sach-luu-tru,
	.binh-luan-moi {
		list-style: none;
		padding: 0;
		margin: 0 0 10px 0;
	}

	.binh-luan-moi a {
		color: #0073aa;
		text-decoration: none;
		font-weight: 500;
	}

	.tac-gia {
		font-size: 12px;
		color: #777;
		margin-left: 5px;
	}

	@media (max-width: 992px) {
		.trang-chu {
			grid-template-columns: 1fr;
		}
	}

	/* 1. KHUNG XÁM BÊN NGOÀI (ASIDE.COT-PHAI) */
	/* ---- CSS MỚI CHO "BÌNH LUẬN GẦN ĐÂY" (GIỐNG DANH MỤC) ---- */

	/* 1. XÓA NỀN XÁM (NẾU CÓ) */
	.cot-phai .comment-list {
		background-color: transparent;
		border: none;
		list-style: none;

		/* HAI DÒNG NÀY SẼ SỬA LỖI BỊ THỤT VÀO:
    */
		padding: 0;
		margin: 0;
	}

	/* 2. TIÊU ĐỀ (Giống "DANH MỤC") */
	.cot-phai .tieu-de-cot {
		font-size: 1.2em;
		font-weight: bold;
		color: #333;
		margin-top: 0;
		text-transform: uppercase;
		letter-spacing: 0.5px;

		/* GẠCH CHÂN ĐEN DÀY */
		border-bottom: 3px solid #000;
		padding-bottom: 10px;
		margin-bottom: 15px;
		width: fit-content;
		margin-left: 0;
		margin-right: auto;
	}

	/* 3. KHUNG DANH SÁCH (UL.COMMENT-LIST) */
	.cot-phai .comment-list {
		background-color: transparent;
		/* Xóa nền trắng */
		border: none;
		/* Xóa viền trắng */
		padding: 0;
		list-style: none;
		margin: 0;
	}

	/* 4. MỖI MỤC BÌNH LUẬN (LI) */
	.cot-phai .comment-list li.binh-luan-moi {
		position: relative;
		padding-left: 20px;
		/* Khoảng trống cho dấu » */

		/* Gạch chân mỏng */
		border-bottom: 1px solid #eee;

		padding-top: 10px;
		padding-bottom: 10px;
		margin: 0;
	}

	/* 5. XÓA GẠCH CHÂN MỤC CUỐI */
	.cot-phai .comment-list li.binh-luan-moi:last-child {
		border-bottom: none;
		padding-bottom: 0;
	}

	/* 6. DẤU » TÙY CHỈNH (Giống "Danh mục") */
	.cot-phai .comment-list li.binh-luan-moi:before {
		/* Dùng dấu chevron » */
		color: #555;
		font-size: 1.2em;
		font-weight: bold;
		position: absolute;
		left: 0;
		top: 10px;
		/* Căn chỉnh dấu » */
		line-height: 1;
	}

	/* 7. LIÊN KẾT (A) BÊN TRONG */
	.cot-phai .comment-list li a {
		text-decoration: none;
		color: #333;
		/* Màu chữ đậm */
		font-size: 0.95em;
		font-weight: 500;
	}

	/* 8. HIỆU ỨNG HOVER */
	.cot-phai .comment-list li a:hover {
		color: #0073aa;
	}

	/* 9. TÁC GIẢ (SPAN.TAC-GIA) */
	.cot-phai .comment-list .tac-gia {
		font-size: 0.95em;
		color: #777;
		/* Màu xám nhạt hơn */
	}

	/* Áp dụng cho cả 3 cột */
	/* ---- BỐ CỤC 3 CỘT MỚI CHO TRANG TÌM KIẾM ---- */

	.ket-qua {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 20px;
	}

	.bai-tim-kiem h3 a {
		color: #0073aa;
		text-decoration: underline;
		/* <-- SỬA THÀNH 'underline' */
	}

	.main-content-grid {
		display: grid;
		/* Chia 3 cột: 1fr = 25%, 2fr = 50% */
		grid-template-columns: 1fr 2fr 1fr;
		gap: 20px;
		max-width: 1200px;
		/* Giống trang chủ */
		margin: 20px auto;
		/* Giống trang chủ */
	}

	/* CSS cho cột trái mới (bài viết mới) */
	.left-sidebar-custom {
		background: #fff;
		border: 1px solid #ddd;
		padding: 15px;
		border-radius: 8px;
	}

	.left-sidebar-custom .sidebar-title {
		font-size: 1.2em;
		font-weight: bold;
		color: #333;
		margin-top: 0;
		text-transform: uppercase;
		border-bottom: 3px solid #000;
		padding-bottom: 10px;
		margin-bottom: 15px;
		width: fit-content;
	}

	.left-sidebar-custom .recent-posts-list {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	.left-sidebar-custom .recent-posts-list li {
		padding: 8px 0;
		border-bottom: 1px solid #eee;
	}

	.left-sidebar-custom .recent-posts-list li:last-child {
		border-bottom: none;
	}

	.left-sidebar-custom .recent-posts-list a {
		text-decoration: none;
		color: #0073aa;
		font-weight: 500;
	}

	/* CSS cho khối .kq-tim-kiem (bỏ viền/nền bên ngoài) */
	.main-content-grid .kq-tim-kiem {
		margin: 0;
		padding: 0;
		border: none;
		background: none;
	}
</style>

<?php get_footer(); ?>