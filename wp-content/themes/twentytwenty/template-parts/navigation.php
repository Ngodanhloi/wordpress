<?php

/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$next_post = get_next_post();
$prev_post = get_previous_post();

if ($next_post || $prev_post) {

	$pagination_classes = '';

	if (! $next_post) {
		$pagination_classes = ' only-one only-prev';
	} elseif (! $prev_post) {
		$pagination_classes = ' only-one only-next';
	}

?>

	<nav class="pagination-single section-inner<?php echo esc_attr($pagination_classes); ?>" aria-label="<?php esc_attr_e('Post', 'twentytwenty'); ?>">

		<hr class="styled-separator is-style-wide" aria-hidden="true" />

		<div class="pagination-single-inner">

			<?php
			if ($prev_post) {
			?>

				<a class="previous-post" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">

					<span class="post-date" aria-hidden="true">
						<span class="day-month">
							<span class="day"><?php echo get_the_date('d', $prev_post->ID); ?></span>
							<span class="month"><?php echo get_the_date('m', $prev_post->ID); ?></span>
						</span>
						<span class="year"><?php echo get_the_date('y', $prev_post->ID); ?></span>
					</span>
					<span class="title"><span class="title-inner"><?php echo wp_kses_post(get_the_title($prev_post->ID)); ?></span></span>
				</a>

			<?php
			}

			if ($next_post) {
			?>

				<a class="next-post" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">

					<span class="post-date" aria-hidden="true">
						<span class="day-month">
							<span class="day"><?php echo get_the_date('d', $next_post->ID); ?></span>
							<span class="month"><?php echo get_the_date('m', $next_post->ID); ?></span>
						</span>
						<span class="year"><?php echo get_the_date('y', $next_post->ID); ?></span>
					</span>
					<span class="title"><span class="title-inner"><?php echo wp_kses_post(get_the_title($next_post->ID)); ?></span></span>
				</a>
			<?php
			}
			?>

		</div>
		<hr class="styled-separator is-style-wide" aria-hidden="true" />

	</nav>
	<style>
		/* ---- CSS cho phần điều hướng bài viết (Sửa lỗi căn lề) ---- */

		.pagination-single .pagination-single-inner {
			display: flex;
			flex-direction: column;
			align-items: flex-start;
			gap: 20px;
		}

		.pagination-single .previous-post {
			display: flex;
			align-items: flex-start;
			gap: 15px;
			text-decoration: none;
		}

		/* SỬA LỖI: Ghi đè CSS của theme */
		nav.pagination-single a.next-post {
			display: flex;
			align-items: flex-start !important;
			gap: 15px;
			text-decoration: none;
			flex-direction: row;
			margin-left: 0 !important;
			/* <-- THÊM DÒNG NÀY VÀO */
		}

		.pagination-single .post-date {
			display: flex;
			flex-direction: row;
			align-items: center;
			gap: 8px;
			font-weight: bold;
			line-height: 1.3;
			color: #333;
			flex-shrink: 0;
		}

		.pagination-single .post-date .day-month {
			display: flex;
			flex-direction: column;
			text-align: center;
			width: 45px;
		}

		.pagination-single .post-date .day {
			display: inline-block;
			font-size: 28px;
			line-height: 1;
			border-bottom: 1px solid #222;
			padding-bottom: 2px;
			margin-bottom: 2px;
		}

		.pagination-single .post-date .month {
			display: block;
			padding-top: 4px;
			font-size: 1.1rem;
		}

		.pagination-single .year {
			color: #000;
			font-size: 20px;
			font-weight: bold;
			line-height: 1;
		}

		.pagination-single .previous-post .title {
			text-align: left;
			color: #000;
		}

		nav.pagination-single a.next-post .title {
			text-align: left;
			color: #000;
		}

		.pagination-single .arrow {
			display: none;
		}

		/* SỬA LỖI: Ghi đè CSS của theme */
		
	</style>
<?php
}
