<?php

/**
 * Custom Search Form Template
 * Header-style, nút xanh lá, có khung trắng bao quanh, viền đen nhẹ
 */
?>

<div class="custom-search-container">
	<form role="search" method="get" class="custom-search-form" action="<?php echo esc_url(home_url('/')); ?>">
		<!-- Icon -->
		<div class="custom-search-icon-left">
			<svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<circle cx="11" cy="11" r="8"></circle>
				<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
			</svg>
		</div>

		<!-- Input -->
		<input type="search"
			class="custom-search-input"
			name="s"
			placeholder="Tìm kiếm bài viết hoặc chủ đề..."
			value="<?php echo (have_posts()) ? get_search_query() : ''; ?>" />
		<!-- Nếu không có kết quả, value = '' -->

		<!-- Nút submit -->
		<input type="submit" class="custom-submit-button" value="Tìm kiếm" />
	</form>
</div>

<style>
	/* Khung trắng bao quanh toàn bộ form */
	/* Khung trắng bao quanh toàn bộ form */
	.custom-search-container {
		max-width: 800px;
		margin: 30px auto;
		padding: 15px;
		background-color: #fff;
		border-radius: 6px;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
		border: 1px solid rgba(0, 0, 0, 0.15);
		/* viền đen nhẹ cho khung bao */
	}

	/* Form bên trong, vẫn có viền đen nhẹ */
	.custom-search-form {
		display: flex;
		align-items: center;
		gap: 8px;
		background-color: #fff;
		border-radius: 4px;
		padding: 5px 8px;
		border: 1px solid rgba(0, 0, 0, 0.15);
		/* viền đen nhẹ cho form */
		box-shadow: none;
	}


	/* Form bên trong, có viền đen nhẹ */
	.custom-search-form {
		display: flex;
		align-items: center;
		gap: 8px;
		background-color: #fff;
		border-radius: 4px;
		padding: 5px 8px;
		border: 1px solid rgba(0, 0, 0, 0.15);
		/* viền đen nhẹ */
		box-shadow: none;
	}

	.custom-search-icon-left svg {
		stroke: #444;
		width: 20px;
		height: 20px;
	}

	.custom-search-input {
		flex: 1;
		padding: 8px 10px !important;
		border: none !important;
		outline: none !important;
		font-size: 1em !important;
		color: #444 !important;
		background-color: #fff !important;
	}

	.custom-submit-button {
		padding: 8px 15px !important;
		background-color: #28a745 !important;
		/* màu nền xanh lá */
		color: #fff !important;
		/* chữ trắng */
		font-weight: 500 !important;
		cursor: pointer !important;
		border-radius: 4px !important;

		/* Thêm viền đen nhẹ */
		border: 1px solid rgba(0, 0, 0, 0.15) !important;

		transition: background-color 0.2s, border-color 0.2s !important;
	}

	.custom-submit-button:hover {
		background-color: #218838 !important;
		/* xanh lá đậm hơn khi hover */
		border-color: rgba(0, 0, 0, 0.25) !important;
		/* viền đậm hơn khi hover */
	}
</style>