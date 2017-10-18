<?php


class Testimonial_Widget extends SiteOrigin_Widget {
	function __construct() {

	    parent::__construct(
	        // The unique id for your widget.
	        'testimonial-widget',

	        // The name of the widget for display purposes.
	         __('Testimonial Widget', 'a365'),

	        // The $widget_options array, which is passed through to WP_Widget.
	        // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
	        array(
	            'description' => __('A Testimonial widget.', 'a365'),
	            'panels_groups' => array('a365')
	        ),
	        //The $control_options array, which is passed through to WP_Widget
	        array(
	        ),

	        //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
	        array(
	        	'panel' => array(
			        'type' => 'repeater',
			        'label' => __( 'Testimonial' , 'a365' ),
			        'item_name'  => __( 'panel', 'a365' ),
			        'fields' => array(
			        	'panel_parent' => array(
			        		'type' => 'text',
			        		'label' => __( 'Parent' , 'a365' ),
			        	),
			            'panel_feedback' => array(
			                'type' => 'text',
			                'label' => __( 'Feedback', 'a365' )
			            ),
			        )
			    ),
			    
	        ),

	        //The $base_folder path string.
	       plugin_dir_path(__FILE__)
	    );
	}

    function get_template_name($instance) {
        return 'base';
    }

    function get_style_name($instance) {
        return false;
    }
}

siteorigin_widget_register('testimonial-widget', __FILE__, 'Testimonial_Widget');
