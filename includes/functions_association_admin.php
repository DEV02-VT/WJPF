<?php
/******************************************************/
function get_association_admins($association_id)
{
    $association_id = escape($association_id);
    $sql = "SELECT aa.id, aa.association_id, aa.user_id, aa.role, aa.contact_person,
                   u.first_name, u.last_name, u.email, u.phone, u.image,
                   u.nationality_code, u.birthday, u.status,
                   u.street, u.house_number, u.zip, u.town, u.country_code,
                   u.administrator, u.board_role, u.wjpf_email, u.passport_number
            FROM association_admin aa
            JOIN user u ON aa.user_id = u.id
            WHERE aa.association_id = $association_id
            ORDER BY u.last_name, u.first_name";
    $ret = query_array($sql);
    foreach ($ret as &$row) {
        if ($row['image'] == '')
            $row['image'] = 'img/boss.png';
    }
    return $ret;
}

function get_association_admin($id)
{
    if ($id == NULL) return array();
    $id = escape($id);
    $sql = "SELECT aa.id, aa.association_id, aa.user_id, aa.role, aa.contact_person,
                   u.first_name, u.last_name, u.email, u.phone, u.image,
                   u.nationality_code, u.birthday, u.status,
                   u.street, u.house_number, u.zip, u.town, u.country_code,
                   u.administrator, u.board_role, u.wjpf_email, u.passport_number
            FROM association_admin aa
            JOIN user u ON aa.user_id = u.id
            WHERE aa.id = $id";
    $ret = query_row($sql);
    if (!empty($ret) && $ret['image'] == '')
        $ret['image'] = 'img/boss.png';
    return $ret;
}

function find_association_admin_by_user($user_id, $association_id)
{
    $user_id = escape($user_id);
    $association_id = escape($association_id);
    $sql = "SELECT id FROM association_admin WHERE user_id = $user_id AND association_id = $association_id";
    return query_row($sql);
}

function create_association_admin($data)
{
    $association_id = escape($data['association_id']);
    $user_id        = escape($data['user_id']);
    $role           = escape($data['role']);
    $contact_person = escape($data['contact_person']);
    $sql = "INSERT INTO association_admin (association_id, user_id, role, contact_person)
            VALUES ('$association_id', '$user_id', '$role', '$contact_person')";
    query($sql);
    return sql_insert_id();
}

function update_association_admin($data)
{
    $id             = escape($data['id']);
    $role           = escape($data['role']);
    $contact_person = escape($data['contact_person']);
    $sql = "UPDATE association_admin SET role='$role', contact_person='$contact_person' WHERE id='$id'";
    query($sql);
}

function delete_association_admin($id)
{
    $id = escape($id);
    $sql = "DELETE FROM association_admin WHERE id='$id'";
    query($sql);
}

function get_association_ids_for_user($user_id)
{
    $user_id = escape($user_id);
    $sql = "SELECT association_id FROM association_admin WHERE user_id = $user_id";
    $rows = query_array($sql);
    $ids = array();
    foreach ($rows as $row) {
        $ids[] = (int)$row['association_id'];
    }
    return $ids;
}

function user_is_association_admin($user_id = null)
{
    if ($user_id === null) {
        $user_id = get_login_user_id();
    }
    if ($user_id == 0) {
        return false;
    }
    return count(get_association_ids_for_user($user_id)) > 0;
}

function user_can_edit_association($association_id): bool
{
    if (user_is_admin() || user_is_board_user()) {
        return true;
    }
    if ($association_id === null || $association_id === '') {
        return false;
    }
    return in_array((int)$association_id, get_association_ids_for_user(get_login_user_id()), true);
}

function set_contact_person($association_id, $admin_id)
{
    $association_id = escape($association_id);
    $admin_id       = escape($admin_id);
    $sql = "UPDATE association_admin SET contact_person=0 WHERE association_id='$association_id'";
    query($sql);
    $sql = "UPDATE association_admin SET contact_person=1 WHERE id='$admin_id'";
    query($sql);
}
