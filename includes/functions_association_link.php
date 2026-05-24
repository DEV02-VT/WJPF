<?php

function get_association_links($association_id)
{
    $association_id = escape($association_id);
    $sql = "SELECT id, association_id, link_type, url
            FROM association_link
            WHERE association_id = $association_id
            ORDER BY link_type";
    return query_array($sql);
}

function get_association_link($id)
{
    if ($id == NULL) return array();
    $id = escape($id);
    $sql = "SELECT id, association_id, link_type, url
            FROM association_link
            WHERE id = $id";
    return query_row($sql);
}

function create_association_link($data)
{
    $association_id = escape($data['association_id']);
    $link_type      = escape($data['link_type']);
    $url            = escape($data['url']);
    $sql = "INSERT INTO association_link (association_id, link_type, url)
            VALUES ('$association_id', '$link_type', '$url')";
    query($sql);
    return sql_insert_id();
}

function update_association_link($data)
{
    $id        = escape($data['id']);
    $link_type = escape($data['link_type']);
    $url       = escape($data['url']);
    $sql = "UPDATE association_link SET link_type='$link_type', url='$url' WHERE id='$id'";
    query($sql);
}

function delete_association_link($id)
{
    $id = escape($id);
    $sql = "DELETE FROM association_link WHERE id='$id'";
    query($sql);
}

function get_link_icon_html($link_type, $url)
{
    $icons = [
        GLB_ASSOCIATION_LINK_TYPE_WEB       => 'bi-globe',
        GLB_ASSOCIATION_LINK_TYPE_DISCORD   => 'bi-discord',
        GLB_ASSOCIATION_LINK_TYPE_INSTAGRAM => 'bi-instagram',
        GLB_ASSOCIATION_LINK_TYPE_FACEBOOK  => 'bi-facebook',
        GLB_ASSOCIATION_LINK_TYPE_TWITTER   => 'bi-twitter-x',
        GLB_ASSOCIATION_LINK_TYPE_TIKTOK    => 'bi-tiktok',
        GLB_ASSOCIATION_LINK_TYPE_YOUTUBE   => 'bi-youtube',
    ];
    $icon = isset($icons[$link_type]) ? $icons[$link_type] : 'bi-link-45deg';
    $url_safe = htmlspecialchars($url, ENT_QUOTES);
    return '<a href="' . $url_safe . '" target="_blank" title="' . $url_safe . '"><i class="bi ' . $icon . ' fs-5"></i></a>';
}

function get_association_links_html($association_id)
{
    $links = get_association_links($association_id);
    if (empty($links)) return '';
    $html = '<span class="association-links">';
    foreach ($links as $link) {
        $html .= get_link_icon_html($link['link_type'], $link['url']) . ' ';
    }
    $html .= '</span>';
    return $html;
}
