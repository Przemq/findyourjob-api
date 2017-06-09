<?php

class Menu_With_Description extends Walker_Nav_Menu {



	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		if ($depth == 1){
			$output .= "{$n}{$indent}<ul class=\"sub-menu-flex sub-menu\">{$n}";
		}
		else{
			$output .= "{$n}{$indent}<ul class=\"row sub-menu-flex sub-menu\">{$n}";
		}
	}


	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent      = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$item_output = "";
		$class_names = $value = "";

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		if ( ! empty( $classes ) ) {
			$class_names .= join( ' ', $classes);

		}


		if ( $depth == 1 ) {
			$class_names .= ' col-lg-4 col-sm-12 ' . esc_attr( $class_names ) . ' "';
			$output .= $indent . '<li id="menu-item-' . $item->ID . '" class="'. $class_names . '">';

		}else
		{
			$class_names .= esc_attr( $class_names ) . '"';
			$output .= $indent . '<li id="menu-item-' . $item->ID . '" class="'. $class_names . '">';

		}

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		if ( ! empty( $args->before ) ) {
			$item_output = $args->before;
		}

		if ( $depth == 1 ) {
			$newAttr = $attributes . ' class="learn-description" ';
			$item_output .= '<div class="menu-special-hover">';
			$item_output .= '<a' . $attributes . '><h4>' . $item->title . '</h4></a>';
			$item_output .= '<p>' . $item->description . '</p>';
			$item_output .= '<a' . $newAttr  . '>LEARN MORE</a>';
			$item_output .= '</div>';
		} else {
			$item_output .= '<a' . $attributes . '>';
			if ( isset( $args->link_before ) ) {
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			}
			$item_output .= '<br/><span class="sub">' . $item->description . '</span>';
			$item_output .= '</a>';
			if ( ! empty( $args->after ) ) {
				$item_output .= $args->after;
			}
		}

//
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}