 <?php

    /*
Plugin Name: Post Form
Author: Navjyoti
Date: 19-Jan-2022
 */
    add_action('wp_enqueue_scripts', 'ava_test_init');

    function ava_test_init()
    {
        wp_enqueue_script('jquery.min-js', plugins_url('/js/jquery.min.js', __FILE__));

        wp_enqueue_script('custom-js', plugins_url('/js/custom.js', __FILE__));
    }

    add_shortcode('editor_frontend_post', 'editor_frontend_post');
    function editor_frontend_post()
    {
        //editor_post_if_submitted(); 
    ?>
     <form id="new_post" name="new_post" method="post" enctype="multipart/form-data" action="#">
<div id="result_post_data"></div>
         <p><label for="title"><?php echo esc_html__('Title', 'theme-domain'); ?></label><br />
             <input type="text" id="title" value="" tabindex="1" size="20" name="title" />
         </p>

         <?php wp_editor('', 'content'); ?>

         <p><?php wp_dropdown_categories('show_option_none=Category&tab_index=4&taxonomy=category'); ?></p>

         <p><label for="post_tags"><?php echo esc_html__('Tags', 'theme-domain'); ?></label>

             <input type="text" value="" tabindex="5" size="16" name="post_tags" id="post_tags" />
         </p>

         <input type="file" name="post_image" id="post_image" aria-required="true">

         <p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

     </form>
 <?php
    }

    // add_action('after_setup_theme', 'editor_post_if_submitted');
    add_action('wp_ajax_nopriv_postdata', 'ajax_posts');
    add_action('wp_ajax_postdata', 'ajax_posts');


    function ajax_posts()
    {
        // Stop running function if form wasn't submitted
        if (!isset($_POST['title'])) {
            return;
        }

        // Add the content of the form to $post as an array
        $post = array(
            'post_title'    => $_POST['title'],
            'post_content'  => $_POST['content'],
            'post_category' => array($_POST['cat']),
            'tags_input'    => $_POST['post_tags'],
            'post_status'   => 'draft',   // Could be: publish
            'post_type'     => 'editor_post' // Could be: 'page' or your CPT
        );
        $post_id = wp_insert_post($post);

        // For Featured Image
        if (!function_exists('wp_generate_attachment_metadata')) {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }
        if ($_FILES) {
            foreach ($_FILES as $file => $array) {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                    return "upload error : " . $_FILES[$file]['error'];
                }
                $attach_id = media_handle_upload($file, $post_id);
            }
        }
        if ($attach_id > 0) {
            update_post_meta($post_id, '_thumbnail_id', $attach_id);
        }
        $post = get_post($post_id);

        $to = get_option('admin_email');
        $subject = "New Post Added By Guest";
        $body = '
                  <h1>Dear Admin,</h1></br>
                  <p>New Post Added By Guest</p>
                  <p>Kind Regards,</p>
        ';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        if (wp_mail($to, $subject, $body, $headers)) {
            echo 'Saved your post successfully';
        }else{
        echo "error";
        }
    }


    /******List of posts */
    /* custom code to show all gallery on gallery page */

    function list_gallery($atts)
    {
        $atts = shortcode_atts($atts, 'gallery_list');
        global  $posts_array;
        $result .= ' <div id="tabs-all">';
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;

        $postsPerPage = 5;
        $postOffset = $paged * $postsPerPage;

        $args = array(
            'posts_per_page'  => $postsPerPage,
            'offset'          => $postOffset,
            'category' => '',
            'category_name' => '',
            'orderby' => 'date',
            'order' => 'DESC',
            'include' => '',
            'exclude' => '',
            'meta_key' => '',
            'meta_value' => '',
            'post_type' => 'editor_post',
            'post_mime_type' => '',
            'post_parent' => '',
            'post_status' => 'draft'

        );
        $posts_array = get_posts($args);

        $result .= '<div class="pending_posts">';
        if (is_array($posts_array) || is_object($posts_array)) {
            foreach ($posts_array as $data) {
                $permalink = get_the_permalink($data->ID);
                $title = get_the_title($data->ID);
                $content = $data->post_content;
                $trimmed_content = wp_trim_words($content, 10, '...');
                $image = get_the_post_thumbnail(($data->ID));

                if (!empty($image)) {
                    $result .= '<div class="sow-image-container projects"><div class="project-image"><a href="' . $permalink . '">' . $image . '</a></div><div class="project-container"><h2 class="project-title"><a href="' . $permalink . '"> ' . $title . ' </a></h2><div class="portfolio-detail-description"><p>' . $trimmed_content . '</p></div><div class="view-more-projects"><a class="hvr-sweep-to-right" href="' . $permalink . '">Continue </a></div></div></div>';
                } else {

                    $result .= '<div class="sow-image-container projects"><div class="project-image"><img alt="' . $title . '" width="300" height="241" src="' . get_site_url() . '/wp-content/uploads/2022/01/default.jpg" ></div><div class="project-container"><h2 class="project-title"><a href="' . $permalink . '"> ' . $title . '</a></h2><div class="portfolio-detail-description"><p>' . $trimmed_content . '</p></div><div class="view-more-projects"><a class="hvr-sweep-to-right" href="' . $permalink . '">Continue </a></div></div></div>';
                }
            }
            next_posts_link('Older Entries'); //not displaying
            previous_posts_link('Newer Entries &raquo;'); //not displaying
            wp_reset_postdata();
        }
        $result .= '</div>';
        return $result;
    }

    add_shortcode('gallery_list', 'list_gallery');

    ?>