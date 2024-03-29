<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newspaper_Magazine
 */

	get_header(); 
?>

<!-- inner page start -->
<section class="innerpage">
	<div class="container">
		<div class="row">
			<!-- Start inner page title -->
			<div class="col-md-12">
				<div class="innerpagetitle">
					<!-- Start BreadCrumb Section -->
					<div class="innerpagetitle">
					<?php
						/**
						* Hook - newspaper_magazine_breadcrumb.
						*
						* @hooked newspaper_magazine_breadcrumb _action- 10
						*/
						do_action( 'newspaper_magazine_breadcrumb' );		
					?>	
					</div>
					<!-- End BreadCrumb Section -->
					<h4 class="news_title">
                        <a href="">
                           	<i class="fa fa-list" aria-hidden="true"></i> 
                           	<span><?php echo esc_html( 'Blog', 'newspaper-magazine' ); ?></span>
                        </a>
                    </h4>
				</div>
			</div>
			<!-- End inner page title -->
					
			<!-- Start inner page News Section -->
			<div class="col-md-12">
				<div class="row innerpagenews">
					<?php
			            $sidebar = get_theme_mod( 'theme_sidebar_position', 'right' );
			            $class = 'col-md-12';
			            if ( $sidebar != 'none' && is_active_sidebar( 'sidebar-7' ) ) {
			                $class = 'col-md-8';
			            }
		            ?>
		            <!-- Left Sidebar -->
		            <?php 
		                if ($sidebar == 'left' && is_active_sidebar( 'sidebar-7' ) ) { 
		                    get_sidebar('right'); 
		                } 
		            ?>
					<!-- Start inner page News left Section -->
					<div class="<?php echo $class; ?>">
						<div class="innerpage_left">
							<div class="row single_cat_news single_cat_news_box">
								<?php
									if ( have_posts() ) :
										/* Start the Loop */
										while ( have_posts() ) : the_post();
											/*
											 * Include the Post-Format-specific template for the content.
											 * If you want to override this in a child theme, then include a file
											 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
											 */
											get_template_part( 'template-parts/content', 'archive' );
									
										endwhile;
									
										get_template_part( 'template-parts/content', 'pagination' );
									
									else :
									
										get_template_part( 'template-parts/content', 'none' );
									
									endif; 
								?>									
							</div>
						</div>
					</div>
					<!-- Start inner page News left Section -->

					<!-- Right Sidebar -->
				    <?php 
				        if ($sidebar == 'right' && is_active_sidebar( 'sidebar-7' ) ){ 
				            get_sidebar('right'); 
				        } 
				    ?>
					<!-- End inner page News right Section -->
				</div>
			</div>
			<!-- End inner page News Section -->
		</div>
	</div>
</section>

<?php
	get_footer();
?>