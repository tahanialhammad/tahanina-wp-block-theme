<?php
/**
 * Title: Grid query posts
 * Slug: tahanina/grid-query-loop-posts
 * Categories: query
 * Block Types: core/query
 * Viewport width: 1400
 * Description: A list of posts, 3 columns, with featured images.
 */

?>


<!-- wp:query {"queryId":0,"query":{"perPage":10,"postType":"post","order":"desc","orderBy":"date"},"layout":{"type":"constrained"}} -->
<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group -->
<div class="wp-block-group">
    <!-- wp:post-title {"isLink":true} /-->
    <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->
    <!-- wp:post-excerpt /-->
    <!-- wp:post-terms {"term":"post_tag"} /-->
    <!-- wp:post-terms {"term":"category"} /-->
    <!-- wp:read-more /-->
</div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination -->
<!-- wp:query-pagination-previous /-->
<!-- wp:query-pagination-numbers /-->
<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->
<!-- /wp:query -->
