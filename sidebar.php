<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ChromeNews
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}

$global_layout = chromenews_get_option('global_content_alignment');
$page_layout = $global_layout;
// Check if single.

$frontpage_layout = chromenews_get_option('frontpage_content_alignment');
if (is_front_page() && is_home()) {    
    if (!empty($frontpage_layout)) {
        $page_layout = $frontpage_layout;
    } else {
        $page_layout = $global_layout;
    }
}elseif (is_front_page()) {
    $page_layout = $frontpage_layout;
}else{
   if (is_singular()) {
        $post_options = get_post_meta($post->ID, 'chromenews-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_layout;
        }
        
    }else{

        if ( class_exists( 'WooCommerce' ) && is_shop()) {
                $shop_page_id = get_option( 'woocommerce_shop_page_id' ); 
                $post_options = get_post_meta($shop_page_id, 'chromenews-meta-content-alignment', true);
                if (!empty($post_options)) {
                    $page_layout = $post_options;
                } else {
                    $page_layout = $global_layout;
                }
                
        }else{
            $page_layout = $global_layout;
            
        }
        
        
    }
}



if ($page_layout == 'full-width-content') {
    return;
}

?>

<?php
$sticky_sidebar_class = '';
$sticky_sidebar = chromenews_get_option('frontpage_sticky_sidebar');
if ($sticky_sidebar) {
    $sticky_sidebar_class = chromenews_get_option('frontpage_sticky_sidebar_position');
}
?>


<div id="secondary" class="sidebar-area <?php echo esc_attr($sticky_sidebar_class); ?>">
        <aside class="widget-area color-pad">
            <?php dynamic_sidebar('sidebar-1'); ?>

        </aside>
</div>