<?php
/**
 * News Layout Three
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'news_layout_widget_three_register' ) ) :
	function news_layout_widget_three_register() {
		/**
		 * Register Widget
		 */
		register_widget( 'news_layout_widget_three' );
	}
endif;
add_action( 'widgets_init', 'news_layout_widget_three_register' );

if ( ! class_exists( 'news_layout_widget_three' ) ) :
	/**
	* News Layout Class Two
	*/
	class news_layout_widget_three extends WP_Widget
	{
		
		function __construct()
		{
			$opts = array(
				'classname' => 'entertainent_news',
				'description'	=> esc_html__( 'Displays posts. Place it in "Front Page Widget Area Top" widget area.', 'newspaper-magazine' )
			);

			parent::__construct( 'news-layout-widget-three', esc_html__( 'News Widget Three', 'newspaper-magazine' ), $opts );
		}

		function widget( $args, $instance ){
			$icon = ! empty( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : '';
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 4 );

			echo $args[ 'before_widget' ];
				echo $args[ 'before_title' ]; 
				?>
					<a href=""><i class="fa <?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i> <span><?php echo esc_html( $title ); ?></span></a>
				<?php
				echo $args[ 'after_title' ];
				$arguments = array(
					'cat'	=> absint( $cat ),
					'posts_per_page' => absint( $post_no ),
				); 
				$query = new WP_Query( $arguments );
				?>
				<div class="row">
                    <div class="ent_news clearfix">
                        <div id="owl-demo2" class="owl-carousel owl-theme">  
                        	<?php
                        		if( $query->have_posts() ) :
                        			while( $query->have_posts() ) :
                        				$query->the_post();  
                        				?>
			                            <!-- Start single slidingnews -->
			                            <div class="item">
			                                <article>
			                                    <?php
			                                        if( has_post_thumbnail() ) : 
			                                    ?>
			                                    	<div class="view block_first_article_img hm-zoom">
			                                            <a href="<?php the_permalink(); ?>">
			                                                <?php the_post_thumbnail('newspaper-magazine-thumbnail-4', array( 'class' => 'img-responsive full-img' )); ?>
			                                            </a>
			                                        </div>
			                                    <?php
			                                       	endif;
			                                    ?>
			                                    <div class="block_article_content">
			                         	            <h4 class="side_news_heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			                            	        <div class="author_time news_author">
			                                	        <span class="author_img"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" alt=""><?php echo esc_html( get_the_author() ); ?></a></span>
			                                            <span class="publish_date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
			                                      	</div>
			                                    </div>
			                                </article>
			                            </div>
			                            <!-- End single slidingnews -->
			                            <?php
			                        endwhile;
			                    endif;
			                ?>
                        </div>
                    </div>
                </div>
				<?php 
			echo $args[ 'after_widget' ]; 
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'icon' ] = sanitize_text_field( $new_instance[ 'icon' ] );
			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );

			return $instance;
		}

		function form( $instance ) {

			$icon = ! empty( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : '';
			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : absint( 0 );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : absint( 4 );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><strong><?php echo esc_html( 'Icon: ' )?></strong></label>
				<p><i><?php echo esc_html__('Use FontAwesome Icon. Example: fa-cog', 'newspaper-magazine');?></i></p>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" value="<?php echo esc_attr( $icon ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html( 'Title: ' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html( 'Select Category: ', 'newspaper-magazine' ); ?></strong></label>
				<?php
					$cat_args = array(
						'orderby'	=> 'name',
						'hide_empty'	=> 0,
						'id'	=> $this->get_field_id( 'cat' ),
						'name'	=> $this->get_field_name( 'cat' ),
						'class'	=> 'widefat',
						'taxonomy'	=> 'category',
						'selected'	=> absint( $cat ),
						'show_option_all'	=> esc_html__( 'All Categories', 'newspaper-magazine' )
					);
					wp_dropdown_categories( $cat_args );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html( 'Post No: ', 'newspaper-magazine' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php			
		}
	}
endif;
?>