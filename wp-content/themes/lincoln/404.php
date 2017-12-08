<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'lincolncolllective' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'The page you are looking for doesnt exist. You can search what you are looking for below.', 'lincoln' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</article>

		</div>
	</div>

<?php get_footer(); ?>