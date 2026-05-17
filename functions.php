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
        wp_enqueue_style('utilities-style', get_template_directory_uri() . '/assets/css/utilities.css', array(), wp_get_theme()->get('Version'));

    }
endif;
add_action('wp_enqueue_scripts', 'tahanina_enqueue_styles');


// Register custom block styles.
if (! function_exists('tahanina_block_styles')) :
    /**
     * Registers custom block styles.
     *
     * @since Tahanina 1.0
     *
     * @return void
     */
    function tahanina_block_styles()
    {
        // // Primary Button style
        // register_block_style(
        //     'core/button',
        //     [
        //         'name'  => 'primary-button',
        //         'label' => __('Primary Button', 'tahanina'),
        //         'inline_style' => '
        //             .wp-block-button.is-style-primary-button > .wp-block-button__link {
        //                 background-color: var(--wp--preset--color--primary) !important;
        //                 color: var(--wp--preset--color--background) !important;
        //                 transition: all 0.2s !important;
        //             }
        //             .wp-block-button.is-style-primary-button > .wp-block-button__link:hover {
        //                 background-color: transparent !important;
        //                 color: var(--wp--preset--color--primary) !important;
        //             }
        //         ',
        //     ],
        // );

        // Checkmark list style
        register_block_style(
            'core/list',
            [
                'name'  => 'checkmark-list',
                'label' => __('Checkmark', 'tahanina'),
                'inline_style' => '
                    ul.is-style-checkmark-list {
                        list-style-type: "✓";
                        padding-left: 1em;
                    }
                    ul.is-style-checkmark-list li {
                        padding-inline-start: 0.5ch;
                    }
                ',
            ]
        );

        // Category list style
        register_block_style(
            'core/categories',
            [
                'name'  => 'no-bullets',
                'label' => __('No Bullets', 'tahanina'),
                'inline_style' => '
                    ul.is-style-no-bullets {
                        list-style: none;
                    }

                    ul.is-style-no-bullets li a{
                       text-decoration: none;
                    }

                      ul.is-style-no-bullets li a:hover{
                      opacity: 0.8;
                    }
                ',
            ]
        );

        register_block_style(
            'core/categories',
            [
                'name'  => 'flex-categories',
                'label' => __('Flex Layout', 'tahanina'),
                'inline_style' => '
                ul.is-style-flex-categories {
                        display: flex;
                        gap: 1em;
                        flex-wrap: wrap;
                        list-style: none;
                    }

                   ul.is-style-flex-categories li a{
                       text-decoration: none;
                    }

                     ul.is-style-flex-categories li a:hover{
                      opacity: 0.8;
                    }
                ',
            ]
        );

    }
endif;

add_action('init', 'tahanina_block_styles');




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

add_filter('render_block', function ($block_content, $block) {
    // هل الكتلة عبارة عن رأس القالب؟
    if (isset($block['blockName']) && $block['blockName'] === 'core/template-part') {

        //  is current lang is Ar
        if (function_exists('pll_current_language') && pll_current_language() === 'ar') {

            // swtch header & footer
            if (isset($block['attrs']['slug']) && $block['attrs']['slug'] === 'header') {
                return do_blocks('<!-- wp:template-part {"slug":"header-ar"} /-->');
            }
            if (isset($block['attrs']['slug']) && $block['attrs']['slug'] === 'footer') {
                return do_blocks('<!-- wp:template-part {"slug":"footer-ar"} /-->');
            }
        }
    }

    return $block_content;
}, 10, 2);




//allow svg image
function theme_allow_svg_uploads($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'theme_allow_svg_uploads');






// AOS animation 
// function enqueue_aos_animation_assets() {
//     // 1. ربط ملفات المكتبة
//     wp_enqueue_style( 'aos-css', 'https://unpkg.com/aos@next/dist/aos.css', array(), '2.3.4' );
//     wp_enqueue_script( 'aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), '2.3.4', true );

//     // 2. كود ذكي يحول كلاسات الووردبريس إلى خصائص تفهمها AOS ثم يشغل المكتبة
//     $custom_aos_script = "
//         document.addEventListener('DOMContentLoaded', function() {
//             // ابحث عن أي عنصر يحتوي على كلاس يبدأ بـ aos-
//             var animatedElements = document.querySelectorAll('[class*=\"aos-\"]');
            
//             animatedElements.forEach(function(element) {
//                 // استخرج اسم الحركة من الكلاس (مثلاً: aos-fade-up تصبح fade-up)
//                 element.classList.forEach(function(className) {
//                     if (className.startsWith('aos-')) {
//                         var animationName = className.replace('aos-', '');
//                         element.setAttribute('data-aos', animationName);
//                     }
//                 });
//             });

//             // تشغيل المكتبة بعد تحويل الكلاسات
//             AOS.init({
//                 offset: 120,
//                 duration: 800,
//                 easing: 'ease-in-out',
//                 once: true
//             });
//         });
//     ";

//     wp_add_inline_script( 'aos-js', $custom_aos_script );
// }
// add_action( 'wp_enqueue_scripts', 'enqueue_aos_animation_assets' );

// //for delay
// function enqueue_aos_animation_assets() {
//     // 1. ربط ملفات المكتبة (CSS و JS)
//     wp_enqueue_style( 'aos-css', 'https://unpkg.com/aos@next/dist/aos.css', array(), '2.3.4' );
//     wp_enqueue_script( 'aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), '2.3.4', true );

//     // 2. الكود المطور لتحويل كلاسات الحركة وكلاسات التأخير (Delay)
//     $custom_aos_script = "
//         document.addEventListener('DOMContentLoaded', function() {
//             // البحث عن العناصر التي تحتوي على كلاسات AOS
//             var animatedElements = document.querySelectorAll('[class*=\"aos-\"]');
            
//             animatedElements.forEach(function(element) {
//                 element.classList.forEach(function(className) {
                    
//                     // تحويل كلاس الحركة (مثال: aos-fade-up -> data-aos='fade-up')
//                     if (className.startsWith('aos-') && !className.startsWith('aos-delay-')) {
//                         var animationName = className.replace('aos-', '');
//                         element.setAttribute('data-aos', animationName);
//                     }
                    
//                     // تحويل كلاس التأخير (مثال: aos-delay-200 -> data-aos-delay='200')
//                     if (className.startsWith('aos-delay-')) {
//                         var delayValue = className.replace('aos-delay-', '');
//                         element.setAttribute('data-aos-delay', delayValue);
//                     }
//                 });
//             });

//             // تشغيل المكتبة بالإعدادات الافتراضية
//             AOS.init({
//                 offset: 120,
//                 duration: 800,
//                 easing: 'ease-in-out',
//                 once: true
//             });
//         });
//     ";

//     wp_add_inline_script( 'aos-js', $custom_aos_script );
// }
// add_action( 'wp_enqueue_scripts', 'enqueue_aos_animation_assets' );

//defin it in custom.js
function enqueue_aos_animation_assets() {
    // 1. ربط ملف الـ CSS والـ JS الخاص بالمكتبة الأصلية من الـ CDN
    wp_enqueue_style( 'aos-css', 'https://unpkg.com/aos@next/dist/aos.css', array(), '2.3.4' );
    wp_enqueue_script( 'aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), '2.3.4', true );

    // 2. ربط ملفكِ المخصص الجديد الذي أنشأتِه لترجمة الكلاسات وتفعيل الحركة
    // مع إخبار ووردبريس ألا يشغل هذا الملف إلا بعد تحميل مكتبة aos-js أولاً لضمان عدم حدوث أخطاء
    wp_enqueue_script( 
        'aos-custom-init', 
        get_template_directory_uri() . '/assets/js/aos-custom.js', 
        array('aos-js'), // يعتمد على الملف الأصلي
        '1.0.0', 
        true // تحميل في أسفل الصفحة لزيادة السرعة
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_aos_animation_assets' );









// Calendly

function calendly_popup_button(){

ob_start();
?>

<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" async></script>

<button id="calendly-book-btn" style="
background:#0069ff;
color:#fff;
padding:12px 24px;
border:none;
border-radius:6px;
cursor:pointer;
font-size:16px;">
Book a meeting
</button>

<script>
document.addEventListener("DOMContentLoaded", function(){

var btn = document.getElementById("calendly-book-btn");

if(btn){
btn.addEventListener("click", function(e){
e.preventDefault();

Calendly.initPopupWidget({
url: "https://calendly.com/tahaninawebdeveloper/website-consultatie"
});

});
}

});
</script>

<?php

return ob_get_clean();

}

add_shortcode('calendly_popup','calendly_popup_button');