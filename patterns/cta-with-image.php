<?php
/**
 * Title: CTA with image
 * Slug: tahaninablocktheme/cta-with-image
 * Categories: banner
 * Description: A CTA with two columns, including a heading, short paragraph, button, and image.
 */
?>

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns {"align":"wide","style":{"border":{"radius":"15px"}},"backgroundColor":"primary"} -->
<div class="wp-block-columns alignwide has-primary-background-color has-background" style="border-radius:15px"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background"} -->
<h1 class="wp-block-heading has-background-color has-text-color has-link-color">About us</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background"} -->
<p class="has-background-color has-text-color has-link-color">information about our services </p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">More info </a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"15px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img  alt="" class="wp-image-276" style="border-radius:15px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->