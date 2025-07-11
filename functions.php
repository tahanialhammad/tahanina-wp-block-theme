<?php
if (! function_exists('tahanina_block_theme_support')) :
    function tahanina_block_theme_support()
    {
        // Enables support for block styles
        add_theme_support('wp_block-styles');
        // Loads editor styles (optional)
        add_editor_style('style.css');
    }
endif;
add_action('after_setup_theme', 'tahanina_block_theme_support', 9);




/**
 * Enqueue theme styles
 */

if (! function_exists('tahanina_enqueue_styles')) :
    function tahanina_enqueue_styles()
    {
        wp_enqueue_style('tahanina-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
        wp_enqueue_style('block-style', get_template_directory_uri() . '/assets/css/block.css', array(), wp_get_theme()->get('Version'));
    }
endif;
add_action('wp_enqueue_scripts', 'tahanina_enqueue_styles');




/* Add polylang swicher shortcode */
function polylang_langswitch_dropdown()
{
    $output = '';
    if (function_exists('pll_the_languages')) {
        $languages = pll_the_languages([
            'raw' => 1,
        ]);

        if ($languages) {
            $output .= '<select class="polylang-dropdown" onchange="if(this.value) window.location.href=this.value;">';

            foreach ($languages as $lang) {
                $selected = $lang['current_lang'] ? ' selected' : '';
                $flag     = $lang['flag']; // HTML <img>
                $name     = esc_html($lang['name']);
                $output  .= '<option value="' . esc_url($lang['url']) . '"' . $selected . '>';
                $output  .= wp_strip_all_tags($name); // Note: <img> not rendered in <option>
                $output  .= '</option>';
            }

            $output .= '</select>';
        }
    }
    return $output;
}
add_shortcode('polylang', 'polylang_langswitch_dropdown');
