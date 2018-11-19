<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('good_homes_storage_get')) {
	function good_homes_storage_get($var_name, $default='') {
		global $GOOD_HOMES_STORAGE;
		return isset($GOOD_HOMES_STORAGE[$var_name]) ? $GOOD_HOMES_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('good_homes_storage_set')) {
	function good_homes_storage_set($var_name, $value) {
		global $GOOD_HOMES_STORAGE;
		$GOOD_HOMES_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('good_homes_storage_empty')) {
	function good_homes_storage_empty($var_name, $key='', $key2='') {
		global $GOOD_HOMES_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($GOOD_HOMES_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($GOOD_HOMES_STORAGE[$var_name][$key]);
		else
			return empty($GOOD_HOMES_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('good_homes_storage_isset')) {
	function good_homes_storage_isset($var_name, $key='', $key2='') {
		global $GOOD_HOMES_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($GOOD_HOMES_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($GOOD_HOMES_STORAGE[$var_name][$key]);
		else
			return isset($GOOD_HOMES_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('good_homes_storage_inc')) {
	function good_homes_storage_inc($var_name, $value=1) {
		global $GOOD_HOMES_STORAGE;
		if (empty($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = 0;
		$GOOD_HOMES_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('good_homes_storage_concat')) {
	function good_homes_storage_concat($var_name, $value) {
		global $GOOD_HOMES_STORAGE;
		if (empty($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = '';
		$GOOD_HOMES_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('good_homes_storage_get_array')) {
	function good_homes_storage_get_array($var_name, $key, $key2='', $default='') {
		global $GOOD_HOMES_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($GOOD_HOMES_STORAGE[$var_name][$key]) ? $GOOD_HOMES_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($GOOD_HOMES_STORAGE[$var_name][$key][$key2]) ? $GOOD_HOMES_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('good_homes_storage_set_array')) {
	function good_homes_storage_set_array($var_name, $key, $value) {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if ($key==='')
			$GOOD_HOMES_STORAGE[$var_name][] = $value;
		else
			$GOOD_HOMES_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('good_homes_storage_set_array2')) {
	function good_homes_storage_set_array2($var_name, $key, $key2, $value) {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if (!isset($GOOD_HOMES_STORAGE[$var_name][$key])) $GOOD_HOMES_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$GOOD_HOMES_STORAGE[$var_name][$key][] = $value;
		else
			$GOOD_HOMES_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('good_homes_storage_merge_array')) {
	function good_homes_storage_merge_array($var_name, $key, $value) {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if ($key==='')
			$GOOD_HOMES_STORAGE[$var_name] = array_merge($GOOD_HOMES_STORAGE[$var_name], $value);
		else
			$GOOD_HOMES_STORAGE[$var_name][$key] = array_merge($GOOD_HOMES_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('good_homes_storage_set_array_after')) {
	function good_homes_storage_set_array_after($var_name, $after, $key, $value='') {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if (is_array($key))
			good_homes_array_insert_after($GOOD_HOMES_STORAGE[$var_name], $after, $key);
		else
			good_homes_array_insert_after($GOOD_HOMES_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('good_homes_storage_set_array_before')) {
	function good_homes_storage_set_array_before($var_name, $before, $key, $value='') {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if (is_array($key))
			good_homes_array_insert_before($GOOD_HOMES_STORAGE[$var_name], $before, $key);
		else
			good_homes_array_insert_before($GOOD_HOMES_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('good_homes_storage_push_array')) {
	function good_homes_storage_push_array($var_name, $key, $value) {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($GOOD_HOMES_STORAGE[$var_name], $value);
		else {
			if (!isset($GOOD_HOMES_STORAGE[$var_name][$key])) $GOOD_HOMES_STORAGE[$var_name][$key] = array();
			array_push($GOOD_HOMES_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('good_homes_storage_pop_array')) {
	function good_homes_storage_pop_array($var_name, $key='', $defa='') {
		global $GOOD_HOMES_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($GOOD_HOMES_STORAGE[$var_name]) && is_array($GOOD_HOMES_STORAGE[$var_name]) && count($GOOD_HOMES_STORAGE[$var_name]) > 0) 
				$rez = array_pop($GOOD_HOMES_STORAGE[$var_name]);
		} else {
			if (isset($GOOD_HOMES_STORAGE[$var_name][$key]) && is_array($GOOD_HOMES_STORAGE[$var_name][$key]) && count($GOOD_HOMES_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($GOOD_HOMES_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('good_homes_storage_inc_array')) {
	function good_homes_storage_inc_array($var_name, $key, $value=1) {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if (empty($GOOD_HOMES_STORAGE[$var_name][$key])) $GOOD_HOMES_STORAGE[$var_name][$key] = 0;
		$GOOD_HOMES_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('good_homes_storage_concat_array')) {
	function good_homes_storage_concat_array($var_name, $key, $value) {
		global $GOOD_HOMES_STORAGE;
		if (!isset($GOOD_HOMES_STORAGE[$var_name])) $GOOD_HOMES_STORAGE[$var_name] = array();
		if (empty($GOOD_HOMES_STORAGE[$var_name][$key])) $GOOD_HOMES_STORAGE[$var_name][$key] = '';
		$GOOD_HOMES_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('good_homes_storage_call_obj_method')) {
	function good_homes_storage_call_obj_method($var_name, $method, $param=null) {
		global $GOOD_HOMES_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($GOOD_HOMES_STORAGE[$var_name]) ? $GOOD_HOMES_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($GOOD_HOMES_STORAGE[$var_name]) ? $GOOD_HOMES_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('good_homes_storage_get_obj_property')) {
	function good_homes_storage_get_obj_property($var_name, $prop, $default='') {
		global $GOOD_HOMES_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($GOOD_HOMES_STORAGE[$var_name]->$prop) ? $GOOD_HOMES_STORAGE[$var_name]->$prop : $default;
	}
}
?>