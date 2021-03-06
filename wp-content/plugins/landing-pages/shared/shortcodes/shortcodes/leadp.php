<?php
/**
*   Lead Paragraph Shortcode
*/

/* 	Shortcode generator config
 * 	----------------------------------------------------- */
	$shortcodes_config['leadp'] = array(
		'no_preview' => true,
		'options' => array(
			'align' => array(
				'name' => __('Alignment', 'inbound-pro' ),
				'desc' => __('Add the pharagraph alignment', 'inbound-pro' ),
				'type' => 'select',
				'options' => array(
					'left' => 'Align Left',
					'right' => 'Align Right',
					'center' => 'Align Center'
				),
				'std' => ''
			),
			'content' => array(
				'name' => __('Paragraph Text', 'inbound-pro' ),
				'desc' => __('Add the pharagraph text', 'inbound-pro' ),
				'type' => 'textarea',
				'std' => ''
			)
		),
		'shortcode' => '[leadp align="{{align}}"]{{content}}[/leadp]',
		'popup_title' => __('Insert Lead Paragraph Shortcode', 'inbound-pro' )
	);

/* 	Add shortcode
 * 	----------------------------------------------------- */
	add_shortcode('leadp', 'inbound_shortcode_leadp');
	if (!function_exists('inbound_shortcode_leadp')) {
		function inbound_shortcode_leadp( $atts, $content = null ) {
			extract(shortcode_atts(array(
				'align' => ''
			), $atts));

			return '<p class="lead" style="text-align:'.$align.'">' . do_shortcode($content) . '</p>';
		}
	}