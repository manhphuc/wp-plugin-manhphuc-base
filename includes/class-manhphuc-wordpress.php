<?php

/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 4/4/16
 * Time: 12:01 PM
 */
class NpWp
{

    /**
     * @param $postType string, name of the post type to be registered with WP
     * @param $slug string, slug of the post type
     * @param $pluralName string, plural name of the post type
     * @param $singularName string, singular name of the post type
     * @param $menuPosition int, position in sidebar menu
     */
    public static function registerPostType($postType, $slug, $pluralName, $singularName, $menuPosition)
    {
        if (!empty($postType)) {
            $labels = array(
                'name' => _x($pluralName, 'post type general name', _NP_TEXT_DOMAIN),
                'singular_name' => _x($singularName, 'post type singular name', _NP_TEXT_DOMAIN),
                'menu_name' => _x($pluralName, 'admin menu', _NP_TEXT_DOMAIN),
                'name_admin_bar' => _x($singularName, 'add new on admin bar', _NP_TEXT_DOMAIN),
                'add_new' => _x(sprintf('Add New %s', $singularName), _NP_TEXT_DOMAIN),
                'add_new_item' => __(sprintf('Add New %s', $singularName), _NP_TEXT_DOMAIN),
                'new_item' => __(sprintf('New %s', $singularName), _NP_TEXT_DOMAIN),
                'edit_item' => __(sprintf('Edit %s', $singularName), _NP_TEXT_DOMAIN),
                'view_item' => __(sprintf('View %s', $singularName), _NP_TEXT_DOMAIN),
                'all_items' => __(sprintf('All %s', $pluralName), _NP_TEXT_DOMAIN),
                'search_items' => __(sprintf('Search %s', $pluralName), _NP_TEXT_DOMAIN),
                'parent_item_colon' => __(sprintf('Parent %s :', $singularName), _NP_TEXT_DOMAIN),
                'not_found' => __(sprintf('No %s found', $pluralName), _NP_TEXT_DOMAIN),
                'not_found_in_trash' => __(sprintf('No %s found in Trash.', $pluralName), _NP_TEXT_DOMAIN)
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'query_var' => true,
                'rewrite' => array('slug' => $slug),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => $menuPosition,
                'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
            );
            register_post_type($postType, $args);
        }
    }

    public static function registerTaxonomy($taxonomy, $slugTaxonomy, $postType, $pluralName, $singularName)
    {
        if (!empty($taxonomy)) {
            register_taxonomy($taxonomy, $postType, array(
                // Hierarchical taxonomy (like categories)
                'hierarchical' => true,
                // This array of options controls the labels displayed in the WordEvent Admin UI
                'labels' => array(
                    'name' => _x($pluralName, 'taxonomy general name'),
                    'singular_name' => _x($singularName, 'taxonomy singular name'),
                    'search_items' => __(sprintf('Search %s', $singularName)),
                    'all_items' => __(sprintf('All %s', $pluralName)),
                    'parent_item' => __(sprintf('Parent %s', $singularName)),
                    'parent_item_colon' => __(sprintf('Parent %s :', $singularName)),
                    'edit_item' => __(sprintf('Edit %s', $singularName)),
                    'update_item' => __(sprintf('Update %s ', $singularName)),
                    'add_new_item' => __(sprintf('Add New %s', $singularName)),
                    'new_item_name' => __(sprintf('New %s', $singularName)),
                    'menu_name' => __($pluralName),
                ),

                // Control the slugs used for this taxonomy
                'rewrite' => array(
                    'slug' => $slugTaxonomy, // This controls the base slug that will display before each term
                    'with_front' => false, // Don't display the category base before "/locations/"
                    'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
                ),
            ));
        }
    }

    public static function useAddOn($libs = array())
    {
        $default = array(
            'bootstrap-js',
            'bx-slider',
            'detect-izr',
            'modern-izr',
            'font-awesome',
            'color-box',
            'owl-carousel',
            'packery',
            'slick',
        );
        if (empty($libs)) {
            $libs = $default;
        }
        foreach ($libs as $item) {
            switch ($item) {
                case 'bootstrap-js':
                    wp_enqueue_script('bootstrap-js', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/bootstrap/dist/js/bootstrap.min.js', array(), _NP_PLUGIN_VER, true);
                    break;
                case 'bx-slider' :
                    wp_enqueue_style('bx-slider-css', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/bxslider-4/dist/jquery.bxslider.css', array(), _NP_PLUGIN_VER, true);
                    wp_enqueue_script('bx-slider-js', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/bxslider-4/dist/jquery.bxslider.min.js', array(), _NP_PLUGIN_VER, true);
                    wp_enqueue_script('main-slider', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/bxslider-4/dist/jquery.bxslider.min.js', array(), _NP_PLUGIN_VER, true);
                    break;
                case 'detect-izr' :
                    wp_enqueue_script('detect-izr', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/detectizr/dist/detectizr.min.js', array(), _NP_PLUGIN_VER, true);
                    break;
                case 'modern-izr' :
                    wp_enqueue_script('modern-izr', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/modernizr/modernizr.min.js', array(), _NP_PLUGIN_VER, true);
                    break;
                case 'font-awesome':
                    wp_enqueue_style('font-awesome', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/font-awesome/css/font-awesome.min.css', array(), _NP_PLUGIN_VER, true);
                    break;
                case 'color-box':
                    wp_enqueue_style('jquery-colorbox-css', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/jquery-colorbox/example1/colorbox.css', array(), _NP_PLUGIN_VER, true);
                    wp_enqueue_script('jquery-colorbox-js', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/jquery-colorbox/jquery.colorbox.js', array(), _NP_PLUGIN_VER, true);
                    break;
                case 'owl-carousel':
                    wp_enqueue_style('owl-carousel', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/owl-carousel/owl.carousel.css', array(), _NP_THEME_VERSION);
                    wp_enqueue_style('owl-theme', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/owl-carousel/owl.theme.css', array(), _NP_THEME_VERSION);
                    wp_enqueue_script('jquery-owl-carousel-js', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/owl-carousel/owl.carousel.js', array(), _NP_THEME_VERSION, true);
                    break;
                case 'packery':
                    wp_enqueue_script('packery-js', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/packery/dist/packery.pkgd.min.js', array(), _NP_PLUGIN_VER, true);
                    break;
                case 'slick':
                    wp_enqueue_style('jquery-colorbox-css', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/slick-carousel/slick/slick.css', array(), _NP_PLUGIN_VER, true);
                    wp_enqueue_script('jquery-colorbox-js', MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/slick-carousel/slick/slick.min.js', array(), _NP_PLUGIN_VER, true);
                    break;

            }
        }
    }


    public static function getBlock($blockName, $params = array())
    {
        extract($params);
        $blockDefaultPath = MANHPHUC_BASE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'default-block' . DIRECTORY_SEPARATOR . $blockName . '.php';
        $blockThemePath = get_template_directory() . DIRECTORY_SEPARATOR . 'block' . DIRECTORY_SEPARATOR . $blockName . '.php';
        global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
        if (!empty($params)) {
            $args = array_merge($wp_query->query, $params);
            query_posts($args);
        }
        if (is_array($wp_query->query_vars)) {
            extract($wp_query->query_vars, EXTR_SKIP);
        }
        if (file_exists($blockThemePath)) {
            include $blockThemePath;
        } else if (file_exists($blockDefaultPath)) {
            include($blockDefaultPath);
        } else {
            echo 'Error: File Not Found.';
        }

    }

    public static function registerMainSlider($args = array())
    {
        $args = array();
        $subFields = array();
        if (empty($args)) {
            $args = array(
                'image',
                'intro',
                'button_text',
                'button_link',
            );
        }
        foreach ($args as $item) {
            switch ($item) {
                case'image':
                    $subFields = array(
                        array(
                            'key' => 'field_573177546f3f7',
                            'label' => __('Image', _NP_TEXT_DOMAIN),
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                        ),
                    );
                    break;
                case'intro':
                    $subFields = array_merge($subFields, array(
                            array(
                                'key' => 'field_5731776b6f3f8',
                                'label' => __('Intro', _NP_TEXT_DOMAIN),
                                'name' => 'intro',
                                'type' => 'textarea',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'maxlength' => '',
                                'rows' => '',
                                'new_lines' => 'wpautop',
                                'readonly' => 0,
                                'disabled' => 0,
                            ),
                        )
                    );
                    break;
                case'button_text':
                    $subFields = array_merge($subFields, array(
                            array(
                                'key' => 'field_573177766f3f9',
                                'label' => __('Button Text', _NP_TEXT_DOMAIN),
                                'name' => 'button_text',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                                'readonly' => 0,
                                'disabled' => 0,
                            ),
                        )
                    );
                    break;
                case'button_link':
                    $subFields = array_merge($subFields, array(
                        array(
                            'key' => 'field_5731777d6f3fa',
                            'label' => __('Button Link', _NP_TEXT_DOMAIN),
                            'name' => 'button_link',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        )
                    ));
                    break;
            }
        }
        if (function_exists('acf_add_local_field_group')):

            acf_add_local_field_group(array(
                'key' => 'group_5731773fa67da',
                'title' => __('Options - Main Slider', _NP_TEXT_DOMAIN),
                'fields' => array(
                    array(
                        'key' => 'field_5731778b6f3fb',
                        'label' => __('Slider', _NP_TEXT_DOMAIN),
                        'name' => 'slider',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => '',
                        'max' => '',
                        'layout' => 'block',
                        'button_label' => __('Add Slider Item'), _NP_TEXT_DOMAIN,
                        'sub_fields' => $subFields
                    ),
                    array(
                        'key' => 'field_5731794cc7caa',
                        'label' => __('Autoplay', _NP_TEXT_DOMAIN),
                        'name' => 'autoplay',
                        'type' => 'number',
                        'instructions' => __('In millisecond. Default 0 (not sliding on start).', _NP_TEXT_DOMAIN),
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array(
                        'key' => 'field_57317964c7cab',
                        'label' => __('Transition', _NP_TEXT_DOMAIN),
                        'name' => 'transition',
                        'type' => 'number',
                        'instructions' => __('Speed in millisecond when slider rotating.'), _NP_TEXT_DOMAIN,
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 1000,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'acf-options',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ));

            acf_add_local_field_group(array(
                'key' => 'group_57317811158c8',
                'title' => __('Page - Main Slider', _NP_TEXT_DOMAIN),
                'fields' => array(
                    array(
                        'key' => 'field_5731782233e45',
                        'label' => __('Option Slider', _NP_TEXT_DOMAIN),
                        'name' => 'option_slider',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'no' => __('No Main Slider', _NP_TEXT_DOMAIN),
                            'global' => __('Use Global', _NP_TEXT_DOMAIN),
                            'custom' => __('Use Custom', _NP_TEXT_DOMAIN),
                        ),
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                    ),
                    array(
                        'key' => 'field_5731785b33e46',
                        'label' => 'Slider',
                        'name' => 'slider',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5731782233e45',
                                    'operator' => '==',
                                    'value' => 'custom',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => '',
                        'max' => '',
                        'layout' => 'block',
                        'button_label' => __('Add Slider Item', _NP_TEXT_DOMAIN),
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5731787533e47',
                                'label' => __('Image', _NP_TEXT_DOMAIN),
                                'name' => 'image',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => '',
                            ),
                            array(
                                'key' => 'field_573178a833e48',
                                'label' => __('Intro', _NP_TEXT_DOMAIN),
                                'name' => 'intro',
                                'type' => 'textarea',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'maxlength' => '',
                                'rows' => '',
                                'new_lines' => 'wpautop',
                                'readonly' => 0,
                                'disabled' => 0,
                            ),
                            array(
                                'key' => 'field_573178b133e49',
                                'label' => __('Button Text', _NP_TEXT_DOMAIN),
                                'name' => 'button_text',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                                'readonly' => 0,
                                'disabled' => 0,
                            ),
                            array(
                                'key' => 'field_573178bb33e4a',
                                'label' => __('Button Link', _NP_TEXT_DOMAIN),
                                'name' => 'button_link',
                                'type' => 'url',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_573178d746af9',
                        'label' => __('Autoplay', _NP_TEXT_DOMAIN),
                        'name' => 'autoplay',
                        'type' => 'number',
                        'instructions' => __('In millisecond. Default 0 (not sliding on start).', _NP_TEXT_DOMAIN),
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5731782233e45',
                                    'operator' => '==',
                                    'value' => 'custom',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array(
                        'key' => 'field_573178fb46afa',
                        'label' => __('Transition', _NP_TEXT_DOMAIN),
                        'name' => 'transition',
                        'type' => 'number',
                        'instructions' => __('Speed in millisecond when slider rotating.', _NP_TEXT_DOMAIN),
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5731782233e45',
                                    'operator' => '==',
                                    'value' => 'custom',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 1000,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'page',
                        ),
                    ),
                ),
                'menu_order' => 1,
                'position' => 'acf_after_title',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ));

        endif;
    }

    public static function displayMainSlider()
    {
        $mainSliderType = 1;
        $optionSlider = get_field('option_slider');
        NpWp::registerStyleMainSlider($mainSliderType);
        NpWp::registerScriptMainSlider($mainSliderType);
        if ($optionSlider == 'global') {
            $data = get_field('slider', 'option');
            $autoPlay = get_field('autoplay', 'option');
            $transition = get_field('transition', 'option');
            $args = array(
                'data' => $data,
                'autoPlay' => $autoPlay,
                'transition' => $transition,
            );
            NpWp::getBlock('common/_main-slider', $args);
        }
        if ($optionSlider == 'custom') {
            $data = get_field('slider');
            $autoPlay = get_field('autoplay');
            $transition = get_field('transition');
            $args = array(
                'data' => $data,
                'autoPlay' => $autoPlay,
                'transition' => $transition,
            );
            NpWp::getBlock('common/_main-slider', $args);
        }

    }

    /**
     * @param int $type : if $type = 1 using bx slider
     */
    protected function registerStyleMainSlider($type = 1)
    {
        if ($type == 1) {
            $styleDefaultUrl = MANHPHUC_BASE_PLUGIN_URL . '/assets/common/main-slider.css';
            $styleThemePath = get_template_directory() . DIRECTORY_SEPARATOR . 'assets/common/main-slider.css';
            $styleThemeUrl = get_template_directory_uri() . DIRECTORY_SEPARATOR . 'assets/common/main-slider.css';
            if (file_exists($styleThemePath)) {
                wp_enqueue_style('main-slider-css', $styleThemeUrl, array(), _NP_THEME_VERSION);
            } else {
                wp_enqueue_style('main-slider-default-css', $styleDefaultUrl, array(), _NP_PLUGIN_VER);
            }
        }
    }

    protected function registerScriptMainSlider($type)
    {
        if ($type == 1) {
            $scriptDefaultUrl = MANHPHUC_BASE_PLUGIN_URL . '/assets/common/main-slider.js';
            $scriptThemePath = get_template_directory() . DIRECTORY_SEPARATOR . 'assets/common/main-slider.js';
            $scriptThemeUrl = get_template_directory_uri() . DIRECTORY_SEPARATOR . 'assets/common/main-slider.js';
            if (file_exists($scriptThemePath)) {
                wp_enqueue_script('main-slider-js', $scriptThemeUrl, array(), _NP_THEME_VERSION, true);
            } else {
                wp_enqueue_script('main-slider-default-js', $scriptDefaultUrl, array(), _NP_PLUGIN_VER, true);
            }
        }
    }

    /*
     * Function for get year month link of post type
     */
    public static function getArchives($postType = 'post', $format = 'month', $timeFormat = 'Y-m-d H:i:s', $type = 'link')
    {
        global $wpdb;
        $year_query = get_query_var('year');
        $mont_query = get_query_var('monthnum');

        $query = "
            SELECT YEAR(post_date) AS `year`, count(ID) as posts , MONTH(post_date) as `month`
            FROM $wpdb->posts
            WHERE post_type = '$postType' AND post_status = 'publish' 
            GROUP BY `year`, `month` 
            ORDER BY `year` DESC, `month` ASC
         ";
        $results = $wpdb->get_results($query);
        $arrayResult = array();
        if (!empty($results)) {
            foreach ($results as $item) {
                $arrayResult[$item->year][$item->month] = $item->posts;
            }
        }
        if ($type == 'select' && !empty($arrayResult)) : ?>
            <select class="archive-link-list archive-link-<?php echo $postType ?>">
                <?php foreach ($arrayResult as $year => $months): ?>

                    <optgroup label="<?php echo $year ?>">
                        <?php foreach (array_reverse($months, true) as $month => $count):
                            $datetime = new DateTime($year . '-' . $month . '-1');
                            ?>
                            <option
                                value="<?php echo get_month_link($year, $month); ?>" <?php echo ($year == $year_query && $month == $mont_query) ? 'selected' : '' ?>><?php echo $datetime->format($timeFormat) ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
        <?php endif;
    }

    public static function getLatestYear($postType = 'post')
    {
        global $wpdb;
        $query = "
        SELECT YEAR(post_date) AS `year`, count(ID) as posts 
        FROM $wpdb->posts
        WHERE post_type = '$postType' AND post_status = 'publish' 
        GROUP BY YEAR(post_date) 
        ORDER BY post_date DESC 
     ";
        $results = $wpdb->get_results($query);
        return $results[0]->year;
    }

    public static function getTheExcerpt($postID)
    {
        global $post;
        $save_post = $post;
        $post = get_post($postID);
        $output = get_the_excerpt();
        $post = $save_post;
        return $output;
    }

    public static function getVideoID($videoUrl)
    {
        $youtubeUrl = $videoUrl;
        parse_str(parse_url($youtubeUrl, PHP_URL_QUERY), $arrayResult);
        return $arrayResult['v'];
    }

    public static function addRoleAdmin()
    {
        add_role('admin', __(
            'Site Admin'),
            array(
            'activate_plugins'=>false,
            'create_users'=>true,
            'delete_others_pages'=>true,
            'delete_others_posts'=>true,
            'delete_pages'=>true,
            'delete_plugins'=>false,
            'delete_posts'=>true,
            'delete_private_pages'=>true,
            'delete_private_posts'=>true,
            'delete_published_pages'=>true,
            'delete_published_posts'=>true,
            'delete_themes'=>false,
            'delete_users'=>true,
            'edit_dashboard'=>true,
            'edit_others_pages'=>true,
            'edit_others_posts'=>true,
            'edit_pages'=>true,
            'edit_plugins'=>false,
            'edit_posts'=>true,
            'edit_private_pages'=>true,
            'edit_private_posts'=>true,
            'edit_published_pages'=>true,
            'edit_published_posts'=>true,
            'edit_theme_options'=>true,
            'edit_themes'=>false,
            'edit_users'=>true,
            'export'=>true,
            'import'=>true,
            'install_plugins'=>false,
            'install_themes'=>false,
            'list_users'=>true,
            'manage_categories'=>true,
            'manage_links'=>true,
            'manage_options'=>true,
            'moderate_comments'=>true,
            'promote_users'=>true,
            'publish_pages'=>true,
            'publish_posts'=>true,
            'read'=>true,
            'read_private_pages'=>true,
            'read_private_posts'=>true,
            'remove_users'=>true,
            'switch_themes'=>true,
            'unfiltered_html'=>true,
            'unfiltered_upload'=>true,
            'update_core'=>false,
            'update_plugins'=>false,
            'update_themes'=>false,
            'upload_files'=>true,
            'copy_posts'=>true,
            'create_posts'=>true,
            'publish_s'=>true,
            'read_private_s'=>true,
            'wpseo_bulk_edit'=>true,
            )
        );
    }
}