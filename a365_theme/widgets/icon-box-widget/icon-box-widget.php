<?php

/*
Widget Name: Icon Box Widget
Description: An widget which displays icon box in home page.
Author: Quoc
*/
class Icon_box_Widget extends SiteOrigin_Widget {
	function __construct() {

	    parent::__construct(
	        // The unique id for your widget.
	        'icon-box-widget',

	        // The name of the widget for display purposes.
	         __('Icon Box Widget', 'a365'),

	        // The $widget_options array, which is passed through to WP_Widget.
	        // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
	        array(
	            'description' => __('A icon box widget.', 'a365'),
	            'panels_groups' => array('a365')
	        ),
	        //The $control_options array, which is passed through to WP_Widget
	        array(
	        ),

	        //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
	        array(
	        	'title' => array(
	        		'type' => 'text',
	        		'label'=> __( 'Icon Box Title', 'a365' )
	        	),

	        	'feature_image' => array(
	                'type' => 'media',
	                'label' => __( 'Feature Image', 'a365' )
	            ),

	        	'panel' => array(
			        'type' => 'repeater',
			        'label' => __( 'List Text' , 'a365' ),
			        'item_name'  => __( 'Text', 'a365' ),
			        'fields' => array(
			            'panel_text' => array(
			                'type' => 'text',
			                'label' => __( '', 'a365' )
			            ),
			        )
			    ),
			    'button_link' => array(
	            	'type'          => 'section',
					'label'         => __( 'Button Link', 'a365' ),
					'hide'          => true,
					'fields' => array(
						'link'	  => array(
							"type"        => "text",
							"label"       => __( "Add Button Link", 'a365' ),
						),
						'text'     => array(
							"type"        => "text",
							"label"       => __( "Add Button text", 'a365' ),
						),
					)
	            )
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

siteorigin_widget_register('icon-box-widget', __FILE__, 'Icon_box_Widget');
