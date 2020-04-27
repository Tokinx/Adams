<?php
if (function_exists('register_nav_menus')) {
    register_nav_menus(array(
        'header_nav' => __('站点导航'),
        'footer_nav' => __('底部导航'),
        'social_nav' => __('社交链接')
    ));
}

class description_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $description = !empty($item->description) ? '<img src="' . esc_attr($item->description) . '">' : '';

        if ($depth != 0) $description = "";

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $description . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * 主题设置选项
 *
 * 转移自 `functions.php`。
 */
function theme_customize_register($wp_customize)
{
    $wp_customize->add_section('biji_setting', array(
        'title' => '主题设置',
        'priority' => 101
    ));
    $wp_customize->add_setting('biji_setting_enc', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_pjax', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_viewimage', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_prettify', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_lately', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_auto_mode', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_thumb', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_placard', array(
        'default' => '简单传递美好',
    ));
    $wp_customize->add_setting('biji_setting_cdn', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_avatar', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_exclude', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_postAd', array(
        'default' => '',
    ));
    $wp_customize->add_setting('biji_setting_footInfo', array(
        'default' => '',
    ));

    $wp_customize->add_control('biji_setting_enc', array(
        'label' => '允许纯英文评论',
        'section' => 'biji_setting',
        'type' => 'checkbox'
    ));
    $wp_customize->add_control('biji_setting_pjax', array(
        'label' => '关闭PJAX',
        'section' => 'biji_setting',
        'type' => 'checkbox'
    ));
    $wp_customize->add_control('biji_setting_viewimage', array(
        'label' => '关闭默认灯箱',
        'section' => 'biji_setting',
        'type' => 'checkbox'
    ));
    $wp_customize->add_control('biji_setting_prettify', array(
        'label' => '关闭默认代码高亮',
        'section' => 'biji_setting',
        'type' => 'checkbox'
    ));
    $wp_customize->add_control('biji_setting_lately', array(
        'label' => '关闭Timeago',
        'section' => 'biji_setting',
        'type' => 'checkbox'
    ));
    $wp_customize->add_control('biji_setting_auto_mode', array(
        'label' => '自动夜间模式',
        'section' => 'biji_setting',
        'type' => 'checkbox'
    ));
    $wp_customize->add_control('biji_setting_thumb', array(
        'label' => '开启文章缩略图',
        'section' => 'biji_setting',
        'type' => 'checkbox'
    ));
    $wp_customize->add_control('biji_setting_placard', array(
        'label' => '网站公告',
        'section' => 'biji_setting'
    ));
    $wp_customize->add_control('biji_setting_cdn', array(
        'label' => '静态文件CDN',
        'section' => 'biji_setting'
    ));
    $wp_customize->add_control('biji_setting_avatar', array(
        'label' => 'Gravatar地址',
        'section' => 'biji_setting'
    ));
    $wp_customize->add_control('biji_setting_exclude', array(
        'label' => '首页过滤分类文章',
        'section' => 'biji_setting'
    ));
    $wp_customize->add_control('biji_setting_postAd', array(
        'label' => '文章结尾显示信息',
        'section' => 'biji_setting',
        'type' => 'textarea'
    ));
    $wp_customize->add_control('biji_setting_footInfo', array(
        'label' => '页脚追加JS代码',
        'section' => 'biji_setting',
        'type' => 'textarea'
    ));

    $wp_customize->add_section('biji_pay_img', array(
        'title' => '收款方式',
        'priority' => 102
    ));
    $wp_customize->add_setting('biji_pay_img_alipay', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option'
    ));
    $wp_customize->add_setting('biji_pay_img_wexpay', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'biji_pay_img_alipay', array(
        'label' => '支付宝收款',
        'section' => 'biji_pay_img'
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'biji_pay_img_wexpay', array(
        'label' => '微信收款',
        'section' => 'biji_pay_img'
    )));
}

add_action('customize_register', 'theme_customize_register');

// 纯英文评论拦截
function scp_comment_post($incoming_comment)
{
    if (!get_theme_mod('biji_setting_enc') && !preg_match('/[一-龥]/u', $incoming_comment['comment_content'])) {
        header('HTTP/1.1 301 Moved Permanently');
        die("Comments must include Chinese!");
    }
    return ($incoming_comment);
}

add_filter('preprocess_comment', 'scp_comment_post');

// Gravatar头像使用镜像服务器
function biji_get_avatar($avatar)
{
    $gr = get_theme_mod('biji_setting_avatar') ?: 'cn.gravatar.com';
    if (strpos($gr,"/avatar") || strpos($gr,"/gravatar")) {
        $avatar = preg_replace("/(www|secure|\d).gravatar.com\/avatar/", $gr, $avatar);
    } else {
        $avatar = preg_replace("/(www|secure|\d).gravatar.com/", $gr, $avatar);
    }
    // $avatar = str_replace("?s=32", "?s=100", $avatar);
    return $avatar;
}

add_filter('get_avatar', 'biji_get_avatar', 10, 3);

// 静态资源使用 CDN
function Qiniu_cdn()
{
    ob_start('Qiniu_cdn_replace');
}

add_action('template_redirect', 'Qiniu_cdn');
function Qiniu_cdn_replace($code)
{
    if (get_theme_mod('biji_setting_cdn')) {
        $cdn_img = 'png|jpg|jpeg|gif';
        $cdn_file = 'bmp|zip|rar|7z';
        if (strstr($_SERVER['HTTP_ACCEPT'], 'image/webp')) $webp = '?imageView2/0/format/webp';
        $cdn_dirs = str_replace('-', '\-', 'wp-content|wp-includes');
        $code = preg_replace(cdn_regex($cdn_dirs, $cdn_img), '' . preg_replace('#^\w+://#', '//', get_theme_mod('biji_setting_cdn')) . '/$1' . $webp . '$4', $code);
        $code = preg_replace(cdn_regex($cdn_dirs, $cdn_file), '' . preg_replace('#^\w+://#', '//', get_theme_mod('biji_setting_cdn')) . '/$1$4', $code);
    }
    return $code;
}

function cdn_regex($dirs, $type)
{
    return '/' . str_replace('/', '\/', preg_replace('#^\w+://#', '//', site_url())) . '\/((' . $dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $type . '))([\"\\\'\s\?]{1})/';
}

// 首页过滤分类文章
function exclude_category($query)
{
    $exclude_array = explode(",", get_theme_mod('biji_setting_exclude'));
    $exclude = '';
    foreach ($exclude_array as $k => $ex) {
        if ($ex > 0) {
            $ex *= -1;
        }
        $exclude .= $ex . ',';
    }
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('cat', $exclude);
    }
}

add_action('pre_get_posts', 'exclude_category');

// 缩略图技术 by：http://www.bgbk.org
if (!defined('THEME_THUMBNAIL_PATH')) define('THEME_THUMBNAIL_PATH', '/cache/theme-thumbnail'); //存储目录
function biji_build_empty_index($path)
{ //生成空白首页
    $index = $path . '/index.php';
    if (is_file($index)) return;
    wp_mkdir_p($path);
    file_put_contents($index, "<?php\n// Silence is golden.\n");
}

function biji_crop_thumbnail($url, $width, $height = null)
{ //裁剪图片
    $width = (int)$width;
    $height = empty($height) ? $width : (int)$height;
    $hash = md5($url);
    $file_path = constant('WP_CONTENT_DIR') . constant('THEME_THUMBNAIL_PATH') . "/$hash-$width-$height.jpg";
    $file_url = content_url(constant('THEME_THUMBNAIL_PATH') . "/$hash-$width-$height.jpg");
    if (is_file($file_path)) return $file_url;
    $editor = wp_get_image_editor($url);
    if (is_wp_error($editor)) return $url;
    $size = $editor->get_size();
    $dims = image_resize_dimensions($size['width'], $size['height'], $width, $height, true);
    //if( !$dims ) return $url;
    $cmp = min($size['width'] / $width, $size['height'] / $height);
    if (is_wp_error($editor->crop($dims[2], $dims[3], $width * $cmp, $height * $cmp, $width, $height))) return $url;
    biji_build_empty_index(constant('WP_CONTENT_DIR') . constant('THEME_THUMBNAIL_PATH'));
    return is_wp_error($editor->save($file_path, 'image/jpg')) ? $url : $file_url;
}

//缩略图获取post_thumbnail
function post_thumbnail($width = 275, $height = 170)
{
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $thumbnail_ID = get_post_thumbnail_id($post->ID);
        $thumbnailsrc = wp_get_attachment_image_src($thumbnail_ID, 'full');
        if ($width == 0 && $height == 0) return $thumbnailsrc[0];
        else return biji_crop_thumbnail($thumbnailsrc[0], $width, $height);
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        if (count($strResult[1]) > 0) {
            if ($width == 0 && $height == 0) return $strResult[1][0];
            else return biji_crop_thumbnail($strResult[1][0], $width, $height);
        } else return false;
    }
}

//点赞
function dotGood()
{
    global $wpdb, $post;
    $id = $_POST["um_id"];
    if ($_POST["um_action"] == 'topTop') {
        $specs_raters = get_post_meta($id, 'dotGood', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('dotGood_' . $id, $id, $expire, '/', $domain, false);
        if (!$specs_raters || !is_numeric($specs_raters)) update_post_meta($id, 'dotGood', 1);
        else update_post_meta($id, 'dotGood', ($specs_raters + 1));
        echo get_post_meta($id, 'dotGood', true);
    }
    die;
}

add_action('wp_ajax_nopriv_dotGood', 'dotGood');
add_action('wp_ajax_dotGood', 'dotGood');

/* Mini Pagenavi v1.0 by Willin Kan. Edit by zwwooooo */
if (!function_exists('pagenavi')) {
    function pagenavi($p = 5)
    {
        if (is_singular()) return;
        global $wp_query, $paged;
        $max_page = $wp_query->max_num_pages;
        if ($max_page == 1) return;
        if (empty($paged)) $paged = 1;
        //echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> ';
        if ($paged > 1) p_link($paged - 1, '上一页', '«');
        if ($paged > $p + 1) p_link(1, '最前页');
        if ($paged > $p + 2) echo '... ';
        for ($i = $paged - $p; $i <= $paged + $p; $i++) {
            if ($i > 0 && $i <= $max_page) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link($i);
        }
        if ($paged < $max_page - $p - 1) echo '... ';
        if ($paged < $max_page - $p) p_link($max_page, '最后页');
        if ($paged < $max_page) p_link($paged + 1, '下一页', '»');
    }

    function p_link($i, $title = '', $linktype = '')
    {
        if ($title == '') $title = "第 {$i} 页";
        if ($linktype == '') {
            $linktext = $i;
        } else {
            $linktext = $linktype;
        }
        echo "<a class='page-numbers' href='", esc_html(get_pagenum_link($i)), "' title='{$title}'>{$linktext}</a> ";
    }
}
// -- END ----------------------------------------

// End of page.
