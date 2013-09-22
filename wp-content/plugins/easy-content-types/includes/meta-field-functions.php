<?php

function ecpt_get_meta_field_types() {
	$field_types = array('text', 'textarea', 'select', 'checkbox', 'multicheck', 'radio', 'date', 'upload', 'slider', 'repeatable', 'repeatable upload');

	return apply_filters( 'ecpt_field_types', $field_types );
}