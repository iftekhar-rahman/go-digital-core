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
class Services extends \Elementor\Widget_Base {

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
		return 'Services';
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
		return esc_html__( 'Services', 'go-digital-addon' );
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
	?>

	<div class="services-area">
	<?php

	// The Query
	$args = array(
		'post_type' => 'service',
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
			<div class="single-service-item">
				<a class="featured-image" href="<?php the_permalink(); ?>">
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						}
					?>
				</a>
				<?php
				$service_number = get_field( "service_number" );
				?>
				<span class="number"><?php echo $service_number; ?></span>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="tags-wrap">
					<?php
						$posttags = get_the_tags();
							if ($posttags) {
							foreach($posttags as $tag) {
								echo '<span>'. $tag->name . '</span>'; 
							}
						}
					?>
				</div>
				<?php
					$readmore = get_field( "read_more" );
				?>
				<a class="readmore" href="<?php the_permalink(); ?>"> <?php echo $readmore; ?> 
				<?php if( get_field('arrow') ): ?>
					<img src="<?php the_field('arrow'); ?>" />
				<?php endif; ?>
				</a>
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