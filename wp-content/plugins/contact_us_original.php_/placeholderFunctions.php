<?php

	if ( function_exists('esc_url') ) {

	} else {
		function esc_url($attribute_name) {
			return $attribute_name;
		}
	}
	