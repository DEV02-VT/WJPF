<?php

function get_news($id): bool|array|null
{
    if ($id == NULL) {
        return array();
    }
    $id = escape($id);
    $sql = "SELECT news.*, first_name, last_name FROM news LEFT JOIN user ON user.id = news.author_id WHERE news.id = $id";
    return query_row($sql);
}

function get_published_news(int $limit = 5): array
{
    $status = GLB_NEWS_STATUS_PUBLISHED;
    $limit_clause = $limit > 0 ? 'LIMIT ' . $limit : '';
    $sql = "SELECT news.*, first_name, last_name FROM news LEFT JOIN user ON user.id = news.author_id WHERE news.status = $status ORDER BY news_date DESC $limit_clause";
    return query_array($sql);
}

function create_news(array $news): void
{
    $title      = escape($news['title']);
    $content    = escape($news['content']);
    $news_date  = escape($news['news_date']);
    $status     = escape($news['status']);
    $author_id  = escape($news['author_id']);
    $news_date_val = $news_date != '' ? "'$news_date'" : 'NULL';
    $sql = "INSERT INTO news (title, content, news_date, status, author_id, created_at, updated_at) VALUES ('$title', '$content', $news_date_val, '$status', '$author_id', NOW(), NOW())";
    query($sql);
}

function update_news(array $news): void
{
    $id         = escape($news['id']);
    $title      = escape($news['title']);
    $content    = escape($news['content']);
    $news_date  = escape($news['news_date']);
    $status     = escape($news['status']);
    $author_id  = escape($news['author_id']);
    $news_date_val = $news_date != '' ? "'$news_date'" : 'NULL';
    $sql = "UPDATE news SET title='$title', content='$content', news_date=$news_date_val, status='$status', author_id='$author_id', updated_at=NOW() WHERE id='$id'";
    query($sql);
}

function delete_news($id): void
{
    $id = escape($id);
    $sql = "DELETE FROM news WHERE id='$id'";
    query($sql);
}
