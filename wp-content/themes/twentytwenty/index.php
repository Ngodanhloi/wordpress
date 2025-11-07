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

		<aside class="cot-phai recent-comments">
			<h3 class="sidebar-title">Bình luận gần đây</h3>
			<?php
			// BƯỚC 1: LẤY 5 BÌNH LUẬN GỐC MỚI NHẤT
			$binh_luan_moi = get_comments(array(
				'number' => 5,
				'status' => 'approve',
				'parent' => 0, // Chỉ lấy bình luận gốc
			));

			if ($binh_luan_moi) {

				echo '<ul class="comment-list">';

				// BƯỚC 2: LẶP QUA TỪNG BÌNH LUẬN GỐC
				foreach ($binh_luan_moi as $bl) {

					$link_binh_luan = get_comment_link($bl->comment_ID);
					$comment_snippet = wp_trim_words($bl->comment_content, 15, '...');

					// 1. Mở thẻ <li> cho bình luận GỐC
					echo '<li class="comment">';

					// 2. Hiển thị Avatar GỐC
					echo '<div class="comment-avatar">';
					echo get_avatar($bl, 48); // 48px
					echo '</div>';

					// 3. Hiển thị Body GỐC
					echo '<div class="comment-body">';

					echo '<div class="comment-header">';
					echo '<span class="comment-author">' . esc_html($bl->comment_author) . '</span>';
					echo '</div>';

					echo '<div class="comment-content">';
					echo '<a href="' . esc_url($link_binh_luan) . '">' . esc_html($comment_snippet) . '</a>';
					echo '</div>';

					// BƯỚC 3: TRUY VẤN VÀ HIỂN THỊ CÁC PHẢN HỒI (CON)
					$args_con = array(
						'parent' => $bl->comment_ID, // Lấy con của bình luận này
						'status' => 'approve',
						'orderby' => 'comment_date',
						'order' => 'ASC' // Hiển thị con từ cũ -> mới
					);
					$binh_luan_con = get_comments($args_con);

					if ($binh_luan_con) {
						// Mở danh sách con
						echo '<ul class="children">';

						foreach ($binh_luan_con as $bl_con) {
							$link_con = get_comment_link($bl_con->comment_ID);
							$snippet_con = wp_trim_words($bl_con->comment_content, 10, '...'); // Trích dẫn con ngắn hơn

							// Mở thẻ <li> cho bình luận CON
							echo '<li class="comment">';

							// Avatar CON (nhỏ hơn)
							echo '<div class="comment-avatar">';
							echo get_avatar($bl_con, 36); // 36px
							echo '</div>';

							// Body CON
							echo '<div class="comment-body">';
							echo '<div class="comment-header">';
							echo '<span class="comment-author">' . esc_html($bl_con->comment_author) . '</span>';
							echo '</div>';
							echo '<div class="comment-content">';
							echo '<a href="' . esc_url($link_con) . '">' . esc_html($snippet_con) . '</a>';
							echo '</div>';
							echo '</div>'; // Đóng body con

							echo '</li>'; // Đóng <li> con
						}

						echo '</ul>'; // Đóng danh sách con
					}

					// --- KẾT THÚC PHẦN HIỂN THỊ CON ---

					echo '</div>'; // Đóng body gốc
					echo '</li>'; // Đóng <li> gốc
				} // Hết vòng lặp foreach gốc

				echo '</ul>';
			} else {

				echo '<p>Chưa có bình luận nào.</p>';
			}
			?>
		</aside>


	</div> <?php // 
			?>


	<!-- ========== BÀI VIẾT MỚI NHẤT (NÂNG CẤP) ========== -->
	<div class="bai-viet-moi-duoi">

		<div class="bai-viet-moi-content-wrapper">
			<h3 class="sidebar-title">Bài viết mới nhất</h3>
			<ul class="recent-posts-list">
				<?php
				// ... (Toàn bộ code vòng lặp while của bạn y hệt như cũ) ...
				$args_moi_duoi = array(
					'posts_per_page' => 3,
					'ignore_sticky_posts' => 1
				);
				$query_moi_duoi = new WP_Query($args_moi_duoi);

				if ($query_moi_duoi->have_posts()) :
					while ($query_moi_duoi->have_posts()) : $query_moi_duoi->the_post();
				?>
						<li class="news-item">

							<div class="news-header">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<span class="news-date"><?php echo get_the_date('j F, Y'); ?></span>
							</div>

							<div class="news-excerpt">
								<?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
							</div>

						</li>
				<?php
					endwhile;
					wp_reset_postdata();
				else :
					echo '<li>Không có bài viết mới.</li>';
				endif;
				?>
			</ul>
		</div>
	</div>
	<!-- ========== HẾT PHẦN NÂNG CẤP ========== -->

<?php else : ?>

	<!-- Trang chủ -->
	<div class="trang-chu">
		<!-- Cột trái: Lưu trữ theo tháng -->
		<aside class="cot-trai bai-viet-moi-nhat">
			<h3 class="tieu-de-cot">Bài viết mới nhất</h3>
			<ul class="bai-viet-moi-nhat-list">
				<?php
				$args_moi = array(
					'posts_per_page' => 4,
					'ignore_sticky_posts' => 1
				);
				$query_moi = new WP_Query($args_moi);
				$i = 1;
				if ($query_moi->have_posts()) :
					while ($query_moi->have_posts()) : $query_moi->the_post();
				?>
						<li class="bai-viet-moi-nhat-item">
							<span class="bai-viet-moi-nhat-stt"><?php echo $i; ?></span>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
				<?php
						$i++;
					endwhile;
					wp_reset_postdata();
				else :
					echo '<li>Không có bài viết mới.</li>';
				endif;
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

	/* ---- CSS MỚI CHO BÀI VIẾT MỚI (GIỐNG ẢNH) ---- */

	/* 1. KHUNG BỌC NGOÀI */
	.bai-viet-moi-duoi {
		margin-top: 30px;
		padding-top: 20px;
		border-top: 2px solid #eee;
		display: grid;
		grid-template-columns: 1fr 2fr 1fr;
		/* Cột 1 (trống) | Cột 2 (giữa) | Cột 3 (trống) */
		gap: 20px;
		/* Khoảng cách giữa các cột (tùy chọn) */
		/* Gạch phân cách mỏng */
	}

	.bai-viet-moi-duoi .bai-viet-moi-content-wrapper {
		grid-column: 2 / 3;
		display: grid;
		grid-template-columns: 1fr 2fr;
		gap: 25px;
		align-items: baseline;
	}


	/* 2. TIÊU ĐỀ "Bài viết mới nhất" */
	.bai-viet-moi-duoi .sidebar-title {
		font-size: 1.4em;
		/* Chữ to hơn */
		font-weight: bold;
		color: #333;
		margin-top: 0;
		margin-bottom: 20px;
		width: 100%;
		/* Bỏ width: fit-content */
		border-bottom: none;
		/* Bỏ gạch chân */
		font-size: 1.4em;
		font-weight: bold;
	}

	/* 3. DANH SÁCH UL */
	.bai-viet-moi-duoi .recent-posts-list {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	/* 4. MỖI MỤC BÀI VIẾT (LI) */
	.bai-viet-moi-duoi .news-item {
		position: relative;
		padding-left: 25px;
		/* Khoảng trống cho vòng tròn */
		margin-bottom: 25px;
		/* Khoảng cách giữa các bài */
		border-bottom: none;
		/* Bỏ gạch chân cũ */
	}

	/* 5. VÒNG TRÒN MÀU XANH (::before) */
	.bai-viet-moi-duoi .news-item::before {
		content: '';
		position: absolute;
		left: 0;
		top: -3px;
		/* Căn vòng tròn với dòng title */

		width: 14px;
		height: 14px;
		background-color: #fff;
		border: 3px solid #3498db;
		/* Màu xanh da trời */
		border-radius: 50%;
		box-sizing: border-box;
		z-index: 1;
	}

	/* NỐI CÁC HÌNH TRÒN BẰNG ĐƯỜNG THẲNG ĐỨNG */
	.news-item::after {
		content: '';
		position: absolute;
		left: 6px;
		top: -15px;
		bottom: -22px;
		width: 2px;
		background-color: #ddd;
		z-index: 0;
	}

	/* 6. HEADER CỦA BÀI VIẾT (Chứa Title và Date) */
	.bai-viet-moi-duoi .news-header {
		overflow: hidden;
		/* Để xử lý float */
		margin-bottom: 5px;
		line-height: 1.3;
	}

	/* 7. TIÊU ĐỀ BÀI VIẾT (A) */
	.bai-viet-moi-duoi .news-header a {
		text-decoration: none;
		color: #0073aa;
		/* Màu xanh cho link */
		font-weight: bold;
		font-size: 1.1em;
		float: left;
		/* Đẩy title sang trái */
	}

	.bai-viet-moi-duoi .news-header a:hover {
		text-decoration: underline;
	}

	/* 8. NGÀY ĐĂNG (SPAN) */
	.bai-viet-moi-duoi .news-date {
		float: right;
		/* Đẩy ngày sang phải */
		color: #999;
		font-size: 0.9em;
		padding-top: 2px;
		/* Căn chỉnh với title */
	}

	/* 9. NỘI DUNG RÚT GỌN (EXCERPT) */
	.bai-viet-moi-duoi .news-excerpt {
		color: #555;
		font-size: 0.95em;
		line-height: 1.6;
		clear: both;
		/* Đảm bảo nó nằm dưới cả title và date */
	}

	/* ================================================== */
	/* --- GIAO DIỆN BÌNH LUẬN MỚI (THEO HÌNH 23f91f) --- */
	/* ================================================== */

	/* 1. Áp dụng cho cả 2 cột bên phải (Trang chủ & Tìm kiếm) */
	/* ================================================== */
	/* --- GIAO DIỆN BÌNH LUẬN (KIỂU BONG BÓNG CHAT) --- */
	/* ================================================== */

	/* 1. KHUNG CHÍNH */
	.recent-comments {
		font-family: "Segoe UI", Arial, sans-serif;
		--avatar-size: 48px;
		--reply-avatar-size: 36px;
		--gap: 12px;
		/* Khoảng cách avatar và nội dung */
		--content-width: calc(100% - var(--avatar-size) - var(--gap));
	}

	/* 2. TIÊU ĐỀ */
	.recent-comments .sidebar-title {
		font-size: 18px;
		font-weight: 600;
		margin-bottom: 12px;
		border-bottom: 2px solid #f2f2f2;
		padding-bottom: 8px;
	}

	/* 3. DANH SÁCH */
	.recent-comments .comment-list {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	/* 4. BÌNH LUẬN GỐC (CHA) */
	.recent-comments li.comment {
		display: flex;
		align-items: flex-start;
		gap: var(--gap);
		padding: 10px 0;
		/* Khoảng cách giữa các bình luận */
		width: 100%;
		box-sizing: border-box;
		position: relative;

		/* Đảm bảo nền trong suốt (không phải hộp xám) */
		background-color: transparent;
		border-top: none;
		border-radius: 0;
		margin: 0;
	}

	.recent-comments li.comment:first-child {
		padding-top: 0;
	}

	/* 5. AVATAR GỐC */
	.recent-comments .comment-avatar {
		flex: 0 0 var(--avatar-size);
		width: var(--avatar-size);
	}

	.recent-comments .comment-avatar img {
		width: var(--avatar-size);
		height: var(--avatar-size);
		object-fit: cover;
		border-radius: 4px;
		/* Bo góc 4px */
	}

	/* 6. BODY (BÊN PHẢI) */
	.recent-comments .comment-body {
		flex: 1;
		max-width: var(--content-width);
		box-sizing: border-box;
	}

	/* 7. HEADER (KHUNG XÁM CHỨA TÊN) */
	.recent-comments .comment-header {
		position: relative;
		background: #efefef;
		/* <-- NỀN XÁM */
		border: 1px solid #d0d0d0;
		/* <-- VIỀN XÁM */
		border-radius: 4px 4px 0 0;
		padding: 8px 12px;
		margin: 0;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 8px;
	}

	/* 8. MŨI NHỌN (TAM GIÁC) */
	.recent-comments .comment-header::before {
		display: block;
		/* Đảm bảo nó hiển thị */
		content: "";
		position: absolute;
		left: -9px;
		top: 10px;
		/* Căn lề 1 chút */
		width: 0;
		height: 0;
		border-top: 8px solid transparent;
		border-bottom: 8px solid transparent;
		border-right: 8px solid #d0d0d0;
		/* Màu viền */
	}

	.recent-comments .comment-header::after {
		display: block;
		/* Đảm bảo nó hiển thị */
		content: "";
		position: absolute;
		left: -8px;
		top: 11px;
		width: 0;
		height: 0;
		border-top: 7px solid transparent;
		border-bottom: 7px solid transparent;
		border-right: 7px solid #efefef;
		/* Màu nền xám */
	}

	/* 9. TÊN TÁC GIẢ */
	.recent-comments .comment-author {
		font-weight: 700;
		font-size: 14px;
		color: #222;
		display: block;
		flex: 1;
		min-width: 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	/* 10. NỘI DUNG (KHUNG TRẮNG) */
	.recent-comments .comment-content {
		background: #fff;
		/* <-- NỀN TRẮNG */
		border: 1px solid #dcdcdc;
		/* <-- VIỀN */
		border-radius: 0 0 4px 4px;
		padding: 10px 12px;
		color: #6f6f6f;
		font-size: 14px;
		line-height: 1.6;
		margin: 0;
		border-top: none;
	}

	.recent-comments .comment-content a {
		color: inherit;
		text-decoration: none;
	}

	.recent-comments .comment-content a:hover {
		text-decoration: underline;
	}

	/* ==================================== */
	/* --- PHẦN PHẢN HỒI (CON) --- */
	/* ==================================== */

	/* 11. DANH SÁCH PHẢN HỒI (CON) */
	.recent-comments .children {
		list-style: none;
		margin: 10px 0 0 0;
		/* Khoảng cách với bình luận cha */
		padding: 10px 0 0 0;
		border-top: 1px dashed #eee;
		/* Gạch đứt ngăn cách */
	}

	/* 12. MỖI PHẢN HỒI (CON) */
	.recent-comments .children li.comment {
		/* Ghi đè gap cho avatar nhỏ hơn */
		--gap: 10px;
		padding-bottom: 10px;
		padding-top: 0;
	}

	/* 13. AVATAR CON (NHỎ HƠN) */
	.recent-comments .children .comment-avatar {
		--avatar-size: 36px;
	}

	.recent-comments .children .comment-avatar img {
		width: 36px;
		height: 36px;
	}

	/* 14. BODY CON */
	.recent-comments .children .comment-body {
		max-width: calc(100% - var(--reply-avatar-size) - var(--gap));
	}

	/* 15. HEADER/MŨI NHỌN CHO CON */
	.recent-comments .children .comment-header {
		padding: 6px 8px;
		background: #f0f0f0;
		border: 1px solid #d6d6d6;
	}

	.recent-comments .children .comment-header::before {
		left: -8px;
		top: 7px;
		border-top: 7px solid transparent;
		border-bottom: 7px solid transparent;
		border-right: 7px solid #d6d6d6;
	}

	.recent-comments .children .comment-header::after {
		left: -7px;
		top: 8px;
		border-top: 6px solid transparent;
		border-bottom: 6px solid transparent;
		border-right: 6px solid #f0f0f0;
	}

	/* 16. TÊN/NỘI DUNG CON (NHỎ HƠN) */
	.recent-comments .children .comment-author {
		font-size: 14px;
		font-weight: 600;
	}

	.recent-comments .children .comment-content {
		font-size: 14px;
		color: #666;
	}

	/* ====== BÀI VIẾT MỚI NHẤT (KIỂU SỐ THỨ TỰ) ====== */
	/* ====== BÀI VIẾT MỚI NHẤT (KIỂU SỐ THỨ TỰ) ====== */
	.bai-viet-moi-nhat {
		background: #fff;
		border: 1px solid #ddd;
		padding: 15px;
		border-radius: 8px;
	}

	.bai-viet-moi-nhat .tieu-de-cot {
		font-size: 1.2em;
		font-weight: bold;
		color: #333;
		text-transform: uppercase;
		border-bottom: 3px solid #000;
		padding-bottom: 8px;
		margin-bottom: 15px;
	}

	.bai-viet-moi-nhat-list {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.bai-viet-moi-nhat-item {
		display: flex;
		align-items: flex-start;
		gap: 10px;
		padding: 10px 0;
		border-bottom: 1px solid #eee;
	}

	.bai-viet-moi-nhat-item:last-child {
		border-bottom: none;
	}

	.bai-viet-moi-nhat-stt {
		font-size: 28px;
		font-weight: bold;
		color: #000;
		line-height: 1;
		min-width: 30px;
		text-align: right;
		font-family: "Georgia", serif;
	}

	.bai-viet-moi-nhat-item a {
		flex: 1;
		color: #000;
		text-decoration: none;
		font-weight: 500;
		line-height: 1.4;
	}

	.bai-viet-moi-nhat-item a:hover {
		color: #0073aa;
		text-decoration: underline;
	}
</style>

<?php get_footer(); ?>