<?php

function requirejs(){
	$args = func_get_args();
	$arr = array_map('stringify', $args);
	printf('<script type="text/javascript" charset="utf-8">require([%s]);</script>', 
		implode($arr,',') 
	);		
}
function stringify($a){ return "'$a'";}

function _l($key){	
	return lang($key);
}
function _ll($key){
	return strtolower(_l($key));
}
// function _lu($key){
// 	return ucwords(_l($key));
// }

function echo_json($data){
	$CI =& get_instance();
	$CI->output->set_content_type('application/json')->set_output( json_encode($data) );	
}

/**
 * Return current datetime in ISO format
 *
 * @return string
 */
function now(){
	return date( 'Y-m-d H:i:s' );
}
function today($pretty = false){
	if($pretty) return date("m\/d\/y");
	else return date( 'Y-m-d' );
}
function moment(){
	return date( 'H:i:s' );
}

function courseBikelyEmbed($url, $width = 400, $height = 280){
	return sprintf('<div id="routemapiframe" style="width: %2$spx; border: 1px solid #d0d0d0; overflow: hidden; white-space: nowrap;">'.
				   '<iframe id="rmiframe" style="height:%3$spx;  background: #eee;" width="100%%" frameborder="0" scrolling="no" src="%1$s/embed"></iframe></div>',
					$url,
					$width,
					$height);
}

// Sorting By Rider Points
function rider_cmp($a, $b){
    if ($a['points'] == $b['points']) { return 0; }
    return ($a['points'] < $b['points']) ? 1 : -1;
}

// Setting model shortcut
function setting($key, $decode = false){
	$CI =& get_instance();
	
	$data = $CI->setting_model->item($key);
	if($decode)
		return json_decode($data);
	else 
		return $data;
}

function pr($i){
	echo "<pre>";
	print_r($i);
	echo "</pre>";
}

function formatRiderId($id){
	return "#". str_pad($id, 3, '0', STR_PAD_LEFT);
}

function formatMiles($miles){
	if($miles == 0){
		return '&mdash;';
	}
	return number_format($miles, 1) .' mi';
}

function formatElevation($elevation){
	if($elevation == 0){
		return '&mdash;';
	}
	return number_format($elevation) .' ft';
}

function formatPlace($p){
	if($p == 11 || $p == 12 || $p == 13) return $p .'th';
	if($p % 10 == 1) return $p.'st';
	elseif($p % 10 == 2) return $p.'nd';
	elseif($p % 10 == 3) return $p.'rd';
	else return $p.'th';
	
}

function formatCategoryClimb($p){
	switch($p){
		case 1:
			return '&#10122;';
		case 2:
			return '&#10123;';
		case 3:
			return '&#10124;';
		case 4:
			return '&#10125;';
		default:
			return '&mdash;';
	}
}

function formatSpeed($s){
	return sprintf('%1.1f mph', $s);
}

// function formatTime($t){

// }

function timeToSeconds($str){
	$time = array_reverse(explode(':', $str));
	$sec = (isset($time[0])) ? $time[0] : 0;
	$mins = (isset($time[1])) ? $time[1] * 60 : 0;
	$hours = (isset($time[2])) ? $time[2] * 60 * 60 : 0;
	return $sec + $mins + $hours;	
}

function secondsToTime($sec) {
    
    $hms = "";    
    $hours = intval($sec / (60*60));
    if($hours > 0)
    	$hms .= $hours. ":";
    $minutes = intval(($sec - ($hours * 60 * 60)) / 60 ); 
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";
    $seconds = intval($sec % 60); 
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
    return $hms;    
}

/**
 * calculate the time until a timestamp occurs
 *
 * @param string $timestamp 
 * @param string $format 
 * @return void
 * @author cgiufer
 */

function findTime($timestamp, $format){
	return findTimeExtended($timestamp, time(), $format);
}

function findTimeExtended($timestamp, $time, $format) {        
    $difference = $timestamp - $time; 
    if($difference < 0) 
        return false; 
	if($difference < 60){
		return "less than one minute";
	}
    else{ 
    
        $min_only = intval(floor($difference / 60)); 
        $hour_only = intval(floor($difference / 3600)); 
        
        $days = intval(floor($difference / 86400)); 
        $difference = $difference % 86400; 
        $hours = intval(floor($difference / 3600)); 
        $difference = $difference % 3600; 
        $minutes = intval(floor($difference / 60)); 
        if($minutes == 60){ 
            $hours = $hours+1; 
            $minutes = 0; 
        } 
        
        if($days == 0){ 
            $format = str_replace('Days', '?', $format); 
            $format = str_replace('Ds', '?', $format); 
            $format = str_replace('%d', '', $format); 
        } 
        if($hours == 0){ 
            $format = str_replace('Hours', '?', $format); 
            $format = str_replace('Hs', '?', $format); 
            $format = str_replace('%h', '', $format); 
        } 
        if($minutes == 0){ 
            $format = str_replace('Minutes', '?', $format); 
            $format = str_replace('Mins', '?', $format); 
            $format = str_replace('Ms', '?', $format);        
            $format = str_replace('%m', '', $format); 
        } 
        
        $format = str_replace('?,', '', $format); 
        $format = str_replace('?:', '', $format); 
        $format = str_replace('?', '', $format); 
        
        $timeLeft = str_replace('%d', number_format($days), $format);        
        $timeLeft = str_replace('%ho', number_format($hour_only), $timeLeft); 
        $timeLeft = str_replace('%mo', number_format($min_only), $timeLeft); 
        $timeLeft = str_replace('%h', number_format($hours), $timeLeft); 
        $timeLeft = str_replace('%m', number_format($minutes), $timeLeft); 
            
        if($days == 1){ 
            $timeLeft = str_replace('Days', 'Day', $timeLeft); 
            $timeLeft = str_replace('Ds', 'D', $timeLeft); 
        } 
        if($hours == 1 || $hour_only == 1){ 
            $timeLeft = str_replace('Hours', 'Hour', $timeLeft); 
            $timeLeft = str_replace('Hs', 'H', $timeLeft); 
        } 
        if($minutes == 1 || $min_only == 1){ 
            $timeLeft = str_replace('Minutes', 'Minute', $timeLeft); 
            $timeLeft = str_replace('Mins', 'Min', $timeLeft); 
            $timeLeft = str_replace('Ms', 'M', $timeLeft);            
        } 
            
      return $timeLeft; 
    } 
} 

function findTimeGreatest($timestamp) {        
    $difference = time() - $timestamp;
    if($difference < 0) 
        return false; 
	if($difference < 60){
		return "less than one minute";
	}
    else { 
        $min_only = intval(floor($difference / 60)); 
        $hour_only = intval(floor($difference / 3600)); 

        $days = intval(floor($difference / 86400)); 
        $difference = $difference % 86400; 
        $hours = intval(floor($difference / 3600)); 
        $difference = $difference % 3600; 
        $minutes = intval(floor($difference / 60)); 
        if($minutes == 60){ 
            $hours = $hours+1; 
            $minutes = 0; 
        }

		if($days > 0){
			return number_format($days) ." days ago";
		}
		if($hours > 0){
			return number_format($hours) ." hours ago";
		}
		if($minutes > 0){
			return number_format($minutes) ." minutes ago";
		}
	}
}			
	
	
function innerHTML($el) {
  $doc = new DOMDocument();
  $doc->appendChild($doc->importNode($el, TRUE));
  $html = trim($doc->saveHTML());
  $tag = $el->nodeName;
  return preg_replace('@^<' . $tag . '[^>]*>|</' . $tag . '>$@', '', $html);
}

function buildTable($tbody, $thead = null, $class = null, $id = null) {
	$table = '';
	$thead_rows = '';
	$tbody_rows = '';
	$tbody_attr = '';

	if($thead != null) {
		foreach ($thead as $key => $row) {
			$thead_rows .= buildTableRow($row);
		}
		$table .= sprintf('<thead>%s</thead>', $thead_rows);
	}

	// each table row
	foreach ($tbody as $key => $row) {
		if($key === 'attr'){
			foreach($row as $k => $v) {
				$tbody_attr .= " {$k}=\"{$v}\"";
			}
		}
		else {
			$tbody_rows .= buildTableRow($row);
		}
	}
	$table .= sprintf('<tbody %s>%s</tbody>', $tbody_attr, $tbody_rows);

	return sprintf('<table %1$s %3$s>%2$s</table>', isset($class) ? "class='$class table-race'" : null, $table, "id='$id'");
}

function buildTableRow($arr) {
	$row = '';
	$row_attr = '';
	// each table cell
	foreach ($arr as $key => $cell) {
		if($key === 'attr'){
			foreach($cell as $k => $v) {
				$row_attr .= " {$k}=\"{$v}\"";
			}
		}
		else {
			$row .= buildTableCell($cell);
		}
	}
	return sprintf('<tr %s>%s</tr>', $row_attr, $row);
}

function buildTableCell($arr) {
	$attr = '';
	if(isset($arr['attr'])){		
		foreach ($arr['attr'] as $key => $value) {
			$attr .= " {$key}=\"{$value}\"";
		}
	}
	if(isset($arr['td'])){
		return sprintf('<td %s>%s</td>', $attr, isset($arr['td']) ? $arr['td'] : null);
	}
	if(isset($arr['th'])){
		return sprintf('<th %s>%s</th>', $attr, isset($arr['th']) ? $arr['th'] : null);	
	}
}




