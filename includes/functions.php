<?php

function encode($string)
{
    return htmlentities($string);
}

function decode($string)
{
    return htmlspecialchars(html_entity_decode($string));
}

function redirect($location)
{
    return header("Location: {$location}");
}

function set_message($message)
{
    if (!empty($message))
    {
        $_SESSION['message'] = $message;
    }
    else
    {
        $message = "";
    }
}

function display_message()
{
    if (isset($_SESSION['message']))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function create_request_key()
{
    $vals = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    $max = count($vals) - 1;
    $ret = '';
    for ($i = 0; $i < 32; $i++)
    {
        $ret .= $vals[rand(0, $max)];
    }
    return $ret;
}
function token_generator()
{
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
}

function check_language()
{
	if (isset($_GET['language']) && ($_GET['language'] == 'de' || $_GET['language'] == 'en' ))
	{
		set_language($_GET['language']);
		return $_GET['language'];
	}
	return get_language();
}

function set_language($lang)
{
	$_SESSION['language'] = $lang; 
}

function get_language()
{
	if (!isset($_SESSION['language']))
	{
		$_SESSION['language'] = 'de'; 
	}
	return $_SESSION['language'];
}

function get_locale()
{
    switch (get_language())
    {
        case 'en':
            return 'en_US';
        default:
            return 'de_DE';
    }
}

function getCurrentSite()
{
    $currentURL = (filter_input(INPUT_SERVER, 'HTTPS') == "on") ? "https://" : "http://";
    $currentURL .= filter_input(INPUT_SERVER, "SERVER_NAME");

    $serverport = filter_input(INPUT_SERVER, "SERVER_PORT");
    if($serverport != "80" && $serverport != "443")
    {
        $currentURL .= ":".$serverport;
    }
    return $currentURL;
}
function getCurrentURL()
{
    $currentURL = (filter_input(INPUT_SERVER, 'HTTPS') == "on") ? "https://" : "http://";
    $currentURL .= filter_input(INPUT_SERVER, "SERVER_NAME");
 
    $serverport = filter_input(INPUT_SERVER, "SERVER_PORT");
    if($serverport != "80" && $serverport != "443")
    {
        $currentURL .= ":".$serverport;
    } 
 
    $currentURL .=  dirname(filter_input(INPUT_SERVER, 'PHP_SELF'));
    return $currentURL;
}

function get_page_url($page)
{
	$path = $_SERVER['REQUEST_URI'];
	$pos = strrpos($path, '/');
	if ($pos === FALSE)
	{
		$path = '';
	}
	else
	{
		$path = substr($path, 0, $pos + 1);
	}
//	$url =  $_SERVER['REQUEST_SCHEME'] . '://' .  $_SERVER['SERVER_NAME'] . $path . $page;
	$url =  $_SERVER['REQUEST_SCHEME'] . '://' .  $_SERVER['SERVER_NAME'] . '/' . $page; //Probleme bei der URI in Xampp über VirtualHost lösen!
	return $url;
}

function get_german_day($tag)
{
	$tage = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
	return $tage[$tag];
}


function get_german_month($month)
{
	$monate = array(1=>"Januar",2=>"Februar",3=>"M&auml;rz",4=>"April",5=>"Mai",6=>"Juni",7=>"Juli",8=>"August",9=>"September",10=>"Oktober",11=>"November",12=>"Dezember");
	return $monate[$month];
}

function display_german_date($date)
{
	if (!$date || trim($date) == '' || $date == '0000-00-00')
	{
		return '';
	}
	return date('d.m.Y', strtotime($date));
}

function get_language_url($lang)
{
	if ($lang == 'de')
	{
		$other = 'en';
	}
	else
	{
		$other = 'de';
	}
	$uri = $_SERVER['REQUEST_URI'];
	$pos = strpos($uri, '?');
	if ($pos === false)
	{
		return $uri . '?language=' . $lang;
	}
	$pos = strpos($uri, 'language=');
	if ($pos === false)
	{
		return $uri . '&language=' . $lang;
	}
	return substr($uri, 0, $pos) . 'language=' . $lang . substr($uri, $pos + 11);
}

function  compute_interval_date($date, $day, $before)
{
	if ($day <= 0)
	{
		return $date;
	}
	if ($before)
	{
		return date('Y-m-d', strtotime($date . ' -' . $day . ' days')) ;
	}
	return date('Y-m-d', strtotime($date . ' +' . $day . ' days')) ;
}

function check_text_length($text, $length = 20)
{
	if (strlen($text) < $length)
	{
		return format_text($text);
	}
	$ret = '<span tabindex="0" data-toggle="tooltip" title="' . format_text($text) . '">' . format_text(mb_substr($text, 0, $length - 3, "UTF-8")) . '...</span>';
	return $ret;
}

function format_text($text)
{
//	$text = str_replace('"', '&quot;', $text);
	$text = htmlspecialchars($text);
	return $text;
}

function begin_cmp($a, $b)
{
    return strcmp($a["begin"], $b["begin"]);
}
function created_cmp($a, $b)
{
    return strcmp($b["created"], $a["created"]);
}

function name_cmp($a, $b)
{
    return strcmp($a["name"], $b["name"]);
}
function title_cmp($a, $b)
{
    return strcmp($a["title"], $b["title"]);
}

function first_name_last_name_cmp($a, $b)
{
    return strcmp($a["first_name"] . ' '. $a["last_name"], $b["first_name"] . ' '. $b["last_name"]);
}

function country_name_cmp($a, $b)
{
    $collator = new Collator("de_DE");
    return $collator->compare($a["country_name"], $b["country_name"]);
}

function table_number_cmp($a, $b)
{
    return $a["table_number"] - $b["table_number"];
}

function position_cmp($a, $b)
{
	if ($a["position"] == 0 && $b["position"] != 0)
		return 1;
	if ($a["position"] != 0 && $b["position"] == 0)
		return -1;
    return $a["position"] - $b["position"];
}

function pieces_time_cmp($a, $b)
{
	if ($a["pieces"] > $b["pieces"])
		return -1;
	if ($a["pieces"] < $b["pieces"])
		return 1;
	if ($a["total_time"] > $b["total_time"])
		return 1;
	if ($a["total_time"] < $b["total_time"])
		return -1;
    return  0;
}

function result_pieces_time_cmp($a, $b)
{
    if ($a["time"] == 0 && $b["time"] == 0)
    {
        if ($a["pieces"] > $b["pieces"])
            return -1;
        if ($a["pieces"] < $b["pieces"])
            return 1;
    }
    else if ($a["duration"] != $b["duration"])
    {
        if ($a["time"] == 0)
            return 1;
        if ($b["time"] == 0)
            return -1;
        if ($a["duration"] > $b["duration"])
            return 1;
        if ($a["duration"] < $b["duration"])
            return -1;
    }
    return  0;
}

function count_cmp($a, $b)
{
	if ($a["count"] > $b["count"])
		return 1;
	if ($a["count"] < $b["count"])
		return -1;
    return  0;
}


function set_show_cancelled_inscriptions($show)
{
	$_SESSION['show_cancelled_inscriptions'] = $show; 
}

function get_show_cancelled_inscriptions()
{
	if (!isset($_SESSION['show_cancelled_inscriptions']))
	{
		$_SESSION['show_cancelled_inscriptions'] = false; 
	}
	return $_SESSION['show_cancelled_inscriptions'];
}

function set_selected_event_media_type($eventid, $type)
{
	$_SESSION['Event_' . $eventid]['selected_media_type'] = $type; 
}

function get_selected_event_media_type($eventid)
{
	if (!isset($_SESSION['Event_' . $eventid]['selected_media_type']))
	{
		$_SESSION['Event_' . $eventid]['selected_media_type'] = GLB_EVENT_MEDIA_TYPE_VIDEO; 
	}
	return $_SESSION['Event_' . $eventid]['selected_media_type'];
}

function set_selected_event_photo_gallery($eventid, $galleryid)
{
	$_SESSION['Event_' . $eventid]['selected_photo_gallery'] = $galleryid; 
}

function get_selected_event_photo_gallery($eventid)
{
	if (!isset($_SESSION['Event_' . $eventid]['selected_photo_gallery']))
	{
		$_SESSION['Event_' . $eventid]['selected_photo_gallery'] = 0; 
	}
	return $_SESSION['Event_' . $eventid]['selected_photo_gallery'];
}

function set_selected_event_result_data($eventid, $heat_id, $search_string, $ranking_id, $country_code, $puzzle_id, $chart_type)
{
    $_SESSION['Event_' . $eventid]['result_data']['heat_id'] = $heat_id;
    $_SESSION['Event_' . $eventid]['result_data']['search_string'] = $search_string;
    $_SESSION['Event_' . $eventid]['result_data']['ranking_id'] = $ranking_id;
    $_SESSION['Event_' . $eventid]['result_data']['country_code'] = $country_code;
    $_SESSION['Event_' . $eventid]['result_data']['puzzle_id'] = $puzzle_id;
    $_SESSION['Event_' . $eventid]['result_data']['chart_type'] = $chart_type;
}

function get_selected_event_result_data($eventid)
{
    if (!isset($_SESSION['Event_' . $eventid]['result_data']))
    {
        $_SESSION['Event_' . $eventid]['result_data']['heat_id'] = 0;
        $_SESSION['Event_' . $eventid]['result_data']['search_string'] = '';
        $_SESSION['Event_' . $eventid]['result_data']['ranking_id'] = 0;
        $_SESSION['Event_' . $eventid]['result_data']['country_code'] = '';
        $_SESSION['Event_' . $eventid]['result_data']['puzzle_id'] = 0;
        $_SESSION['Event_' . $eventid]['result_data']['chart_type'] = GLB_RESULT_CHART_TYPE_LIST;
    }
    return $_SESSION['Event_' . $eventid]['result_data'];
}

function set_access_control_pass($event_id, $heat_id, $type, $value)
{
    $id = $event_id . ' _ ' . $heat_id. ' _ ' . $type;
    get_access_control($event_id, $heat_id, $type);
    $_SESSION['access_control_pass'][$id] = $value;
}

function get_access_control_pass($event_id, $heat_id, $type)
{
    $id = $event_id . ' _ ' . $heat_id. ' _ ' . $type;
    if (!isset($_SESSION['access_control_pass'][$id]))
    {
        $_SESSION['access_control_pass'][$id] = '';
    }
    return  $_SESSION['access_control_pass'][$id];
    ;
}
function set_timekeeper_event_id($event_id)
{
    get_timekeeper_event_id();
    $_SESSION['timekeeper_event_id'] = $event_id;
}

function get_timekeeper_event_id()
{
    if (!isset($_SESSION['timekeeper_event_id']))
    {
        $_SESSION['timekeeper_event_id'] = 0;
    }
    return  $_SESSION['timekeeper_event_id'] ;
}
function set_timekeeper_event_heat_id($event_id, $heat_id)
{
    get_timekeeper_event_heat_id($event_id);
    $_SESSION['timekeeper_event_heat_id'][$event_id] = $heat_id;
}

function get_timekeeper_event_heat_id($event_id)
{
    if (!isset($_SESSION['timekeeper_event_heat_id'][$event_id]))
    {
        $_SESSION['timekeeper_event_heat_id'][$event_id] = 0;
    }
    return  $_SESSION['timekeeper_event_heat_id'][$event_id];
}

function set_timekeeper_heat_table_block($heat_id, $table_block)
{
    get_timekeeper_heat_table_block($heat_id);
    $_SESSION['timekeeper_event_heat_table_block'][$heat_id] = $table_block;
}

function get_timekeeper_heat_table_block($heat_id)
{
    if (!isset($_SESSION['timekeeper_event_heat_table_block'][$heat_id]))
    {
        $_SESSION['timekeeper_event_heat_table_block'][$heat_id] = 1;
    }
    return  $_SESSION['timekeeper_event_heat_table_block'][$heat_id];
}


function create_print_entry($ids)
{
    $id = 1;
    while (isset($_SESSION['Print'][$id]))
        $id++;
    $_SESSION['Print'][$id] = $ids;
    return $id;
}

function get_print_entry($id)
{
    if (!isset($_SESSION['Print'][$id]))
    {
        $_SESSION['Print'][$id] = '';
    }
    return $_SESSION['Print'][$id];
}
function set_print_entry($id, $ids)
{
    get_print_entry($id);
    $_SESSION['Print'][$id] = $ids;
}

function delete_print_entry($id)
{
    unset($_SESSION['Print'][$id]);
}

function get_key_date($years, $age_mode, $event_begin, $event_end)
{
	switch ($age_mode)
	{
		case SCO_COMPETITION_RANKING_AGE_DEADLINE_END_YEAR:
			$date = date('Y', strtotime($event_begin)) . '-12-31';
			break;
		case SCO_COMPETITION_RANKING_AGE_DEADLINE_BEGINNING_YEAR:
			$date = date('Y', strtotime($event_begin)) . '-01-01';
			break;
		case SCO_COMPETITION_RANKING_AGE_DEADLINE_END_EVENT:
			$date = $event_end;
			break;
		case SCO_COMPETITION_RANKING_AGE_DEADLINE_BEGINNING_EVENT:
			$date = $event_begin;
			break;
		default:
			return '';
	}
	return date('Y-m-d', strtotime($date . ' -' . $years . ' years')) ;
}

function minutes_to_hour_string($minutes)
{
	return str_pad(intdiv($minutes, 60), 2, '0', STR_PAD_LEFT) .':'. str_pad(($minutes % 60), 2, '0', STR_PAD_LEFT).' h';
}

function check_name_string_size($first_name, $last_name, $max_length = 30)
{
	$first_name = trim($first_name);
	$last_name = trim($last_name);
	if (strlen($first_name) + strlen($last_name) < $max_length)
	{
		return $first_name . ' ' . $last_name;
	}
	return substr($first_name, 0, 1) . '. ' . $last_name;
}

function display_time($time, $short = false)
{
	$hour = intdiv($time, 3600);
	$time = $time - $hour * 3600;
	$minute = intdiv($time, 60);
	$second = $time % 60;
    if (!$short || $hour > 0)
	    return sprintf('%02d:%02d:%02d', $hour, $minute, $second);
    if ($minute > 0)
    {
        return sprintf('%02d:%02d', $minute, $second);
    }
    return sprintf('%02d', $second);
}


function display_div_time($time, $ref_time)
{
	if ($time < $ref_time)
	{
		$time = $ref_time - $time;
		$hour = intdiv($time, 3600);
		$time = $time - $hour * 3600;
		$minute = intdiv($time, 60);
		$second = $time % 60;
		if ($hour > 0)
		{
			return sprintf('-%02d:%02d:%02d', $hour, $minute, $second);
		}
		if ($minute > 0)
		{
			return sprintf('-%02d\' %02d\'\'', $minute, $second);		
		}
		return sprintf('-%02d\'\'', $second);		
	}
	else
	{
		$time = $time - $ref_time;
		$hour = intdiv($time, 3600);
		$time = $time - $hour * 3600;
		$minute = intdiv($time, 60);
		$second = $time % 60;
		if ($hour > 0)
		{
			return sprintf('+%02d:%02d:%02d', $hour, $minute, $second);
		}
		if ($minute > 0)
		{
			return sprintf('+%02d\' %02d\'\'', $minute, $second);		
		}
		return sprintf('+%02d\'\'', $second);		
	}
}


function get_age($birthday)
{
    $date = new DateTime($birthday);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}
function get_eoy_age($birthday, $year)
{
    $date = new DateTime($birthday);
    $eoy = new DateTime($year . '-12-31');
    $interval = $eoy->diff($date);
    return $interval->y;
}

function display_money_diff($first, $second)
{
    $ret = '';
    if ($first > $second)
        $ret .= '<span class="red">';
    else
        $ret .= '<span class="green">';
    $ret .= '<b>'. number_format($second -$first, 2, ',', '.') . ' €';
    $ret .= '</b></span>';
    return $ret;
}

function set_meeting_filter($meeting_filter)
{
    $_SESSION['meeting_filter'] = $meeting_filter;
}

function get_meeting_filter()
{
    if (!isset($_SESSION['meeting_filter']))
    {
        $_SESSION['meeting_filter'] = array();
    }
    if (!isset($_SESSION['meeting_filter'][GLB_MEETING_FILTER_MEETING]))
    {
        $_SESSION['meeting_filter'][GLB_MEETING_FILTER_MEETING] = '';
    }
    if (!isset($_SESSION['meeting_filter'][GLB_MEETING_FILTER_DOG_ALLOWED]))
    {
        $_SESSION['meeting_filter'][GLB_MEETING_FILTER_DOG_ALLOWED] = 0;
    }
    if (!isset($_SESSION['meeting_filter'][GLB_MEETING_FILTER_BUS_STOP]))
    {
        $_SESSION['meeting_filter'][GLB_MEETING_FILTER_BUS_STOP] = 0;
    }
    if (!isset($_SESSION['meeting_filter'][GLB_MEETING_FILTER_PARKING_SPACE]))
    {
        $_SESSION['meeting_filter'][GLB_MEETING_FILTER_PARKING_SPACE] = 0;
    }
    if (!isset($_SESSION['meeting_filter'][GLB_MEETING_FILTER_DISABLED_PARKING_SPACE]))
    {
        $_SESSION['meeting_filter'][GLB_MEETING_FILTER_DISABLED_PARKING_SPACE] = 0;
    }
    if (!isset($_SESSION['meeting_filter'][GLB_MEETING_FILTER_DISABLED_TOILET]))
    {
        $_SESSION['meeting_filter'][GLB_MEETING_FILTER_DISABLED_TOILET] = 0;
    }
    if (!isset($_SESSION['meeting_filter'][GLB_MEETING_FILTER_BARRIER_FREE]))
    {
        $_SESSION['meeting_filter'][GLB_MEETING_FILTER_BARRIER_FREE] = 0;
    }

    return $_SESSION['meeting_filter'];
}

function set_meeting_tab_position($id, $position)
{
    get_meeting_tab_position($id);
    $_SESSION['meeting_tab_position'][$id]  = $position;
}
function get_meeting_tab_position($id)
{
    if (!isset($_SESSION['meeting_tab_position']))
    {
        $_SESSION['meeting_tab_position'] = array();
    }
    if (!isset($_SESSION['meeting_tab_position'][$id]))
    {
        $_SESSION['meeting_tab_position'][$id] = 1;
    }
    return $_SESSION['meeting_tab_position'][$id] ;
}

function set_social_project_tab_position($id, $position)
{
    get_social_project_tab_position($id);
    $_SESSION['social_project_tab_position'][$id]  = $position;
}
function get_social_project_tab_position($id)
{
    if (!isset($_SESSION['social_project_tab_position']))
    {
        $_SESSION['social_project_tab_position'] = array();
    }
    if (!isset($_SESSION['social_project_tab_position'][$id]))
    {
        $_SESSION['social_project_tab_position'][$id] = 1;
    }
    return $_SESSION['social_project_tab_position'][$id] ;
}

function print_yes_no_icon($value)
{
    if (isset($value) && $value)
    {
        return '<img class="table_button"  src="img/yes.png">';
    }
    return '<img class="table_button"  src="img/minus.png">';
}

function set_tf_last_competition($eventid, $competitionid)
{
    $_SESSION['Teamfinder_' . $eventid]['last_competition'] = $competitionid;
}

function get_tf_last_competition($eventid)
{
    if (!isset($_SESSION['Teamfinder_' . $eventid]['last_competition']))
    {
        $_SESSION['Teamfinder_' . $eventid]['last_competition'] = 0;
    }
    return $_SESSION['Teamfinder_' . $eventid]['last_competition'];
}

function set_tf_competition_last_registration($eventid, $competitionid, $registrationid)
{
    $_SESSION['Teamfinder_' . $eventid][$competitionid]['last_registration'] = $registrationid;
}

function get_tf_competition_last_registration($eventid, $competitionid)
{
    if (!isset($_SESSION['Teamfinder_' . $eventid][$competitionid]['last_registration']))
    {
        $_SESSION['Teamfinder_' . $eventid][$competitionid]['last_registration'] = 0;
    }
    return $_SESSION['Teamfinder_' . $eventid][$competitionid]['last_registration'];
}

function set_tf_competition_registration_last_tab($competitionid, $registrationid, $tabid)
{
    $_SESSION['Teamfinder_Competition' . $competitionid][$registrationid]['last_tab'] = $tabid;
}

function get_tf_competition_registration_last_tab($competitionid, $registrationid)
{
    if (!isset($_SESSION['Teamfinder_Competition' . $competitionid][$registrationid]['last_tab']))
    {
        $_SESSION['Teamfinder_Competition' . $competitionid][$registrationid]['last_tab'] = 0;
    }
    return $_SESSION['Teamfinder_Competition' . $competitionid][$registrationid]['last_tab'];
}

function create_pagination($page_count, $page, $caption, $link_class = '')
{
    $ret = '';
    $ret .= '<div class="row ">';
    $ret .=  '<div class="col-12 col-md-6 text-center"><b>';
    $ret .=  $caption . ' ';
    if ($page_count > 1)
    {
        $ret .=  translate_by_shortcut('SEITE') . ' ' . $page . ' ' . translate_by_shortcut('VON') . ' ' . $page_count;
    }
    $ret .=  '</b></div>';
    if ($page_count > 1)
    {
        $ret .=  '<div class="col-12 col-md-6 justify-content-center">';
        $ret .=  '<nav><ul class="pagination justify-content-center">';
        if ($page > 1)
        {
            $ret .=  '<li class="page-item">';
            $ret .=  '  <a class="' . $link_class . ' page-link" data-page="1" tabindex="-1">' . translate_by_shortcut('ERSTE') . '</a>';
            $ret .=  '</li>';
        }
        if ($page > 2)
        {
            $ret .=  '<li class="page-item"><a class="' . $link_class . ' page-link" data-page="' . ($page - 2) . '">' . ($page - 2) . '</a></li>';
        }
        if ($page > 1)
        {
            $ret .=  '<li class="page-item"><a class="' . $link_class . ' page-link" data-page="' . ($page - 1) . '">' . ($page - 1) . '</a></li>';
        }
        $ret .=  '<li class="page-item disabled"><a class="' . $link_class . ' page-link" data-page="' . $page . '">' . $page . '</a></li>';
        if ($page < $page_count)
        {
            $ret .=  '<li class="page-item"><a class="' . $link_class . ' page-link" data-page="' . ($page + 1) . '">' . ($page + 1) . '</a></li>';
        }
        if ($page < $page_count - 1)
        {
            $ret .=  '<li class="page-item"><a class="' . $link_class . ' page-link" data-page="' . ($page + 2) . '">' . ($page + 2) . '</a></li>';
        }
        if ($page < $page_count)
        {
            $ret .=  '<li class="page-item">';
            $ret .=  '  <a class="' . $link_class . ' page-link" data-page="' . $page_count . '">' . translate_by_shortcut('LETZTE') . '</a>';
            $ret .=  '</li>';
        }
        $ret .=  '</ul>';
        $ret .=  '</nav>';
        $ret .=  '</div>';
    }
    $ret .=  '</div>';
    return $ret;
}





