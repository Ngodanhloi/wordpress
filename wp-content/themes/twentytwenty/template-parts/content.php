<article id="post-<?php the_ID(); ?>" <?php post_class('post-card d-flex'); ?>>

	<!-- Ngày tháng bên trái -->
	<div class="post-date text-primary fw-bold p-3 text-center">
		<span class="day h3 d-block mb-1"><?php echo get_the_date('d'); ?></span>
		<span class="month small text-uppercase d-block">Tháng <?php echo get_the_date('n'); ?></span>
		<span class="year small d-block"><?php echo get_the_date('Y'); ?></span>
	</div>

	<!-- Nội dung bên phải -->
	<div class="post-content p-3 d-flex flex-column">
		<!-- Tiêu đề -->
		<h2 class="post-title h4 mb-3">
			<a href="<?php the_permalink(); ?>" class="text-dark fw-bold">
				<?php the_title(); ?>
			</a>
		</h2>

		<!-- Nội dung -->
		<div class="post-excerpt flex-grow-1 medium">
			<?php
			if (is_single()) {
				the_content(); // Khi vào trang chi tiết thì hiển thị full
			} else {
				the_excerpt(); // Ở danh sách thì chỉ hiện ngắn
			}
			?>
		</div>


		<!-- Nút đọc thêm -->
		<div class="mt-auto">
			<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-md">Đọc tiếp</a>
		</div>
	</div>
</article>


<style>
	.post-card {
		width: 100%;
		/* Chiếm hết cột giữa */
		margin: 0 0 1.5rem 0;
		/* Chỉ margin-bottom */
		background: #fff;
		border-radius: 6px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		overflow: hidden;
		display: flex;
	}


	/* Ngày tháng bên trái */
	.post-date {
		flex: 0 0 20%;
		/* chiếm 20% chiều rộng */
		max-width: 20%;
		background: #f7f7f7;
		/* nền nhạt cho nổi bật */
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	/* Nội dung bên phải */
	.post-content {
		flex: 0 0 80%;
		max-width: 80%;
		display: flex;
		flex-direction: column;
	}

	/* Chữ to hơn */
	.post-date .day {
		font-size: 2rem;
		font-weight: bold;
	}

	.post-title {
		font-size: 1.5rem;
	}

	.post-excerpt {
		font-size: 1rem;
	}
</style>