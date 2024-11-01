<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Field: Typography
 *
 */
if ( ! class_exists( 'Exopite_Simple_Options_Framework_Field_typography' ) ) {

	class Exopite_Simple_Options_Framework_Field_typography extends Exopite_Simple_Options_Framework_Fields {

		public function __construct( $field, $value = '', $unique = '', $config = array(), $multilang ) {
			parent::__construct( $field, $value, $unique, $config, $multilang );

		}

		public function output() {

			echo $this->element_before();

			$defaults_value = array(
				'size'         => '14',
				'height'       => '',
				'color'        => '',
			);

			$value         = wp_parse_args( $this->element_value(), $defaults_value );
			$google_json   = $this->get_google_fonts_json();

			//Container
			echo '<div class="exopite-sof-font-field exopite-sof-font-field-js" data-id="'.$this->field['id'].'">';

				$googlefonts = array();

				foreach ( $google_json->items as $key => $font ) {
					$googlefonts[$font->family] = $font->variants;
				}

				echo '<label class="exopite-sof-typography-family" >';
				echo '<select name="" class="exopite-sof-typo-family hidden" >';
				foreach ( $googlefonts as $google_key => $google_value ) {
					echo '<option data-variants=""></option>';
				}
				echo '</select>';
				echo '</label>';

				$self  = new Exopite_Simple_Options_Framework( array(
					'id' => $this->element_name(),
					'multilang' => $this->config['multilang'],
					'is_options_simple' => $this->config['is_options_simple'],
				), null );

				$self->include_field_class('number');
				$self->include_field_class('color');
				$self->enqueue_field_class( array( 'type' => 'color' ) );

				$field_size = array(
					'id'      => 'size',
                    'type'    => 'number',
                    'default' =>  ( isset( $this->field['default']['size'] ) ) ? $this->field['default']['size'] : '',
					// 'before'  => 'Size ',
					'pseudo'  => true,
					'class' => 'font-size-js',
					'prepend' => 'fa-font',
					'append' => 'px',
                );

				$field_height = array(
					'id'      => 'height',
                    'type'    => 'number',
                    'default' =>  ( isset( $this->field['default']['height'] ) ) ? $this->field['default']['height'] : '',
					// 'before'  => 'Height ',
					'prepend' => 'fa-arrows-v',
					'append' => 'px',
					'pseudo'  => true,
					'class' => 'line-height-js',
                );

				$field_color = array(
					'id'      => 'color',
                    'type'    => 'color',
                    'rgba'   => true,
                    'default' =>  ( isset( $this->field['default']['color'] ) ) ? $this->field['default']['color'] : '',
					// 'before'  => 'Color ',
					'pseudo'  => true,
					'class' => 'font-color-js',
                );

				echo '<div class="exopite-sof-typography-size-height">';
				echo $self->add_field( $field_size, $value['size'] );
				echo $self->add_field( $field_height, $value['height'] );
				echo '</div>';
				echo '<div class="exopite-sof-typography-color">';
				echo $self->add_field( $field_color, $value['color'] );
				echo '</div>';


			//end container
			echo '</div>';

			echo $this->element_after();

		}

		public static function enqueue( $args ) {

			/**
			 * https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.jquery.min.js
			 * https://www.sitepoint.com/jquery-select-box-components-chosen-vs-select2/
			 */
			$resources = array(
				array(
					'name'       => 'jquery-chosen',
					'fn'         => 'chosen.min.css',
					'type'       => 'style',
					'dependency' => array(),
					'version'    => '1.8.2',
					'attr'       => 'all',
				),
				array(
					'name'       => 'jquery-chosen',
					'fn'         => 'chosen.jquery.min.js',
					'type'       => 'script',
					'dependency' => array( 'jquery' ),
					'version'    => '1.8.2',
					'attr'       => true,
				),
				array(
					'name'       => 'exopite-sof-jquery-chosen-loader',
					'fn'         => 'loader-jquery-chosen.min.js',
					'type'       => 'script',
					'dependency' => array( 'jquery-chosen' ),
					'version'    => '20190407',
					'attr'       => true,
				),
			);

			parent::do_enqueue( $resources, $args );

		}

	}

}
