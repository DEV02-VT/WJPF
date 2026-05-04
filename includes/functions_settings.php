<?php

function get_settings()
{
    $sql = "SELECT * from settings WHERE id = 0";
    $res = query_row($sql);
    if (count($res) == 0)
	{
		$res['id'] = 0;
		$res['smtp_host'] = '';
		$res['smtp_port'] = 465;
		$res['smtp_user'] = '';
		$res['smtp_mail'] = '';
		$res['smtp_password'] = '';
		$res['smtp_transport'] = 'ssl';
		$res['smtp_sender'] = '';
		$res['club_name'] = '';
		$res['fee_normal'] = 0;
		$res['fee_reduced'] = 0;
		$res['email_board'] = '';
		$res['email_webteam'] = '';
		$res['email_forum'] = '';
		$res['account_bank'] = '';
		$res['account_iban'] = '';
		$res['account_bic'] = '';
		$res['country_code'] = 'DE';
        $res['last_check_date'] = '0000-00-00';
	}
	return $res;
}


function get_posted_settings_data()
{
    $old_settings = get_settings();
    $settings= array();
	$settings["smtp_host"]         = decode(check_empty(filter_input(INPUT_POST, "smtp_host"), $old_settings["smtp_host"]));
	$settings["smtp_port"]         = decode(check_empty(filter_input(INPUT_POST, "smtp_port"), $old_settings["smtp_port"]));
	$settings["smtp_user"]         = decode(check_empty(filter_input(INPUT_POST, "smtp_user"), $old_settings["smtp_user"]));
	$settings["smtp_mail"]         = decode(check_empty(filter_input(INPUT_POST, "smtp_mail"), $old_settings["smtp_mail"]));
	$settings["smtp_password"]     = decode(check_empty(filter_input(INPUT_POST, "smtp_password"), $old_settings["smtp_password"]));
	$settings["smtp_transport"]    = decode(check_empty(filter_input(INPUT_POST, "smtp_transport"), $old_settings["smtp_transport"]));
	$settings["smtp_sender"]       = decode(check_empty(filter_input(INPUT_POST, "smtp_sender"), $old_settings["smtp_sender"]));
    return $settings;
}


function validate_settings_data($settings)
{
    $errors = [];
    $max = 255;
    
    if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == 'POST')
    {
        if (!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
        }
        else
        {
			if (update_settings($settings))
			{
				redirect("admin_settings.php");
			}
			else
			{
				echo '<div class="alert alert-danger" role="alert">Error saving settings</div>';
			}
        }
    }
}

function update_smtp_settings($settings)
{
    $smtp_host = escape($settings['smtp_host']);
    $smtp_port = escape($settings['smtp_port']);
    $smtp_user = escape($settings['smtp_user']);
    $smtp_mail = escape($settings['smtp_mail']);
    $smtp_password = escape($settings['smtp_password']);
    $smtp_transport = escape($settings['smtp_transport']);
    $smtp_sender = escape($settings['smtp_sender']);

   $sql = "UPDATE settings SET smtp_host='$smtp_host', smtp_port='$smtp_port', smtp_user='$smtp_user' , smtp_mail='$smtp_mail' , smtp_password='$smtp_password' , smtp_transport='$smtp_transport' , smtp_sender='$smtp_sender' WHERE id=0";
//    echo $sql;
    query($sql);    
    return true;
}


function display_association_settings()
{
	$settings = get_settings();
	$ret = '<div class="col col-8">';
	$ret .= '<table><tbody>';
	$ret .= '<tr><td>Vereinsname:</td><td>' . $settings['club_name'] . '</td></tr>';
	$ret .= '<tr><td>Mitgliedsbeitrag:</td><td>' . $settings['fee_normal'] . '</td></tr>';
	$ret .= '<tr><td>Ermäßigter Mitgliedsbeitrag:</td><td>' . $settings['fee_reduced'] . '</td></tr>';
	$ret .= '</tbody></table>';
	return $ret;
}

function get_association_country_code()
{
	$settings = get_settings();
	return $settings['country_code'];
}

function get_settings_last_check_date()
{
    $settings = get_settings();
    return $settings['last_check_date'];
}

function set_settings_last_check_date()
{
    $today = date('Y-m-d');
    $sql = "UPDATE settings SET last_check_date='$today' WHERE id=0";
//    echo $sql;
    query($sql);
    return true;
}



