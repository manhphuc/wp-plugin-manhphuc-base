<?php
/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 2/19/16
 * Time: 3:59 PM
 */
namespace ManhPhuc\BoostStrapNavWalker;
class BoostStrapNavWalker extends \Walker_Nav_Menu
{

    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item Menu item data object.
     * @param  int $depth Depth of menu item. May be used for padding.
     * @param  array $args Additional strings.
     * @return void
     */
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     * @param bool $level
     * @param  array $args Additional strings.
     */
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        // depth dependent classes

        $level = isset($args->level) ? ($args->level - 1) : false;
        if (!$level) {
            $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent
            $display_depth = ($depth); // because it counts the first submenu as 0
            $classes = array('collapse sub-menu dropdown-menu', 'level-' . $display_depth);
            $class_names = implode(' ', $classes);

            // build html
            $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
        }
    }

    /**
     * @param string $output
     * @param object $item
     * @param int $depth
     * @param array $args
     * @param int $id
     *
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        $classes = empty ($item->classes) ? array() : (array)$item->classes;
        $current_object = get_queried_object();
        $has_children_after = !empty($args->has_children_after) ? $args->has_children_after : '';
        if (isset($args->level)) {
            if ($args->level && $args->level > $depth) {
                $level = $args->level - 1;
            } else {
                $level = $depth;
            }
        }


        $target_object_id = '#';

        $postParent = isset(get_post($item->object_id)->post_parent) ? get_post($item->object_id)->post_parent : '';
        if (isset($current_object) &&  $current_object->has_archive && isset(get_post($item->object_id)->post_name) &&get_post($item->object_id)->post_name == $current_object->rewrite['slug']) {
            $classes[] = 'current-menu-item';
        }
        if (is_page($current_object) &&
            (in_array($item->object_id, get_ancestors($current_object->ID, 'page')) ||
                in_array($postParent, get_ancestors($current_object->ID, 'page'))
            )
        ) {
            $classes[] = 'current-menu-item';
        }

        if (is_single($current_object)) {
            $c_post_type = get_post_type($current_object);

            if (get_post($item->object_id)->post_name == get_post_type_object($c_post_type)->rewrite['slug']) {

                $classes[] = 'current-menu-item';
            }
        }

        $class_names = join(
            ' '
            , apply_filters(
                'nav_menu_css_class'
                , array_filter($classes), $item
            )
        );
        if (isset($args->has_children)) {
            if ($args->has_children && $depth == 0) {
                !empty ($class_names)
                and $class_names = ' class="' . esc_attr($class_names) . ' has_children dropdown"';

                if (isset($args->has_children_after)) {
                    if (!$args->has_children_after) {
                        $args->has_children_after = '<i class="fa fa-caret-down visible-xs visible-sm"></i>';
                    } else {
                        $args->has_children_after = $has_children_after;
                    }
                }
            } else {
                !empty ($class_names)
                and $class_names = ' class="' . esc_attr($class_names) . '"';
                if (isset($args->has_children_after)) {
                    $args->has_children_after = '';
                }
            }
        }

        $attributes = '';

        !empty($item->attr_title)
        and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target)
        and $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn)
        and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url)
        and $attributes .= ' href="' . esc_attr($item->url) . '"';

        if (defined('SCROLLBY') && SCROLLBY) {

            if (is_single($item->object_id) || is_page($item->object_id)) {
                $target_object_id .= get_post_field('post_name', $item->object_id);
            }

            $attributes .= ' data-target="' . $target_object_id . '"';
        }


        // insert description for top level elements only
        // you may change this
        $description = (!empty ($item->description) and 0 == $depth)
            ? '<span class="desc">' . esc_attr($item->description) . '</span>' : '';

        $title = apply_filters('the_title', $item->title, $item->ID);
        $level = $depth;
        if ($level == $depth) {

            $output .= "<li id='menu-item-$item->ID' $class_names>";

            $item_output = (isset($args->before) ? $args->before : '')
                . "<a $attributes>"
                . (isset($args->link_before) ? $args->link_before : '')
                . $title
                . '</a>'
                . (isset($args->link_after) ? $args->link_after : '')
                . (isset($args->has_children_after) ? $args->has_children_after : '')
                . $description
                . (isset($args->after) ? $args->after : '');
        }
        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
            , $item_output
            , $item
            , $depth
            , $args
        );
    }

}