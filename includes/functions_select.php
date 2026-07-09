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

function create_association_select($id, $class, $associations, $selected, $required)
{
    if (!isset($id) || $id == "")
    {
        $id = "select_association";
    }
    $required = $required ? 'required' : '';
    echo '<select id="' . $id . '" name="' . $id . '" class ="' . $class . '" ' . $required . '>';
    echo '<option value=""></option>';
    foreach ($associations as $association)
    {
        echo '<option value="' . $association['id'] . '"' . (($selected == $association['id']) ? ' selected="selected"' : '') . '>' . htmlspecialchars($association['name']) . '</option>';
    }
    echo '</select>';
}

function create_news_status_select($id, $class, $selected, $required)
{
    global $glb_news_status;
    if ($required) {
        $required = 'required';
    } else {
        $required = '';
    }
    echo '<select id="' . $id . '" name="' . $id . '" class="' . $class . '" ' . $required . '>';
    foreach ($glb_news_status as $key => $value) {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>' . $value . '</option>';
    }
    echo '</select>';
}

function create_association_link_type_select($id, $class, $selected, $required)
{
    global $glb_association_link_type;
    if ($required) {
        $required = 'required';
    } else {
        $required = '';
    }
    echo '<select id="' . $id . '" name="' . $id . '" class="' . $class . '" ' . $required . '>';
    echo '<option value=""></option>';
    foreach ($glb_association_link_type as $key => $value) {
        echo '<option value="' . $key . '"' . (($selected == $key) ? ' selected="selected"' : '') . '>' . $value . '</option>';
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
