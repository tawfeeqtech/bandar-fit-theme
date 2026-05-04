<?php
/**
 * Custom Walker for Navigation Menu
 * @package BandarFit
 */

if (!class_exists('Bandar_Walker_Nav_Menu')) {
    class Bandar_Walker_Nav_Menu extends Walker_Nav_Menu {
        
        /**
         * Start the element output.
         */
        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            if (is_null($args)) {
                $args = (object) [];
            }
            
            $classes = empty($item->classes) ? [] : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            
            if ($item->current) {
                $classes[] = 'active';
            }
            
            if ($item->current_item_ancestor) {
                $classes[] = 'current-ancestor';
            }
            
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            
            $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';
            
            $output .= '<li' . $id . $class_names .'>';
            
            $atts = [];
            $atts['title']  = !empty($item->title) ? $item->title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
            $atts['href']   = !empty($item->url) ? $item->url : '';
            
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
            
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            $item_output = isset($args->before) ? $args->before : '';
            $item_output .= '<a'. $attributes .'>';
            $item_output .= isset($args->link_before) ? $args->link_before : '';
            $item_output .= apply_filters('the_title', $item->title, $item->ID);
            $item_output .= isset($args->link_after) ? $args->link_after : '';
            $item_output .= '</a>';
            $item_output .= isset($args->after) ? $args->after : '';
            
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
        
        /**
         * Ends the element output, if needed.
         */
        public function end_el(&$output, $item, $depth = 0, $args = null) {
            if (is_null($args)) {
                $args = (object) [];
            }
            $output .= "</li>\n";
        }
        
        /**
         * Start the level output.
         */
        public function start_lvl(&$output, $depth = 0, $args = null) {
            if (is_null($args)) {
                $args = (object) [];
            }
            
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }
        
        /**
         * End the level output.
         */
        public function end_lvl(&$output, $depth = 0, $args = null) {
            if (is_null($args)) {
                $args = (object) [];
            }
            
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }
    }
}
