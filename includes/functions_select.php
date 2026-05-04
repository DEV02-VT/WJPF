<?php 

function create_user_status_select( $id, $class, $selected, $required)
{
	global $glb_user_status;
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_user_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_user_status  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_user_board_role_select( $id, $class, $selected, $required)
{
    global $glb_board_role;
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_board_role);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_board_role  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_association_type_select( $id, $class, $selected, $required)
{
    global $glb_association_type;
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_association_type);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_association_type  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_association_filter_select( $id, $class, $selected, $required)
{
    global $glb_association_filter;
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_association_filter);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_association_filter  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_article_type_select( $id, $class, $selected, $required)
{
	global $glb_article_types;
    if (!isset($id) || $id == "")
    {
        $id = "select_article_type";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_article_types);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_article_types  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}


function create_member_select( $id, $class, $selected, $required, $readonly = false, $multiple = false)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_member";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
	if ($readonly)
    {
        $readonly = 'disabled';
    }
    else
    {
        $readonly = '';
    }
    if ($multiple)
        {
        $multiple = 'multiple';
        }
    else
    {
        $multiple = '';
    }
	$members = get_active_members();
    $selected = explode(',', $selected);


    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . ' ' . $readonly . ' ' . $multiple . ' >';
    foreach ($members  as $member)
    {
        echo '<option value="' . $member['id'] . '"' . ((in_array($member['id'], $selected)) ? ' selected="selected"' : '') . '>'. $member['first_name'] . ' ' . $member['last_name'] . '</option>\n';
    }
    echo '</select>';
}

function create_function_select( $id, $class, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_function";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    echo '<option value="1"' . (($selected == 1) ? ' selected="selected"' : '') . '>Administrator</option>\n';
    echo '<option value="2"' . (($selected == 2) ? ' selected="selected"' : '') . '>Vorstandsmitglied</option>\n';
    echo '<option value="3"' . (($selected == 3) ? ' selected="selected"' : '') . '>Social Media</option>\n';
    echo '<option value="4"' . (($selected == 3) ? ' selected="selected"' : '') . '>Sponsoring</option>\n';
    echo '</select>';
}


function create_fee_type_select( $id, $class, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_fee_type";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    echo '<option value="1"' . (($selected == 1) ? ' selected="selected"' : '') . '>Voller Beitrag</option>\n';
    echo '<option value="2"' . (($selected == 2) ? ' selected="selected"' : '') . '>Reduzierter Beitrag</option>\n';
    echo '</select>';
}

function create_year_select( $id, $class, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_year";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
	$start = 2024;
	$end = date("Y") + 3;
	
    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value="0"' . (($selected == 0 || $selected == null) ? ' selected="selected"' : '') . '></option>\n';
	for ($i = $start; $i <= $end; $i++) {
		echo '<option value="' . $i . '"' . (($selected == $i) ? ' selected="selected"' : '') . '>' . $i . '</option>\n';
	}
    echo '</select>';
}

function create_country_select( $id, $class, $required, $empty = false, $language = 'en', $multiple = false)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_country";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
	$countries = get_countries($language);
	if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
	echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . ' ' . $multiple . '>';
	if ($empty)
	{
		echo '<option value=""></option>\n';
	}
//	$primes = array("DE", "AT", "CH");
    $primes = array();
	foreach ($primes  as $prime)
    {
		if (isset($countries[$prime]))
		{
			echo '<option value="' . $prime . '">'. $countries[$prime] . '</option>\n';
		}
	}
	foreach ($countries  as $key => $country)
    {
		if (!in_array($key, $primes))
		{
			echo '<option value="' . $key . '">'. $country . '</option>\n';
		}
    }
    echo '</select>';
}


function create_country_language_select( $id, $class, $required, $empty = false, $language = 'de', $multiple = false)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_country";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    $countries = get_country_languages($language);
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    $ret =  '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . ' ' . $multiple . '>';
    if ($empty)
    {
        $ret .=  '<option value=""></option>\n';
    }
    $primes = array("DE", "GB", "FR");
    foreach ($primes  as $prime)
    {
        if (isset($countries[$prime]))
        {
            $ret .=  '<option value="' . $prime . '">'. $countries[$prime] . '</option>\n';
        }
    }
    foreach ($countries  as $key => $country)
    {
        if (!in_array($key, $primes))
        {
            $ret .=  '<option value="' . $key . '">'. $country . '</option>\n';
        }
    }
    $ret .=  '</select>';
    return  $ret;
}

function create_state_select( $country_code, $id, $class, $required, $empty = false, $other = false, $language = 'de')
{
    if (!isset($id) || $id == "")
    {
        $id = "select_state";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
	$states = get_states($country_code, $language);
	echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value=""></option>\n';
	}
	foreach ($states  as $key => $state)
    {
		echo '<option value="' . $key . '">'. $state . '</option>\n';
    }
	if ($other)
	{
		echo '<option value="OT">Ohne Bundesland</option>\n';
	}
    echo '</select>';
}

function create_event_appointment_type_select( $id, $class, $selected, $required)
{
	global $glb_event_appointment_types;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_appointment_type";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_event_appointment_types);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_event_appointment_types  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_refund_status_select( $id, $class, $selected, $required, $empty = false)
{
	global $glb_refund_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_refund_status";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_refund_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value="0"' . (($selected == 0 || $selected == null) ? ' selected="selected"' : '') . '></option>\n';
	}
    foreach ($glb_refund_status  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_event_competition_select( $event_id, $id, $class, &$selected, $required, $empty, $teamsonly = false)
{
    if ($teamsonly)
        $competitions = get_event_team_competition_array($event_id, GLB_COMPETITION_TYPE_COMPETITION);
    else
        $competitions = get_event_competition_type_array($event_id, GLB_COMPETITION_TYPE_COMPETITION);
    $language = get_language();
    $sel_competition = 0;
    $selected_found = false;

    if (!isset($id) || $id == "")
    {
        $id = "select_event_competition";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
    {
        echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
        if ($selected == -1)
        {
            $selected_found = true;
        }
        $sel_competition = -1;
    }
    foreach ($competitions  as $competition)
    {
        echo '<option value="' . $competition['id'] . '"' . (($selected == $competition['id']) ? ' selected="selected"' : '') . '>'. get_competition_title($competition, $language) . '</option>\n';
        if ($selected == $competition['id'])
        {
            $selected_found = true;
        }
        if ($sel_competition == 0)
        {
            $sel_competition = $competition['id'];
        }
    }
    echo '</select>';
    if (!$selected_found)
        $selected = $sel_competition;
}

function create_event_booking_package_select( $event_id, $id, $class, &$selected, $required, $empty)
{
    $competitions = get_event_competition_type_array($event_id, GLB_COMPETITION_TYPE_BOOKING_PACKAGE);
    $language = get_language();
    $sel_competition = 0;
    $selected_found = false;

    if (!isset($id) || $id == "")
    {
        $id = "select_event_competition";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
    {
        echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
        if ($selected == -1)
        {
            $selected_found = true;
        }
        $sel_competition = -1;
    }
    foreach ($competitions  as $competition)
    {
        echo '<option value="' . $competition['id'] . '"' . (($selected == $competition['id']) ? ' selected="selected"' : '') . '>'. get_competition_title($competition, $language) . '</option>\n';
        if ($selected == $competition['id'])
        {
            $selected_found = true;
        }
        if ($sel_competition == 0)
        {
            $sel_competition = $competition['id'];
        }
    }
    echo '</select>';
    if (!$selected_found)
        $selected = $sel_competition;
}

function create_event_heat_select( $event_id, $id, $class, &$selected, $required, $empty)
{
	$heats = get_event_heat_array($event_id);	
	$language = get_language();
	$sel_heat = 0;
	$selected_found = false;
    $ret = '';

    if (!isset($id) || $id == "")
    {
        $id = "select_event_heat";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    $ret .= '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
        $ret .= '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
		if ($selected == -1)
		{
			$selected_found = true;
		}
		$sel_heat = -1;
	}
    foreach ($heats  as $heat)
    {
        $ret .= '<option value="' . $heat['id'] . '"' . (($selected == $heat['id']) ? ' selected="selected"' : '') . '>'. get_heat_title($heat['id'], $language) . '</option>\n';
		if ($selected == $heat['id'])
		{
			$selected_found = true;
		}
		if ($sel_heat == 0)
		{
			$sel_heat = $heat['id'];
		}
    }
    $ret .= '</select>';
	if (!$selected_found)
		$selected = $sel_heat;
    return $ret;
}
function create_event_heat_startlist_select( $event_id, $id, $class, &$selected, $required, $empty)
{
    $heats = get_event_startlist_heat_array($event_id);
    $language = get_language();
    $sel_heat = 0;
    $selected_found = false;

    if (!isset($id) || $id == "")
    {
        $id = "select_event_heat";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
    {
        echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
        if ($selected == -1)
        {
            $selected_found = true;
        }
        $sel_heat = -1;
    }
    foreach ($heats  as $heat)
    {
        echo '<option value="' . $heat['id'] . '"' . (($selected == $heat['id']) ? ' selected="selected"' : '') . '>'. get_heat_title($heat['id'], $language) . '</option>\n';
        if ($selected == $heat['id'])
        {
            $selected_found = true;
        }
        if ($sel_heat == 0)
        {
            $sel_heat = $heat['id'];
        }
    }
    echo '</select>';
    if (!$selected_found)
        $selected = $sel_heat;
}

function create_competition_round_select( $competition_id, $id, $class, &$selected, $required, $empty)
{
	$rounds = get_competition_rounds($competition_id);
	$language = get_language();
	$sel_round = 0;
	$selected_found = false;

    if (!isset($id) || $id == "")
    {
        $id = "select_competition_round";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
		if ($selected == -1)
		{
			$selected_found = true;
		}
		$sel_round = -1;
	}
    foreach ($rounds  as $round)
    {
        echo '<option value="' . $round['id'] . '"' . (($selected == $round['id']) ? ' selected="selected"' : '') . '>'. translate_by_id($round['title_txt'], $language) . '</option>\n';
		if ($selected == $round['id'])
		{
			$selected_found = true;
		}
		if ($sel_round == 0)
		{
			$sel_round = $round['id'];
		}
    }
    echo '</select>';
	if (!$selected_found)
		$selected = $sel_round;
}

function create_sponsor_level_select( $id, $class, $selected, $required, $empty = false, $language = 'de')
{
	global $glb_sponsor_levels;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_type";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    natcasesort ($glb_sponsor_levels);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
	}
    foreach ($glb_sponsor_levels  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}


function create_sponsor_icon_position_select( $id, $class, $selected, $required, $empty = false, $language = 'de')
{
	global $glb_sponsor_icon_position;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_type";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_sponsor_icon_position);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
	}
    foreach ($glb_sponsor_icon_position  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_ranking_image_select( $id, $class, $selected, $required, $empty = false)
{
	$images = get_dir_images('img/ranking/');
    if (!isset($id) || $id == "")
    {
        $id = "select_ranking_image";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($images);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value=""' . (($selected == '') ? ' selected="selected"' : '') . '></option>\n';
	}
    foreach ($images  as $image)
    {
		$image = substr($image, 12);
        echo '<option value="' . $image . '"' . (($selected == $image) ? ' selected="selected"' : '') . '>'. $image . '</option>\n';
    }
    echo '</select>';
}


function create_event_image_select( $id, $class, $selected, $required, $empty = false)
{
	$images = get_dir_images('img/event/');
    if (!isset($id) || $id == "")
    {
        $id = "select_event_image";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($images);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value=""' . (($selected == '') ? ' selected="selected"' : '') . '></option>\n';
	}
    foreach ($images  as $image)
    {
		$image = substr($image, 10);
        echo '<option value="' . $image . '"' . (($selected == $image) ? ' selected="selected"' : '') . '>'. $image . '</option>\n';
    }
    echo '</select>';
}

function create_puzzle_select( $id, $class, $selected, $required, $empty = false)
{
	$puzzles = get_puzzles();
    if (!isset($id) || $id == "")
    {
        $id = "select_puzzle";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		echo '<option value=""' . (($selected == '') ? ' selected="selected"' : '') . '></option>\n';
	}
    foreach ($puzzles  as $puzzle)
    {
        echo '<option value="' . $puzzle['id'] . '" data-image="' . get_puzzle_medium_image($puzzle['id']) . '" ' . (($selected == $puzzle['id']) ? ' selected="selected"' : '') . '>'. $puzzle['name'] . '</option>\n';
    }
    echo '</select>';
}

function create_heat_participant_sort_mode_select( $id, $class, $selected, $required)
{
	global $glb_heat_participants_sort_mode;
    if (!isset($id) || $id == "")
    {
        $id = "select_heat_participant_sort_mode";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_heat_participants_sort_mode);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_heat_participants_sort_mode  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}


function create_heat_cockpit_sort_mode_select( $id, $class, $selected, $required)
{
	global $glb_heat_cockpit_sort_mode;
    if (!isset($id) || $id == "")
    {
        $id = "select_heat_participant_sort_mode";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_heat_cockpit_sort_mode);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_heat_cockpit_sort_mode  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_heat_cockpit_search_ranking_select($competition_id,  $id, $class, $selected, $required)
{
	
    if (!isset($id) || $id == "")
    {
        $id = "select_heat_cockpit_search_ranking";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
	$competition_rankings = get_competition_rankings($competition_id);
	$rankings = array();
	foreach($competition_rankings as $competition_ranking)
	{
		if ($competition_ranking['position'] > 0)
			$rankings[$competition_ranking['id']] = $competition_ranking['title'];
	}
    natcasesort ($rankings);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '>Alle</option>\n';
    foreach ($rankings  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_heat_puzzle_select($heat_id, $id, $class, $selected, $required, $empty, $solved_puzzles = array())
{
	$heat_puzzles = get_heat_heat_puzzles($heat_id);
    if (!isset($id) || $id == "")
    {
        $id = "select_heat_puzzle";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

	$ret = '';
    $ret .= '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
	if ($empty)
	{
		$ret .= '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
	}
    foreach ($heat_puzzles  as $heat_puzzle)
    {
		if ($heat_puzzle['position'] == 0 && !in_array($heat_puzzle['puzzle_id'], $solved_puzzles))
		{
			$ret .= '<option value="' . $heat_puzzle['puzzle_id'] . '" data-image="' . get_puzzle_medium_image($heat_puzzle['puzzle_id']) . '" data-pieces="' . get_puzzle_pieces($heat_puzzle['puzzle_id']) . '" ' . (($selected == $heat_puzzle['puzzle_id']) ? ' selected="selected"' : '') . '>'. get_puzzle_name($heat_puzzle['puzzle_id']) . '</option>\n';
		}
    }
    $ret .= '</select>';
	return $ret;
}

function create_heat_registration_status_select( $id, $class, $selected, $required)
{
	global $glb_heat_registration_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_heat_registration_status";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_heat_registration_status);
	$ret = '';
    $ret .= '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_heat_registration_status  as $key => $value)
    {
        $ret .= '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    $ret .= '</select>';
	return $ret;
}

function create_competition_ranking_select( $rankings, $id, $class, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_competition_ranking";
    }
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
	$ret = '';
    $ret .= '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    $ret .= '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($rankings  as $ranking)
    {
		if ($ranking['position'] != 0)
		{
			$ret .= '<option value="' . $ranking['id'] . '"' . (($selected == $ranking['id']) ? ' selected="selected"' : '') . '>'. translate_by_id($ranking['title_txt']) . '</option>\n';
		}
    }
    $ret .= '</select>';
	return $ret;
}
function create_country_filter_select($country_codes, $id, $class, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_country_filter";
    }
	$country_names = [];
	$lang = get_language();
	foreach ($country_codes as $country_code)
	{
		$country_names[$country_code] = get_country_name($country_code, $lang);
	}
	if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
	natcasesort($country_names);
	$ret = '';
    $ret .= '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    $ret .= '<option value=""' . (($selected == '') ? ' selected="selected"' : '') . '></option>';
	foreach ($country_names  as $key => $country_name)
    {
		$ret .= '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $country_name . '</option>';
    }
    $ret .= '</select>';
	return $ret;
}

function create_puzzle_filter_select($puzzles, $id, $class, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_puzzle_filter";
    }
    $lang = get_language();
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    $ret = '';
    $ret .= '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    $ret .= '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>';
    foreach ($puzzles  as $puzzle)
    {
        $ret .= '<option value="' . $puzzle['id'] . '"' . (($selected == $puzzle['id']) ? ' selected="selected"' : '') . '>'. $puzzle['name'] . '</option>';
    }
    $ret .= '</select>';
    return $ret;
}

function create_event_cost_status_select( $id, $class, $selected, $required, $empty = false)
{
    global $glb_event_cost_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_cost_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_event_cost_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
    {
        echo '<option value="0"' . (($selected == 0 || $selected == null) ? ' selected="selected"' : '') . '></option>\n';
    }
    foreach ($glb_event_cost_status  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}


function create_event_cost_type_select( $id, $class, $selected, $required)
{
    global $glb_event_cost_type;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_cost_type";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_event_cost_type);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_event_cost_type  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_smtp_transport_protocol_select( $id, $class, $selected, $required)
{
    global $glb_smtp_transport_protocol;
    if (!isset($id) || $id == "")
    {
        $id = "select_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_smtp_transport_protocol);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_smtp_transport_protocol  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}


function create_association_admin_level_select( $id, $class, $selected, $required)
{
    global $glb_association_admin_level;
    if (!isset($id) || $id == "")
    {
        $id = "select_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_association_admin_level);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_association_admin_level  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_association_select( $id, $class, $selected, $required)
{
    $user_association_names = get_user_association_names();
    if (!isset($id) || $id == "")
    {
        $id = "select_association";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
        natcasesort ($user_association_names);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($user_association_names  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_hour_select( $id, $class, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_hour";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    for ($i = 0; $i < 24; $i++)
    {
        $key = sprintf('%02d:00', $i);
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $key . '</option>\n';
    }
    echo '</select>';
}

function create_competition_nationality_handling_select( $id, $class, $selected, $required)
{
    global $glb_competition_nationality_handling;
    if (!isset($id) || $id == "")
    {
        $id = "select_competition_nationality_handling";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_competition_nationality_handling);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_competition_nationality_handling  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_meeting_status_select( $id, $class, $selected, $required, $empty = false)
{
    global $glb_meeting_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_meeting_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
    {
        echo '<option value="-1"' . (($selected == -1) ? ' selected="selected"' : '') . '></option>\n';
    }
    foreach ($glb_meeting_status  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_eating_select( $id, $class, $selected, $required)
{
    global $glb_meeting_location_eating;
    if (!isset($id) || $id == "")
    {
        $id = "select_eating";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_meeting_location_eating);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_meeting_location_eating  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}
function create_parking_select( $id, $class, $selected, $required)
{
    global $glb_meeting_location_parking;
    if (!isset($id) || $id == "")
    {
        $id = "select_parking";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_meeting_location_parking);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_meeting_location_parking  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_meeting_appointment_status_select( $id, $class, $selected, $required)
{
    global $glb_meeting_appointment_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_meeting_appointment_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_meeting_appointment_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_meeting_appointment_status  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}



function create_meeting_select( $id, $class, $selected, $required, $multiple = true)
{
    $meetings = get_published_meeting_places();
    if (!isset($id) || $id == "")
    {
        $id = "select_meeting";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    natcasesort ($meetings);

    $selected = explode(',', $selected);

    $ret =  '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $multiple . ' ' . $required . '>';
    foreach ($meetings  as $meeting_id => $name)
    {
        $ret .=  '<option value="' . $meeting_id . '"' . ((in_array($meeting_id, $selected)) ? ' selected="selected"' : '') . '>'. $name . '</option>\n';
    }
    $ret .= '</select>';
    return $ret;
}



function create_parking_space_select( $id, $class, $selected, $required, $empty, $hide_none)
{
    global $glb_meeting_location_parking;
    if (!isset($id) || $id == "")
    {
        $id = "select_meeting_appointment_parking_space";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_meeting_location_parking);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
        echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_meeting_location_parking  as $key => $value)
    {
        if (!$hide_none || $key > GLB_MEETING_LOCATION_PARKING_NONE)
            echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_meeting_link_type_select( $id, $class, $selected, $required)
{
    global $glb_meeting_link_type;
    if (!isset($id) || $id == "")
    {
        $id = "select_meeting_link_type";
    }
    natcasesort ($glb_meeting_link_type);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '">';
    foreach ($glb_meeting_link_type  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_participant_filter_select( $id, $class, $selected, $required)
{
    global $glb_participant_filter;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_appointment_type";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_participant_filter  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_event_volunteer_appointment_type_select( $id, $class, $selected, $required)
{
    global $glb_event_volunteer_appointment_types;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_volunteer_appointment_type";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_event_volunteer_appointment_types);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_event_volunteer_appointment_types  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_appointment_type_select( $id, $class, $selected, $required)
{
    global $glb_appointment_types;
    if (!isset($id) || $id == "")
    {
        $id = "select_appointment_type";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_appointment_types);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    foreach ($glb_appointment_types  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_month_select( $id, $class, $selected, $required)
{
    global $glb_months;
    if (!isset($id) || $id == "")
    {
        $id = "select_month";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
//    echo '<option value="' . 0 . '"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_months  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_library_puzzle_status_select( $id, $class, $selected, $required, $empty, $multiple)
{
    global $glb_library_puzzle_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_library_puzzle_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    natcasesort ($glb_library_puzzle_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $multiple . ' ' .$required . '>';
    if ($empty)
        echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_library_puzzle_status  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_library_puzzle_state_select( $id, $class, $selected, $required, $empty, $multiple)
{
    global $glb_library_puzzle_state;
    if (!isset($id) || $id == "")
    {
        $id = "select_library_puzzle_state";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    natcasesort ($glb_library_puzzle_state);
    $selected = explode(',', $selected);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $multiple . ' ' .$required . '>';
    if ($empty)
        echo '<option value="0"' . ((count($selected) == 0 || in_array(0,$selected)) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_library_puzzle_state  as $key => $value)
    {
        echo '<option value="' . $key . '"' . ((in_array($key,$selected)) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_library_puzzle_label_select( $id, $class, $selected, $required, $empty, $multiple)
{
    global $glb_library_puzzle_label;
    if (!isset($id) || $id == "")
    {
        $id = "select_library_puzzle_label";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    natcasesort ($glb_library_puzzle_label);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $multiple . ' ' .$required . '>';
    if ($empty)
        echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_library_puzzle_label  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}


function create_storage_select( $id, $class, $selected, $required, $multiple)
{
    $values = get_storages();
    if (!isset($id) || $id == "")
    {
        $id = "select_storage";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    $selected = explode(',', $selected);
    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $multiple . ' ' .$required . ' >';
    foreach ($values  as $value)
    {
        echo '<option value="' . $value['id'] . '"' . ((in_array($value['id'],$selected)) ? ' selected="selected"' : '') . '>'. $value['name'] . '</option>\n';
    }
    echo '</select>';
}

function create_library_puzzle_pieces_select( $id, $class, $selected, $required, $empty, $multiple)
{
    $values = get_library_puzzle_piece_values();
    if (!isset($id) || $id == "")
    {
        $id = "select_storage";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    $selected = explode(',', $selected);
    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $multiple . ' ' .$required . ' >';
    if ($empty)
        echo '<option value="0"' . ((count($selected) == 0 || in_array(0,$selected)) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($values  as $value)
    {
        echo '<option value="' . $value['pieces'] . '"' . ((in_array($value['pieces'],$selected)) ? ' selected="selected"' : '') . '>'. $value['pieces'] . '</option>\n';
    }
    echo '</select>';
}


function create_library_puzzle_order_select( $id, $class, $selected, $required, $empty, $multiple)
{
    global $glb_library_puzzle_order;
    if (!isset($id) || $id == "")
    {
        $id = "select_library_puzzle_order";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }
    natcasesort ($glb_library_puzzle_order);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $multiple . ' ' .$required . '>';
    if ($empty)
        echo '<option value="0"' . (($selected == 0) ? ' selected="selected"' : '') . '></option>\n';
    foreach ($glb_library_puzzle_order  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_round_naming_format_select( $id, $class, $selected, $required)
{
    global $glb_round_naming_formats;
    if (!isset($id) || $id == "")
    {
        $id = "select_round_naming_format";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' .$required . '>';
    foreach ($glb_round_naming_formats  as $key => $value)
    {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_event_staff_type_select( $id, $class, $selected, $required, $empty = false, $multiple = false)
{
    global $glb_event_staff_types;
    if (!isset($id) || $id == "")
    {
        $id = "select_event_staff_type";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }

    natcasesort ($glb_event_staff_types);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . ' ' . $multiple . '>';
    if ($empty)
    {
        echo '<option value="0"' . (($selected == 0 || $selected == null) ? ' selected="selected"' : '') . '></option>\n';
    }
    foreach ($glb_event_staff_types  as $id => $value)
    {
        echo '<option value="' . $id . '"' . (($selected == $id) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}


function create_event_person_type_select( $id, $class, $selected, $required, $empty = false, $multiple = false)
{
    global $glb_event_staff_types, $glb_event_person_types;
    $person_type = $glb_event_staff_types;
    foreach($glb_event_person_types as $num => $value)
        $person_type[$num] = $value;

    if (!isset($id) || $id == "")
    {
        $id = "select_event_person_type";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    if ($multiple)
    {
        $multiple = 'multiple';
    }
    else
    {
        $multiple = '';
    }

    natcasesort ($person_type);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . ' ' . $multiple . '>';
    if ($empty)
    {
        echo '<option value="0"' . (($selected == 0 || $selected == null) ? ' selected="selected"' : '') . '></option>\n';
    }
    foreach ($person_type  as $id => $value)
    {
        echo '<option value="' . $id . '"' . (($selected == $id) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_print_status_select( $id, $class, $selected, $required, $empty = false)
{
    global $glb_print_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_print_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_print_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
    {
        echo '<option value="0"' . (($selected == 0 || $selected == null) ? ' selected="selected"' : '') . '></option>\n';
    }
    foreach ($glb_print_status  as $id => $value)
    {
        echo '<option value="' . $id . '"' . (($selected == $id) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}

function create_registration_status_select( $id, $class, $selected, $required, $empty = false)
{
    global $glb_person_registration_status;
    if (!isset($id) || $id == "")
    {
        $id = "select_registration_status";
    }
    if ($required)
    {
        $required = 'required';
    }
    else
    {
        $required = '';
    }
    natcasesort ($glb_person_registration_status);

    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    if ($empty)
    {
        echo '<option value="0"' . (($selected == 0 || $selected == null) ? ' selected="selected"' : '') . '></option>\n';
    }
    foreach ($glb_person_registration_status  as $id => $value)
    {
        echo '<option value="' . $id . '"' . (($selected == $id) ? ' selected="selected"' : '') . '>'. $value . '</option>\n';
    }
    echo '</select>';
}




