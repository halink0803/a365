<?php

/*
Widget Name: Banner Slider Widget
Description: An widget which displays banner slider in home page.
Author: Quoc
*/
class Banner_Slider_Widget extends SiteOrigin_Widget {
	function __construct() {

	    parent::__construct(
	        // The unique id for your widget.
	        'banner-slider-widget',

	        // The name of the widget for display purposes.
	         __('Banner Slider Widget', 'a365'),

	        // The $widget_options array, which is passed through to WP_Widget.
	        // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
	        array(
	            'description' => __('A banner slider widget.', 'a365'),
	            'panels_groups' => array('a365')
	        ),
	        //The $control_options array, which is passed through to WP_Widget
	        array(
	        ),

	        //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
	        array(
	        	'panel' => array(
			        'type' => 'repeater',
			        'label' => __( 'Panel List' , 'a365' ),
			        'item_name'  => __( 'Panel', 'a365' ),
			        'fields' => array(
			            'panel_background_image' => array(
			                'type' => 'media',
			                'label' => __( 'Banner Background Image', 'a365' )
			            ),
			            'panel_title' => array(
			                'type' => 'text',
			                'label' => __( 'Banner Title', 'a365' )
			            ),
			            'panel_content' => array(
			                'type' => 'textarea',
			                'label' => __( 'Banner Content', 'a365' )
			            ),
			            'content_size' => array(
			            	'type' => 'slider',
			            	'label'=> __('Content Size','a365'),
			            	'default' => 24,
					        'min' => 1,
					        'max' => 100,
					        'integer' => true,
			            	'description' => __('(px)','a365'),
			            ),
			            'panel_link' => array(
			            	'type'          => 'section',
							'label'         => __( 'Banner Button Link', 'a365' ),
							'hide'          => true,
							'fields' => array(
								'button_link'	  => array(
									"type"        => "text",
									"label"       => __( "Add Button Link", 'a365' ),
								),
								'button_text'     => array(
									"type"        => "text",
									"label"       => __( "Add Button text", 'a365' ),
								),
							)
			            )
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

siteorigin_widget_register('banner-slider-widget', __FILE__, 'Banner_Slider_Widget');

