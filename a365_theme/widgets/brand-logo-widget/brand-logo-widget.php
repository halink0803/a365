<?php

/*
Widget Name: Brand Logo Widget
Description: An widget which displays brand logos in footer.
Author: Quoc
*/
class Brand_Logo_Widget extends SiteOrigin_Widget {
	function __construct() {

	    parent::__construct(
	        // The unique id for your widget.
	        'brand-logo-widget',

	        // The name of the widget for display purposes.
	         __('Brand Logo Widget', 'a365'),

	        // The $widget_options array, which is passed through to WP_Widget.
	        // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
	        array(
	            'description' => __('A brand logo widget.', 'a365'),
	            'panels_groups' => array('a365')
	        ),
	        //The $control_options array, which is passed through to WP_Widget
	        array(
	        ),

	        //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
	        array(
	        	'panel' => array(
			        'type' => 'repeater',
			        'label' => __( 'Logo List' , 'a365' ),
			        'item_name'  => __( 'Logo', 'a365' ),
			        'fields' => array(
			            'panel_logo' => array(
			                'type' => 'media',
			                'label' => __( '', 'a365' )
			            ),
			            'panel_link'=>array(
			            	'type' => 'text',
			            	'label'=>__('Panel Link','a365'),
			            )
			        ),
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

siteorigin_widget_register('brand-logo-widget', __FILE__, 'Brand_Logo_Widget');
