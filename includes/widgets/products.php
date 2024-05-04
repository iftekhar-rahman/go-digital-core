<?php
namespace Go_Digital_Addon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Products extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Products';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Products', 'go-digital-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic', 'go-digital' ];
	}

	// Load CSS
	// public function get_style_depends() {

	// 	wp_register_style( 'guide-posts', plugins_url( '../assets/css/guide-posts.css', __FILE__ ));

	// 	return [
	// 		'guide-posts',
	// 	];

	// }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	// public function get_keywords() {
	// 	return [ 'oembed', 'url', 'link' ];
	// }

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'go-digital-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// $this->add_control(
		// 	'hero_heading_1',
		// 	[
		// 		'label' => esc_html__( 'Hero Heading 1', 'go-digital-addon' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'default' => esc_html__( 'The Next go digital', 'go-digital-addon' ),
		// 		'placeholder' => esc_html__( 'Type your title here', 'go-digital-addon' ),
		// 		'label_block' => true,
		// 	]
		// );
		// $this->add_control(
		// 	'hero_heading_2',
		// 	[
		// 		'label' => esc_html__( 'Hero Heading 2', 'go-digital-addon' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'default' => esc_html__( 'Creative agency', 'go-digital-addon' ),
		// 		'placeholder' => esc_html__( 'Type your title here', 'go-digital-addon' ),
		// 		'label_block' => true,
		// 	]
		// );

		// $this->add_control(
		// 	'heading_icon',
		// 	[
		// 		'label' => esc_html__( 'Choose Image', 'go-digital-addon' ),
		// 		'type' => \Elementor\Controls_Manager::MEDIA,
		// 		'default' => [
		// 			'url' => \Elementor\Utils::get_placeholder_image_src(),
		// 		],
		// 	]
		// );

		$this->end_controls_section();


	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		// $content_limit = $settings['content_limit'];
		// $title_word_limit = $settings['title_word_limit'];
	?>

	<div class="products-area">
	<?php

		// The Query
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby' => 'date',
			'order'   =>  'DESC',
		);

		$the_query = new \WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				?>
				<div class="single-product-item">
					
					<div class="product-col product-bg col-left">
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
						?>
					</div>
					<div class="product-col col-right">
						<?php
							$post_tags = get_the_tags();
						?>
						<span class="prtag"><?php if ( $post_tags ) { echo $post_tags[0]->name; }  ?></span>
						<h2><?php the_title(); ?></h2>
						<p><?php the_excerpt(  ); ?></p>

						<?php
						$readmore = get_field( "read_more" );
						?>
						<a class="readmore" href="<?php the_permalink(); ?>"> <?php echo $readmore; ?> 
						<?php if( get_field('arrow') ): ?>
							<img src="<?php the_field('arrow'); ?>" />
						<?php endif; ?>
						</a>
					</div>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
	?>
	</div>
	
	<?php

	}

}