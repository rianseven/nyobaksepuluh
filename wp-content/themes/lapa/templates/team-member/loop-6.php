<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;
$thumbnail_size = (isset($lapa_loop['image_size']) && !empty($lapa_loop['image_size']) ? $lapa_loop['image_size'] : 'thumbnail');
$title_tag      = (isset($lapa_loop['title_tag']) && !empty($lapa_loop['title_tag']) ? $lapa_loop['title_tag'] : 'h3');
$role           = Lapa()->settings()->get_post_meta(get_the_ID(), 'role');
$post_class     = array('loop-item','grid-item','la-member');
?>
<article <?php post_class($post_class)?>>
    <div class="la-member__inner item-inner">
        <div class="la-member__image">
            <a href="javascript:;"><?php
                Lapa()->images()->the_post_thumbnail(get_the_ID(), $thumbnail_size);
            ?><div class="item--overlay"></div></a>
        </div>
        <div class="la-member__info">
            <div class="la-member__info-title-role">
                <?php
                printf(
                    '<%1$s class="%4$s"><a href="%2$s">%3$s</a></%1$s>',
                    esc_attr($title_tag),
                    'javascript:;',
                    get_the_title(),
                    'la-member__info-title'
                );
                if(!empty($role)){
                    printf(
                        '<p class="la-member__info-role">%s</p>',
                        esc_html($role)
                    );
                }
                ?>
            </div>
            <div class="entry-excerpt"><?php
                add_filter('excerpt_length', function(){ return 20; }, 1010);
                the_excerpt();
                remove_all_filters('excerpt_length', 1010);
                ?></div>
        </div>
    </div>
</article>