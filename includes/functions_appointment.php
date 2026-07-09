<?php

function get_appointment($id): bool|array|null
{
    if ($id == NULL) {
        return array();
    }
    $id = escape($id);
    $sql = "SELECT appointment.*, first_name, last_name from appointment left join user m on m.id = appointment.author_id WHERE appointment.id = $id";

    return query_row($sql);
}

function get_appointment_headline($id): string
{
    if ($id == NULL || $id == 0) {
        return '';
    }
	$appointment = get_appointment($id);
    if (count($appointment) > 0)
	{
		return $appointment['headline'];
	}
    return '';
}

function get_appointments(): array
{
	$today = date('Y-m-d');
    $sql = 'SELECT * from appointment where begin >= "' . $today . '" ORDER BY begin ASC';
    $apps = query_array($sql);
	usort($apps, "begin_cmp");
	return $apps;
}

function update_appointment(array $appointment): void
{
    $id = escape($appointment['id']);
    $headline = escape($appointment['headline']);
    $link = escape($appointment['link']);
    $place = escape($appointment['place']);
    $begin = escape($appointment['begin']);
    $end = escape($appointment['end']);
    $author_id = escape($appointment['author_id']);
    $association_id = escape($appointment['association_id']);
    $type = escape($appointment['type']);
    $street = escape($appointment['street']);
    $house_number = escape($appointment['house_number']);
    $zip = escape($appointment['zip']);
    $town = escape($appointment['town']);
    $country_code = escape($appointment['country_code']);
    $latitude = escape($appointment['latitude']);
    $longitude = escape($appointment['longitude']);

    $sql = "UPDATE appointment SET headline='$headline', link='$link', place='$place', begin='$begin', end='$end', author_id='$author_id', association_id='$association_id',
    type='$type',street='$street',house_number='$house_number',zip='$zip',town='$town',country_code='$country_code',latitude='$latitude', longitude='$longitude' WHERE id='$id'";
//    echo $sql;
    query($sql);
}

function create_appointment(array $appointment): string|int
{
    $headline = escape($appointment['headline']);
    $link = escape($appointment['link']);
    $place = escape($appointment['place']);
    $begin = escape($appointment['begin']);
    $end = escape($appointment['end']);
    $author_id = escape($appointment['author_id']);
    $association_id = escape($appointment['association_id']);
    $type = escape($appointment['type']);
    $street = escape($appointment['street']);
    $house_number = escape($appointment['house_number']);
    $zip = escape($appointment['zip']);
    $town = escape($appointment['town']);
    $country_code = escape($appointment['country_code']);
    $latitude = escape($appointment['latitude']);
    $longitude = escape($appointment['longitude']);

    $sql = "INSERT INTO appointment(headline, link, place, begin, end, author_id, association_id, type, street, house_number, zip, town, country_code, latitude, longitude) VALUES
	('$headline', '$link', '$place', '$begin', '$end', '$author_id', '$association_id', '$type', '$street', '$house_number', '$zip', '$town', '$country_code', '$latitude', '$longitude')";
    query($sql);  
	$id = sql_insert_id();
    return $id;
}

function delete_appointment(int $id) : string
{
    sql_begin();
    try
    {
		$appointment = get_appointment($id);
		$sql = "DELETE FROM appointment WHERE id ='".escape($id)."'";
        query($sql);
        sql_commit();
    }
    catch(Exception $e)
    {
        $error =  $e->getMessage();  
        sql_rollback();
        return $error;
    }
    return '';
}


function get_appointment_associations_for_current_user(): array
{
    if (user_is_admin() || user_is_board_user()) {
        return get_all_associations();
    }
    $ids = get_association_ids_for_user(get_login_user_id());
    if (count($ids) == 0) {
        return array();
    }
    $in = implode(',', array_map('intval', $ids));
    $sql = "SELECT id, name from association WHERE id IN ($in) ORDER BY name";
    return query_array($sql);
}

function user_can_manage_appointment_association($association_id): bool
{
    if (user_is_admin() || user_is_board_user()) {
        return true;
    }
    if ($association_id === null || $association_id === '') {
        return false;
    }
    $ids = get_association_ids_for_user(get_login_user_id());
    return in_array((int)$association_id, $ids, true);
}

function display_future_appointments()
{
    $ret = '';
    $appointments = get_appointments();
    usort($appointments, "begin_cmp");
    $month = '';
    $url = get_page_url('event.php');
    foreach ($appointments as $appointment)
    {
        $begin = strtotime($appointment['begin']);
        if ($month != date('m.Y', $begin))
        {
            if ($month != '')
            {
                $ret .= '</div></div></div>';
            }
            $ret .= '<div class="row text-start justify-content-start">';
            $month = date('m.Y', $begin);
            $ret .= '<div class="col-1 d-flex appointment-title text-end justify-content-end "><span style="align-self: flex-end;">' . get_german_month(date('n', $begin)) . '</span></div>';
            $ret .= '<div class="col-11">';
            $ret .= '<div class="d-flex justify-content-start appointment_line_container">';
        }

        if (isset($appointment['headline']))
        {
            $ret .=	'<div class="appointment">';
            $ret .= '<a href="' . $appointment['link'] . '" target="_blank"><div class="appointment-inner trophy"><img src="img/trophy.png">';
            $ret .= '<div class="date">' . date('d.m.Y', $begin);
            if ($appointment['end'] && $appointment['end'] > $appointment['begin'])
            {
                $ret .= ' -<br>' . date('d.m.Y', strtotime($appointment['end']));
            }
            $ret .=	'</div>';
            if (isset($appointment['country_code']) && $appointment['country_code'] != '')
                $ret .=	show_country_icon($appointment['country_code'], 'en', $class = '', $style = '');
            $ret .= '<span class= "headline secondary">' . $appointment['headline'] . '</span>';
            $ret .= '<br>' . $appointment['place'];
            $ret .= '</div></a>';
            $ret .=	'</div>';
        }
        else
        {
            $ret .=	'<div class="appointment">';

            $ret .= '<a href="' . $url . '?id=' . $appointment['id'] . '" target="_blank"><div class="appointment-inner trophy"><img src="img/trophy.png">';
            $ret .= '<div class="date">' . date('d.m.Y', $begin);
            if ($appointment['end'] && $appointment['end'] > $appointment['begin'])
            {
                $ret .= ' -<br>' . date('d.m.Y', strtotime($appointment['end']));
            }
            $ret .=	'</div>';
            $ret .= '<span class= "headline secondary">' . translate_by_id($appointment['title_txt']) . '</span>';
            $ret .= '<br>';
            $ret .=	$appointment['loc_town'];
            $ret .= '</div></a>';
            $ret .=	'</div>';
        }
    }
    if ($month != '')
    {
        $ret .= '</div></div></div>';
    }
    return $ret;
}

function get_appointment_coordinates()
{
    $appointments = get_appointments();
    $szRet = '<script>let appointment_coordinates = [';
    $first = true;
    $url = get_page_url('event.php');
    foreach ($appointments as $appointment)
    {
        if (!isset($appointment['headline']))
        {
            if (isset($appointment['loc_longitude']) && $appointment['loc_longitude'] != '' && isset($appointment['loc_latitude']) && $appointment['loc_latitude'] != '')
            {
                if (!$first)
                {
                    $szRet .= ',';
                }
                $szRet .= '{lon: "' . $appointment['loc_longitude'] . '", lat: "' . $appointment['loc_latitude'] . '", name: "' . strip_tags(translate_by_id($appointment['title_txt'])) . '", url: "' . $url . '?id=' . $appointment['id'] . '"}';
                $first = false;
            }
        }
        else if (isset($appointment['longitude']) && $appointment['longitude'] != '' && isset($appointment['latitude']) && $appointment['latitude'] != '')
        {
            if (!$first)
            {
                $szRet .= ',';
            }
            $szRet .= '{lon: "' . $appointment['longitude'] . '", lat: "' . $appointment['latitude'] . '", name: "' . $appointment['headline'] . '", url: "' . $appointment['link'] . '"}';
            $first = false;
        }

    }
    $szRet .= '];</script>';
    return $szRet;
}

