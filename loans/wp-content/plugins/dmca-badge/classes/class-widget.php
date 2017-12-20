<?php

class DMCA_Badge_Widget extends WP_Widget {

	function DMCA_Badge_Widget(){
		$this->WP_Widget(
			false,
			__( 'DMCA Website Protection Badge', 'dmca-badge' ),
			array(
				'classname' => 'dmca_widget_badge',
				'description' => __( 'Display your chosen DMCA Website Protection Badge in any widget area of your site.', 'dmca-badge' ),
			)
		);
	}

	function widget( $args, $instance ){
		echo $args['before_widget'];
		echo DMCA_Badge_Plugin::this()->get_badge_html();
		echo $args['after_widget'];
	}

}
