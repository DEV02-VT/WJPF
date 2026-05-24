<?php
/******************************************************/
function get_association($id)
{
	if ($id == NULL)
	{
		return array();
	}
	$id = escape($id);
    $sql = "SELECT * from association WHERE id = $id";
    $ret = query_row($sql);
	if (count($ret) > 0)
	{
		$ret['country'] = get_country_name($ret['country_code'], get_language());
        if ($ret['image'] == '')
            $ret['image'] = 'img/boss.png';
	}
	return $ret;
}


function get_federation_associations()
{
    $sql = "SELECT * from association WHERE member = 1 ORDER BY nationality_code";
    $ret = query_array($sql);
    return $ret;

}
function get_association_by_email($email)
{
    $email = trim(escape($email));
    if ($email == '')
    {
        return array();
    }
    $sql = "SELECT * from association WHERE LOWER(email) = LOWER('$email')";
    return query_row($sql);
}

function get_associations_by_name($name)
{
    $name = escape($name);
    $sql = "SELECT * from association WHERE name = '$name'";
    return query_array($sql);
}

function get_association_name($id)
{
	$association = get_association($id);
	if ($association)
		return $association['name'];
    return '';
}
function get_association_email($id)
{
	$association = get_association($id);
	if ($association)
		return $association['email'];
    return '';
}

function get_association_phone($id)
{
    $association = get_association($id);
    if ($association)
        return $association['phone'];
    return '';
}

function get_member_associations_emails()
{
    $sql = "SELECT email from association WHERE type = '" . GLB_ASSOCIATION_TYPE_NATIONAL_ASSOCIATION . "' AND member = 1 AND email != '' order by email";
    $ret = query_array($sql);
    $mails = [];
    foreach ($ret as $member)
    {
        $email = trim($member['email']);
        if ($email != '')
        {
            $mails[] = $email;
        }
    }
    return implode(';', $mails);
}

function get_non_member_associations_emails()
{
    $sql = "SELECT email from association WHERE  type = '" . GLB_ASSOCIATION_TYPE_NATIONAL_ASSOCIATION . "' AND member = 0 AND email != '' order by email";
    $ret = query_array($sql);
    $mails = [];
    foreach ($ret as $member)
    {
        $email = trim($member['email']);
        if ($email != '')
        {
            $mails[] = $email;
        }
    }
    return implode(';', $mails);
}

function get_all_associations_emails()
{
    $sql = "SELECT email from association WHERE  type = '" . GLB_ASSOCIATION_TYPE_NATIONAL_ASSOCIATION . "' AND email != '' order by email";
    $ret = query_array($sql);
    $mails = [];
    foreach ($ret as $member)
    {
        $email = trim($member['email']);
        if ($email != '')
        {
            $mails[] = $email;
        }
    }
    return implode(';', $mails);
}

function update_association($association)
{
    $id = escape($association['id']);
    $type = escape($association['type']);
    $name = escape($association['name']);
    $registration_number = escape($association['registration_number']);
    $foundation_date = escape($association['foundation_date']);
    $tax_id = escape($association['tax_id']);
    $nationality_code = escape($association['nationality_code']);
    $member_count = escape($association['member_count']);
    $street = escape($association['street']);
    $house_number = escape($association['house_number']);
    $zip = escape($association['zip']);
    $town = escape($association['town']);
    $country_code = escape($association['country_code']);
    $website = escape($association['website']);
    $email = escape($association['email']);
    $phone = escape($association['phone']);
    $begin_of_membership = escape($association['begin_of_membership']);
    $end_of_membership = escape($association['end_of_membership']);
    $comment = escape($association['comment']);
    $member = escape($association['member']);
    $image = escape($association['image']);

    $sql = "UPDATE association SET type='$type', name='$name', registration_number='$registration_number', foundation_date='$foundation_date', tax_id='$tax_id', nationality_code='$nationality_code', member_count='$member_count', 
    street='$street', house_number='$house_number', zip='$zip', town='$town', country_code='$country_code', website='$website', email='$email', phone='$phone', begin_of_membership='$begin_of_membership', end_of_membership='$end_of_membership', 
    comment='$comment', member='$member', image='$image'WHERE id='$id'";
//    echo $sql;
    query($sql);
}

function create_association($association)
{
    $type = escape($association['type']);
    $name = escape($association['name']);
    $registration_number = escape($association['registration_number']);
    $foundation_date = escape($association['foundation_date']);
    $tax_id = escape($association['tax_id']);
    $nationality_code = escape($association['nationality_code']);
    $member_count = escape($association['member_count']);
    $street = escape($association['street']);
    $house_number = escape($association['house_number']);
    $zip = escape($association['zip']);
    $town = escape($association['town']);
    $country_code = escape($association['country_code']);
    $website = escape($association['website']);
    $email = escape($association['email']);
    $phone = escape($association['phone']);
    $begin_of_membership = escape($association['begin_of_membership']);
    $end_of_membership = escape($association['end_of_membership']);
    $comment = escape($association['comment']);
    $member = escape($association['member']);
    $image = escape($association['image']);

    $sql = "INSERT INTO association(type, name, registration_number, foundation_date, tax_id, nationality_code, member_count, street, house_number, zip,
	town, country_code, website, email, phone, begin_of_membership, end_of_membership, comment, member, image) VALUES 
	('$type', '$name', '$registration_number', '$foundation_date', '$tax_id', '$nationality_code', '$member_count', '$street', '$house_number', '$zip',
	'$town', '$country_code','$website', '$email', '$phone', '$begin_of_membership', '$end_of_membership', '$comment', '$member', '$image')";
    query($sql);
	$id = sql_insert_id();
	$association['id'] = $id;
    return $id;
}
function allow_association_delete($id)
{
    return true;
}


function delete_association($id)
{
    sql_begin();
    try
    {
		$association = get_association($id);
		$sql = "DELETE FROM association WHERE id ='".escape($id)."'";
        query($sql);
        sql_commit();
        if ($association['image'] != '')
            unlink_image($association['image']);
    }
    catch(Exception $e)
    {
        $error =  $e->getMessage();  
        sql_rollback();
        return $error;
    }
    return '';
}

function   display_federation_associations()
{
    global $glb_board_role;

    $member_associations = get_federation_associations();
    foreach ($member_associations as $member_association)
    {
//            print_r($board_association);
        echo '<div class="user-tile user-tile_frame">';
        echo '<div class="row user_frame">';
        echo '<a href="' . $member_association['website'] . '" target="_blank" class="d-block text-decoration-none">';
        echo '<div class="col-12 user_frame_image d-flex  align-items-center justify-content-center">';
        if ($member_association['image'] != '')
            echo '<img class="association_img" src="' . $member_association['image'] . '">';
        echo '</div>';
        echo '<div class="col-12 association_frame_name d-flex justify-content-center">';
        echo '<b>' . $member_association['name'] . '</b>';
        echo '</div>';
        echo '<div class="col-12 user_frame_name d-flex justify-content-center">';
        echo '<img class="country_flag" src="img/flags/' . $member_association['nationality_code'] . '.png"> <b>' . get_country_name($member_association['nationality_code'], 'en') . '</b>';
        echo '</div>';
        echo '</a>';
        $links_html = get_association_links_html($member_association['id']);
        if ($links_html != '') {
            echo '<div class="col-12 d-flex justify-content-center gap-2 mt-2">' . $links_html . '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
}
