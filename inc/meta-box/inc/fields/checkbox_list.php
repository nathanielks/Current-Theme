<?php

if ( ! class_exists( 'RWMB_Checkbox_List_Field' ) ) 
{
	class RWMB_Checkbox_List_Field 
	{
		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field ) 
		{
			if ( ! is_array( $meta ) )
				$meta = (array) $meta;

			$html = array();

			foreach ( $field['options'] as $key => $value ) 
			{
				$checked = checked( in_array( $key, $meta ), true, false );
				$name    = " name='{$field['id']}[]'";
				$val     = " value='{$key}'";
				$html[]  = "<input type='checkbox' class='rwmb-checkbox-list'{$name}{$val}{$checked} /> {$value}";
			}
			return implode( '<br />', $html );
		}
	}
}