<?php if ( ! defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.
/**
 *
 * Field: Font
 *
 */
if ( ! class_exists( 'Exopite_Simple_Options_Framework_Field_font' ) ) {

    class Exopite_Simple_Options_Framework_Field_font extends Exopite_Simple_Options_Framework_Fields {

        /**
         *
         * Unique identifier for retrieving translated strings
         *
         * @var string
         */
        public $textdomain = TRIAGE_TRAK_TEXT_DOMAIN;

        public function __construct( $field, $value = '', $unique = '', $config = array(), $multilang ) {
            parent::__construct( $field, $value, $unique, $config, $multilang );
        }

        public function output() {

            echo $this->element_before();

            $defaults_value = array(
                'family'       => '',
                'variant'      => '400',

            );

            $default_variants = apply_filters( 'exopite_sof_websafe_fonts_variants', array(
                'regular',
                'italic',
                '700',
                '700italic',
                'inherit'
            ));

            $value         = wp_parse_args( $this->element_value(), $defaults_value );
            $family_value  = $value['family'];
            $variant_value = $value['variant'];
            $is_variant    = ( isset( $this->field['variant'] ) && $this->field['variant'] === false ) ? false : true;
            $is_chosen     = ( isset( $this->field['chosen'] ) && $this->field['chosen'] === false ) ? '' : 'chosen ';
            $google_json   = $this->get_google_fonts_json();
            $chosen_rtl    = ( is_rtl() && ! empty( $is_chosen ) ) ? 'chosen-rtl ' : '';

            //Container
            echo '<div class="exopite-sof-font-field exopite-sof-font-field-js" data-id="'.$this->field['id'].'">';

            if( is_object( $google_json ) ) {

                $googlefonts = array();

                foreach ( $google_json->items as $key => $font ) {
                    $googlefonts[$font->family] = $font->variants;
                }

                $is_google = ( array_key_exists( $family_value, $googlefonts ) ) ? true : false;

                echo '<label class="exopite-sof-typography-family">';
                echo '<select name="'. $this->element_name( '[family]' ) .'" class="'. $is_chosen . $chosen_rtl .'exopite-sof-typo-family" data-placeholder="'. __('Select a Font', $this->textdomain) .'" data-atts="family"'. $this->element_attributes() .'>';

                do_action( 'exopite_sof_typography_family', $family_value, $this );

                echo '<optgroup label="'. esc_attr__( 'Google Fonts', $this->textdomain ) .'">';
                foreach ( $googlefonts as $google_key => $google_value ) {
                    echo '<option value="'. $google_key .'" data-variants="'. implode( '|', $google_value ) .'" data-type="google"'. selected( $google_key, $family_value, true ) .'>'. $google_key .'</option>';
                }
                echo '</optgroup>';

                echo '</select>';
                echo '</label>';

                if( ! empty( $is_variant ) ) {

                    $variants = ( $is_google ) ? $googlefonts[$family_value] : $default_variants;

                    if ($value && !empty($value['font'])) {
                        $variants = ( $value['font'] === 'google' || $value['font'] === 'websafe' ) ? $variants : array( 'regular' );
                    }

                    echo '<label class="exopite-sof-typography-variant" id="tt_font_variant">';
                    echo '<select name="'. $this->element_name( '[variant]' ) .'" class="'. $is_chosen . $chosen_rtl .'exopite-sof-typo-variant"  data-atts="variant" data-placeholder="'. __('Select a Style', $this->textdomain) .'">';
                    foreach ( $variants as $variant ) {
                        echo '<option value="'. $variant .'"'. $this->checked( $variant_value, $variant, 'selected' ) .'>'. $variant .'</option>';
                    }
                    echo '</select>';
                    echo '</label>';

                }


            } else {

                echo esc_attr__( 'Error! Can not load json file.', $this->textdomain );

            }

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

