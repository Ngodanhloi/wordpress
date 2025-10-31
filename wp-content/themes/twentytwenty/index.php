<?php get_header(); ?>

<?php if (is_search()) : ?>

	<!-- Trang kết quả tìm kiếm -->
	<div class="kq-tim-kiem">
		<div class="kq-tim-kiem-header">
			<h2>Kết quả tìm kiếm cho: <span class="highlight">"<?php echo esc_html(get_search_query()); ?>"</span></h2>
		</div>

		<div class="ket-qua">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article class="bai-tim-kiem">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
					</article>
				<?php endwhile; ?>

				<div class="phan-trang">
					<?php the_posts_pagination(array(
						'mid_size'  => 2,
						'prev_text' => __('« Trước', 'textdomain'),
						'next_text' => __('Sau »', 'textdomain'),
					)); ?>
				</div>
			<?php else : ?>
				<div class="khong-tim-thay">
					<p>Không tìm thấy kết quả nào cho từ khóa này.</p>
					<p>Thử tìm lại với từ khóa khác:</p>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

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
			if ($binh_luan_moi) :
				foreach ($binh_luan_moi as $bl) :
					$link_binh_luan = get_comment_link($bl->comment_ID);
					echo '<div class="binh-luan-moi">';
					echo '<a href="' . esc_url($link_binh_luan) . '">' . esc_html(get_the_title($bl->comment_post_ID)) . '</a>';
					echo '<span class="tac-gia"> - ' . esc_html($bl->comment_author) . '</span>';
					echo '</div>';
				endforeach;
			else :
				echo '<p>Chưa có bình luận nào.</p>';
			endif;
			?>
		</aside>
	</div>

<?php endif; ?>

<style>
	/* ====== Trang tìm kiếm ====== */
	.kq-tim-kiem {
		max-width: 1000px;
		margin: 30px auto;
		background: #fff;
		padding: 20px 30px;
		border-radius: 10px;
		border: 1px solid #ddd;
	}

	.kq-tim-kiem-header {
		text-align: center;
		margin-bottom: 25px;
		padding-bottom: 10px;
		border-bottom: 2px solid #eee;
	}

	.kq-tim-kiem-header h2 {
		font-size: 24px;
		color: #333;
		font-weight: 600;
	}

	.highlight {
		color: #0073aa;
	}

	.bai-tim-kiem {
		padding: 15px 0;
		border-bottom: 1px solid #eee;
	}

	.bai-tim-kiem h3 {
		margin: 0 0 8px;
		font-size: 18px;
	}

	.bai-tim-kiem h3 a {
		color: #0073aa;
		text-decoration: none;
	}

	.bai-tim-kiem p {
		color: #555;
		font-size: 15px;
		margin: 0;
	}

	.khong-tim-thay {
		text-align: center;
		padding: 30px;
		background: #f9f9f9;
		border-radius: 8px;
	}

	.phan-trang {
		margin-top: 20px;
		text-align: center;
	}

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
</style>

<?php get_footer(); ?>