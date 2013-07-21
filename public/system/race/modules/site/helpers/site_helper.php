<?php

/**
 * Admin Menu Generator
 *
 * @param array $m MenuArray in nav.php
 * @param string $id ID of the <ul>
 * @param bool $sub Is submenu
 * @return string
 * @author chris
 */
function makeListFromMenu($m, $id = false, $sub = false){
	$is_active = false;
	$CI =& get_instance();
	$out[] = ($id) ? "<ul class='nav nav-list' id='$id'>" : "<ul class='nav nav-list' style='display:none;'>";
	foreach($m as $item){
		$active = ( $CI->uri->uri_string() == $item['route'] );

		// can override with the match string
		if(isset($item['match'])) {
			if(is_array($item['match'])){
				foreach($item['match'] as $match){
					$active = preg_match("/".$match."/", $CI->uri->uri_string());
					if($active) break;
				}
			}
			else{
				$active = preg_match("/".$item['match']."/", $CI->uri->uri_string());
			}
		}
		
		if($active) {
			$is_active = true;
			if($sub) $out[0] = "<ul class='nav nav-list' style='padding-top:8px; padding-right:0; padding-bottom:8px; display:block;'>";
			//echo "found active {$item['route']}";
		}
		
		// Build the sub menu recursively
		if(isset($item['sub'])){
			list($list, $sub_active) = makeListFromMenu( $item['sub'], false, true );
			if($sub_active) {
				$active = true;
			}
			$out[] = sprintf('<li class="%2$s"><a>%1$s<span>%3$s</span></a>%4$s</li>',
				(isset($item['icon'])) ? "<i class='".$item['icon']."'></i>" : '',
				//site_url($item['route']),
				($active) ? 'active' : '',
				$item['title'],
				$list
				);																		
		}
		else {	
			$out[] = sprintf('<li class="%3$s"><a href="%2$s">%1$s<span>%4$s</span></a></li>',
				(isset($item['icon'])) ? "<i class='".$item['icon']."'></i>" : '',
				site_url($item['route']),
				($active) ? 'active' : '',
				$item['title']
				);
		}
		
	}
	$out[] = "</ul>";
	return array(implode("\n",$out), $is_active);
}