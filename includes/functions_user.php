<?php
/******************************************************/
function get_user($id)
{
	if ($id == NULL)
	{
		return array();
	}
	$id = escape($id);
    $sql = "SELECT * from user WHERE id = $id";
    $ret = query_row($sql);
	if (count($ret) > 0)
	{
		$ret['nationality'] = get_country_name($ret['nationality_code'], get_language());
		$ret['age'] = get_age($ret['birthday']);
		$ret['country'] = get_country_name($ret['country_code'], get_language());
        if ($ret['image'] == '')
            $ret['image'] = 'img/boss.png';
	}
	return $ret;
}

function get_user_data($id)
{
	$user = get_user($id);
	if (count($user) > 0)
	{
		unset($user['password']);
		unset($user['password_reset_key']);
		unset($user['password_reset_time']);
	}
	return $user;
}

function get_board_users()
{
    $sql = "SELECT * from user WHERE board_role > 1 ORDER BY board_role , first_name, last_name";
    $ret = query_array($sql);
    return $ret;

}


function get_user_base($id)
{
	if ($id == NULL)
	{
		return array();
	}
	$id = escape($id);
    $sql = "SELECT id, last_name, first_name, birthday, nationality_code, user from user WHERE id = $id";
    $ret = query_row($sql);
	if (count($ret) > 0)
	{
		$ret['nationality'] = get_country_name($ret['nationality_code'], get_language());
		$ret['age'] = get_age($ret['birthday']);
	}
	return $ret;
}
function get_user_by_email($email)
{
    $email = trim(escape($email));
    if ($email == '')
    {
        return array();
    }
    $sql = "SELECT * from user WHERE LOWER(email) = LOWER('$email')";
    return query_row($sql);
}

function get_users_by_name($first_name, $last_name)
{
	$first_name = escape($first_name);
	$last_name = escape($last_name);
    $sql = "SELECT * from user WHERE last_name = '$last_name' AND first_name = '$first_name'";
    return query_array($sql);
}

function get_user_by_data($first_name, $last_name, $birthday, $nationality_code)
{
	$first_name = escape($first_name);
	$last_name = escape($last_name);
	$birthday = escape($birthday);
	$nationality_code = escape($nationality_code);
    $sql = "SELECT * from user WHERE (last_name = '$last_name' AND first_name = '$first_name') AND birthday = '$birthday' AND nationality_code = '$nationality_code'";
    return query_row($sql);
}


function get_user_id_by_data($first_name, $last_name, $birthday, $nationality_code)
{
	$user = get_user_by_data($first_name, $last_name, $birthday, $nationality_code);
	if (count($user) > 0)
	{
		return $user['id'];
	}
	return 0;
}
function get_user_name($id)
{
	$user = get_user($id);
	if ($user)
		return $user['first_name'] . ' ' . $user['last_name'];
    return '';
}
function get_user_email($id)
{
	$user = get_user($id);
	if ($user)
		return $user['email'];
    return '';
}

function get_user_phone($id)
{
    $user = get_user($id);
    if ($user)
        return $user['phone'];
    return '';
}

function get_user_status($id)
{
	$user = get_user($id);
	if ($user)
		return $user['status'];
    return 0;
}

function get_user_nationality_code($id)
{
    $user = get_user($id);
    if ($user)
        return $user['nationality_code'];
    return '';
}

function is_user_admin($id)
{
	$user = get_user($id);
	if ($user) 
		return $user['administrator'];
    return false;
}

function is_user_board_user($id)
{
	$user = get_user($id);
	if ($user)
		return $user['board_role'] > GLB_USER_BOARD_ROLE_NO_MEMBER;
    return false;
}

function update_user($user)
{
    $id = escape($user['id']);
    $first_name = escape($user['first_name']);
    $last_name = escape($user['last_name']);
    $email = escape($user['email']);
    $status = escape($user['status']);
    $phone = escape($user['phone']);
    $birthday = escape($user['birthday']);
    $nationality_code = escape($user['nationality_code']);
    $street = escape($user['street']);
    $house_number = escape($user['house_number']);
    $zip = escape($user['zip']);
    $town = escape($user['town']);
    $country_code = escape($user['country_code']);
    $administrator = escape($user['administrator']);
    $board_role = escape($user['board_role']);
    $wjpf_email = escape($user['wjpf_email']);
    $passport_number = escape($user['passport_number'] ?? '');
    $image = escape($user['image']);

    $sql = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', status='$status', phone='$phone', birthday='$birthday', nationality_code='$nationality_code',
    street='$street', house_number='$house_number', zip='$zip', town='$town', country_code='$country_code', administrator='$administrator', board_role='$board_role',
    wjpf_email='$wjpf_email', passport_number='$passport_number', image='$image'WHERE id='$id'";
//    echo $sql;
    query($sql);
}

function create_user($user)
{
    $first_name = escape($user['first_name']);
    $last_name = escape($user['last_name']);
    $email = escape($user['email']);
    $status = escape($user['status']);
    $phone = escape($user['phone']);
    $birthday = escape($user['birthday']);
    $nationality_code = escape($user['nationality_code']);
    $street = escape($user['street']);
    $house_number = escape($user['house_number']);
    $zip = escape($user['zip']);
    $town = escape($user['town']);
    $country_code = escape($user['country_code']);
    $administrator = escape($user['administrator']);
    $board_role = escape($user['board_role']);
    $wjpf_email = escape($user['wjpf_email']);
    $passport_number = escape($user['passport_number'] ?? '');
    $image = escape($user['image']);
	if ($status == GLB_USER_STATUS_NEW)
	{
		$password_reset_key = create_request_key();
	}
	else
	{
		$password_reset_key = '';
	}

    $sql = "INSERT INTO user(first_name, last_name, email, status, phone, birthday, nationality_code, street, house_number, zip,
	town, country_code, administrator, board_role, password_reset_key, wjpf_email, passport_number, image) VALUES
	('$first_name', '$last_name', '$email', '$status', '$phone', '$birthday', '$nationality_code', '$street', '$house_number', '$zip',
	'$town', '$country_code', '$administrator', '$board_role', '$password_reset_key', '$wjpf_email', '$passport_number', '$image')";
    query($sql);
	$id = sql_insert_id();
	
	if (isset($user['password']) && trim($user['password']) != '')
	{
        $password = password_hash(escape($user['password']), PASSWORD_BCRYPT, array('cost'=>12));
		$sql = "UPDATE user SET password='$password', password_reset_time=''  WHERE id='$id'";
		query($sql);  
	}

/*	if ($status == 1)
	{
    	return send_user_confirmation_mail($id, $first_name . ' ' . $last_name, $email, $password_reset_key);
	}*/
    return $id;
}
function allow_user_delete($id)
{
    return true;
}


function delete_user($id)
{
    sql_begin();
    try
    {
		$user = get_user($id);
		$sql = "DELETE FROM user WHERE id ='".escape($id)."'";
        query($sql);
        if ($user['image'] != '')
            unlink_image($user['image']);
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

function reset_user_password($id, $key, $time)
{
	$id = escape($id);
	$key = escape($key);
	$time = escape($time);
    $sql = "UPDATE user SET password_reset_key='$key', password_reset_time='$time' WHERE id='$id'";
    query($sql);  
}

function set_user_password($id, $password)
{
	$id = escape($id);
	$password = escape($password);
    $sql = "UPDATE user SET password='$password', password_reset_key='', password_reset_time=''  WHERE id='$id'";
    query($sql);  
}

function set_user_status($id, $status)
{
	$id = escape($id);
	$status = escape($status);
	if ($status == GLB_USER_STATUS_INACTIVE)
	{
		$sql = "UPDATE user SET status='3', user='0' WHERE id='$id'";
	}
	else
	{
		$sql = "UPDATE user SET status='$status' WHERE id='$id'";
	}
    query($sql);  
}

function set_user_last_login($id)
{
	$id = escape($id);
	$last_login = date('Y-m-d H:i:s');
    $sql = "UPDATE user SET last_login='$last_login'  WHERE id='$id'";
    query($sql);  
}

function   display_board_users()
{
    global $glb_board_role;

    $board_users = array();

    $board_users = get_board_users();
    foreach ($board_users as $board_user)
    {
//            print_r($board_user);
        echo '<div class="user-tile user-tile_frame">';
        echo '<div class="row user_frame">';
        echo '<div class="col-12 user_frame_image d-flex  align-items-center justify-content-center">';
        if ($board_user['image'] != '')
            echo '<img class="association_img" src="' . $board_user['image'] . '">';
        else
            echo '<img class="association_img" src="img/boss.png">';
        echo '</div>';
        echo '<div class="col-12 user_frame_name d-flex justify-content-center">';
        echo '<b>' . $board_user['first_name'] . ' ' . $board_user['last_name'] . '</b>';
        echo '</div>';
        echo '<div class="col-12 user_frame_name d-flex justify-content-center">';
        echo '<b>' . $glb_board_role[$board_user['board_role']] . '</b>';
        echo '</div>';
        echo '<div class="col-12 user_frame_name d-flex justify-content-center">';
        echo '<img class="country_flag mt-1" src="img/flags/' . $board_user['nationality_code'] . '.png" title="' . get_country_name($board_user['nationality_code'], 'en') . '">';
        if ($board_user['wjpf_email'] != '')
            echo '<a href="mailto:' . $board_user['wjpf_email'] . '"><img src="img/mail_blue.png" class="mail_image"></a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

/*
 function send_user_confirmation_mail($id, $name, $email, $password_reset_key)
{
	$url = get_page_url('confirm_usership.php'). '?email=' . urlencode($email) . '&request_key=' . $password_reset_key;

	$subject = "Mitgliedsantrag bestätigen";
	$note = 'Hallo ' . $name . ',<br><br>';
	$note .= 'wir haben deinen Mitgliedsantrag erhalten. Damit wir wissen, dass dir die E-Mail-Adresse gehört, bestätige diese bitte, indem du auf den Link klickst.<br><br>';
	$note .= 'Mitgliedsantrag bestätigen: <a href="' . $url . '">' . $url . '</a><br><br>';
	$note .= 'Wir freuen uns auf dich,<br><br>Dein Puzzleverein Deutschland e.V.';
	$error = send_html_mail($email, $subject, $note, array(), FALSE, FALSE);
	
	if ($error != '')
	{
		return 'Dein Mitgliedsantrag wurde gespeichert. Leider gab es ein Problem beim Verschicken der Bestätigungsmail. Wir werden dich entsprechend kontaktieren.';
	}                      
	return '';
}

function send_registration_confirmation_mail($id, $name, $email, $password_reset_key, $lang)
{
	$url = get_page_url('confirm_participant.php'). '?email=' . urlencode($email) . '&request_key=' . $password_reset_key;

	$subject = translate_by_shortcut ('TEILNEHMERBESTAETIGEN', $lang);
	$note = translate_by_shortcut ('HALLO', $lang) . ' ' . $name . ',<br><br>';
	$note .= translate_by_shortcut ('TEILNEHMERBESTAETIGEN_1', $lang). ': <a href="' . $url . '">' . translate_by_shortcut ('TEILNEHMERBESTAETIGEN', $lang) . '</a><br><br>';
	$note .= translate_by_shortcut ('MAILGRUSS', $lang) . ',<br><br>Puzzleverein Deutschland e.V.';
	$error = send_html_mail($email, $subject, $note, array(), FALSE, FALSE);
	
	if ($error != '')
	{
		return translate_by_shortcut ('FEHLERBESTAETIGUNGSMAIL', $lang);
	}                      
	return '';
}

function new_user_mail($user)
{
    $settings = get_settings();
	$to_mail = $settings['email_board'];

	$url = get_page_url('mitglieder.php');
				
	$subject = "Neuer Mitgliedsantrag eingegangen";
	$note = 'Hallo Vorstand,<br><br>';
	$note .= 'es wurde ein neuer Mitgliedsantrag von ' . $user['first_name'] . ' ' . $user['last_name'] . ' eingereicht. Dieser muss noch bestätigt werden.<br><br>';
	$note .= 'Mitgliedsantrag bestätigen unter: <a href="' . $url . '">' . $url . '</a><br><br>';
	$note .= 'Kommentar: ' .  $user['comment'] . '<br><br>';
	$error = send_html_mail($to_mail, $subject, $note, array(), FALSE, FALSE);
	return $error;
}*/

function validate_user_login()
{
    if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == 'POST')
    {
        $user_name          = decode(filter_input(INPUT_POST, "user_name"));
        $password           = decode(filter_input(INPUT_POST, "password"));
        $link_to            = decode(filter_input(INPUT_POST, "link_to"));

        $user = get_user_by_email($user_name);
        if (count($user) > 0 && password_verify($password, $user['password']) && ($user['status'] == GLB_USER_STATUS_ACTIVE || $user['status'] == GLB_USER_STATUS_CONFIRMATION))
        {
            set_user_last_login($user['id']);
            $_SESSION['user'] = $user['id'];
            if (!isset($link_to) || $link_to == '')
            {
                $link_to = 'index.php';
            }
            redirect($link_to);
        }
        else
        {
            echo '<div class="alert alert-danger text-center" role="alert">Invalid login. Please check your email address and password.</div>';
        }
    }
}

function recover_password()
{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST")
    {
        if (isset($_SESSION['token']) && decode(filter_input(INPUT_POST, 'token')) === $_SESSION['token'])
        {
            $email = decode(filter_input(INPUT_POST, 'email'));
            $user_activation = decode(filter_input(INPUT_POST, 'user_activation'));
            $user = get_user_by_email($email);
            if (count($user) > 0)
            {
                $request_key = create_request_key();
                $password_request_time = date("Y-m-d H:i:s");
                reset_user_password($user['id'], $request_key, $password_request_time);
                if ($user_activation)
                {
                    $url = get_page_url('activate_user.php'). '?email=' . urlencode($email) . '&request_key=' . $request_key;

                    $subject = "Activate user access";
                    $note = 'Hello,<br><br>';
                    $note .= 'We have received your request to activate your user access. Please click on the link below. The link is only valid for one hour!<br><br>';
                    $note .= 'Activate user access: <a href="' . $url . '">' . $url . '</a><br><br>';
                    $note .= 'With best regards,<br><br>YOUR World Jigsaw Puzzle Federation';
                    $error = send_html_mail($email, $subject, $note, array(), FALSE, FALSE);
                }
                else
                {
                    $url = get_page_url('resetpassword.php'). '?email=' . urlencode($email) . '&request_key=' . $request_key;

                    $subject = "Reset password";
                    $note = 'Hello,<br><br>';
                    $note .= 'We have received your request to reset your password. If you wish to proceed with the reset, please click on the link below. The link is only valid for one hour!<br><br>';
                    $note .= 'Reset password: <a href="' . $url . '">' . $url . '</a><br><br>';
                    $note .= 'With best regards,<br><br>Your<br><br> World Jigsaw Puzzle Federation';
                    $error = send_html_mail($email, $subject, $note, array(), FALSE, FALSE);
                }
                if ($error == '')
                {
                    if ($user_activation)
                        set_message('<div class="alert alert-success" role="alert" text-center>Your user account has been activated and an email has been sent to you to reset your password.</div>');
                    else
                        set_message('<div class="alert alert-success" role="alert" text-center>Your password has been reset and a password reset email has been sent to you.</div>');
                    redirect("login.php");
                    exit();
                }
                else
                {
                    echo '<div class="alert alert-danger text-center" role="alert">The email could not be sent.<br>Error: ' . $error . '</div>';
                }
            }
            else
            {
                if ($user_activation)
                    echo '<div class="alert alert-danger text-center" role="alert">We were unable to activate your usership access.</div>';
                else
                    echo '<div class="alert alert-danger text-center" role="alert">The user could not be reset.</div>';
            }
        }
        else
        {
            redirect("login.php");
        }
    }

}

function logged_in()
{
    if (isset($_SESSION['user']) && $_SESSION['user'] > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function logout_user()
{
    unset ($_SESSION['user']);
}

function user_is_admin()
{
    return is_user_admin(get_login_user_id());
}

function user_is_board_user()
{
    return is_user_board_user(get_login_user_id());
}

function get_login_user_id()
{
    if (isset($_SESSION['user']))
    {
        return $_SESSION['user'];
    }
    return 0;
}

function get_current_user_data()
{
    return get_user(get_login_user_id());
}

function get_current_user_name()
{
    $user = get_current_user_data();
    if ($user)
    {
        return $user['first_name'] . ' ' . $user['last_name'];
    }
    return '';
}
function CheckLogin() // checks if a user or a participant is logged in otherwise redirects to login
{
    if (logged_in())
    {
        $_SESSION['link_to'] = '';
    }
    else
    {
        $_SESSION['link_to'] = $_SERVER['REQUEST_URI'];
        redirect("login.php");
        exit;
    }
}

function CheckUserLogin() // checks if a user is logged in otherwise redirects to login
{
    if (logged_in())
    {
        $_SESSION['link_to'] = '';
    }
    else if (logged_in())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">You do not have permission to access this page!</div>');
        redirect("index.php");
        exit;
    }
    else
    {
        $_SESSION['link_to'] = $_SERVER['REQUEST_URI'];
        redirect("login.php");
        exit;
    }
}


function CheckBoardUserOrAdmin() // checks if a user is admin or redirects to index.php
{
    CheckUserLogin();
    if (!user_is_admin() and !user_is_board_user())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">You do not have permission to access this page!</div>');
        redirect("index.php");
        exit;
    }
}

function CheckBoardAdminOrAssociationAdmin() // admin, board user or association admin; otherwise redirect to index.php
{
    CheckUserLogin();
    if (!user_is_admin() and !user_is_board_user() and !user_is_association_admin())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">You do not have permission to access this page!</div>');
        redirect("index.php");
        exit;
    }
}

function check_request_key($email, $request_key)
{
    if (!isset($email) || !isset($request_key) || empty($email) || empty($request_key))  //empty email or request_key
    {
//		set_message('<div class="alert alert-danger text-center" role="alert">' . 'invalid_input' . '</div>');
        redirect("login.php");
        exit;
    }
    $user = get_user_by_email($email);
    if (count($user) == 0)  //unknown email
    {
//		set_message('<div class="alert alert-danger text-center" role="alert">' . 'reset_mail_not_exists' . '</div>');
        redirect("login.php");
        exit;
    }

    $url = get_page_url('passwordreset.php');

    if ($user['password_reset_key'] != $request_key) //request keys do not match
    {
        if ($user['password_reset_key'] == '')
        {
            return '<div class="alert alert-danger text-center" role="alert">The password has already been reset.<br><a href="' . $url .'"><p style="text-decoration: underline; text-align: center; color: #333333;">Reset again</p></a></div>';
        }
        return '<div class="alert alert-danger text-center" role="alert">The password reset request is invalid!<br><a href="' . $url .'"><p style="text-decoration: underline; text-align: center; color: #333333;">Reset again</p></a></div>';
    }
    $now = time();
    $target = strtotime($user['password_reset_time']);
    $diff = $now - $target;
    if ( $diff > 3600 ) //time expired
    {
        return '<div class="alert alert-danger text-center" role="alert">The time limit for resetting your password has expired.<br><a href="' . $url .'"><p style="text-decoration: underline; text-align: center; color: #333333;">Reset again</p></a></div>';
    }
    return '';
}

function password_reset($email, $request_key, $password, $token)
{
    if (!isset($email) || !isset($request_key) || !isset($password) || !isset($token) || empty($email) || empty($request_key) || empty($password) || empty($token))
    {
        return '<div class="alert alert-danger" role="alert" text-center>Invalid input</div>';
    }
    else
    {
        if (isset($_SESSION['token']) && $token === $_SESSION['token'])
        {
            $check_msg = check_request_key($email,$request_key);
            if ($check_msg != '')
            {
                return $check_msg;
            }
            $user = get_user_by_email($email);
            $password = password_hash(escape($password), PASSWORD_BCRYPT, array('cost'=>12));
            set_user_password($user['id'], $password);
        }
        else
        {
            return '<div class="alert alert-danger" role="alert" text-center>Invalid input</div>';
        }
    }
    return '';
}



