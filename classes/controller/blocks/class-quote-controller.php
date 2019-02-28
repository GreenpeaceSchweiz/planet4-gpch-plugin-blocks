<?php

namespace P4CHBKS\Controllers\Blocks;

if ( ! class_exists( 'GPCH_quote_Controller' ) ) {
    /**
     * @noinspection AutoloadingIssuesInspection
     */

    /**
     * Class GPCH_quote_Controller
     *
     * @package P4CHBKS\Controllers\Blocks
     */
    class GPCH_quote_Controller extends Controller {
        /**
        * @const string BLOCK_NAME
        */
        const BLOCK_NAME = 'gpch_quote';

        /**
         * Shortcode UI setup for the noindexblock shortcode.
         * It is called when the Shortcake action hook `register_shortcode_ui` is called.
         */
        public function prepare_fields() {
            $fields = array(
                array(
                    'label' => __( 'Quote', 'planet4-gpch-blocks' ),
                    'attr'  => 'quote',
                    'type'  => 'textarea',
                    'value' => "This is where you put the quote.",
                ),
                array(
                    'label' => __( 'Quotee', 'planet4-gpch-blocks' ),
                    'attr'  => 'quotee',
                    'type'  => 'text',
                    'value' => "Name",
                ),
                array(
                    'label'       => __( 'Photo', 'planet4-blocks-backend' ),
                    'attr'        => 'image',
                    'type'        => 'attachment',
                    'libraryType' => [ 'image' ],
                    'addButton'   => __( 'Select Image', 'planet4-gpch-blocks' ),
                    'frameTitle'  => __( 'Select Image', 'planet4-gpch blocks' ),
                ),
            );

            // Define the Shortcode UI arguments.
            $shortcode_ui_args = array(
                'label'         => __( 'GPCH | Quote', 'planet4-gpch-blocks' ),
                'listItemImage' => '<img src="' . P4CHBKS_PLUGIN_DIR . '/admin/images/icon_noindex.png' . '" />',
                'attrs'         => $fields,
                'post_type'     => P4CHBKS_ALLOWED_PAGETYPE,
            );

            shortcode_ui_register_for_shortcode( 'shortcake_' . self::BLOCK_NAME, $shortcode_ui_args );

        }

        /**
         * Callback for the shortcake_noindex shortcode.
         * It renders the shortcode based on supplied attributes.
         *
         * @param array  $fields        Array of fields that are to be used in the template.
         * @param string $content       The content of the post.
         * @param string $shortcode_tag The shortcode tag (shortcake_blockname).
         *
         * @return string The complete html of the block
         */
        public function prepare_template( $fields, $content, $shortcode_tag ) : string {

            $fields = shortcode_atts(
                array(
                    'quote'  => '',
                    'quotee' => '',
                    'image'  => '',
                ),
                $fields,
                $shortcode_tag
            );

            // If an image is selected
            if ( isset( $fields['image'] ) && $image = wp_get_attachment_image_src( $fields['image'], 'full' ) ) {
                // load the image from the library
                $fields['image']        = $image[0];
                $fields['alt_text']     = get_post_meta( $fields['image'], '_wp_attachment_image_alt', true );
                $fields['image_srcset'] = wp_get_attachment_image_srcset( $fields['image'], 'full', wp_get_attachment_metadata( $fields['image'] ) );
                $fields['image_sizes']  = wp_calculate_image_sizes( 'full', null, null, $fields['image'] );
            }

            $data = [
                'fields' => $fields,
            ];

            wp_enqueue_style( 'gpch_quote_css', P4CHBKS_ASSETS_DIR . 'css/gpch-quote.css', [], '1.0.0' );

            // Shortcode callbacks must return content, hence, output buffering here.
            ob_start();
            $this->view->block( self::BLOCK_NAME, $data );

            return ob_get_clean();
        }

        /**
         * Get all the data that will be needed to render the block correctly.
         *
         * @param array  $fields This is the array of fields of the block.
         * @param string $content This is the post content.
         * @param string $shortcode_tag The shortcode tag of the block.
         *
         * @return array The data to be passed in the View.
         */
        public function prepare_data( $fields, $content, $shortcode_tag ) : array {
            return array();
        }


    }
}

