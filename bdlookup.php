<?php
/*
Plugin Name: Quick English Dictionary Meaning from BeeDictionary.com
Plugin URI: http://www.beedictionary.com/
Description: This will give a small temporary popup with meaning of the difficult and confusing words.
Version: 0.9.0
Author: Bee Dictionary
Author URI: http://www.beedictionary.com
*/

/*  Copyright 2015  Bee English  Dictionary

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function add_css() {
	wp_register_style('bd_css', plugins_url('style.css',__FILE__));
	wp_enqueue_style('bd_css');
}
function bd_create_lookup($content) {
	$wordlist = file(plugins_url('wordlist',__FILE__),FILE_IGNORE_NEW_LINES);
	$urllist = file(plugins_url('urllist',__FILE__),FILE_IGNORE_NEW_LINES);
	//$content = $content."<br/>".print_r($urllist);
	$content = str_replace($wordlist,$urllist,$content);
	$content = str_replace("&bdsp;", " ", $content);
	return $content;
}
//add_action( 'admin_init','bd_css'); //'admin_enqueue_scripts'
add_action( 'wp_enqueue_scripts','add_css'); //
add_filter('the_content', 'bd_create_lookup');
?>