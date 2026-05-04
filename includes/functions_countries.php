<?php

function get_country($code): bool|array|null
{
    if ($code == NULL) {
        return array();
    }
    $code = escape($code);
    $sql = "SELECT * from countries WHERE code = '$code'";

    return query_row($sql);
}

function get_country_name($code, $language): string
{
    if ($code == NULL || $code == 0) {
        return '';
    }
	if ($language != 'en')
	{
		$language = 'de';
	}
	switch($code)
	{
		case 'BY':
		case 'RU':
			if ($language == 'en')
			{
				return 'Individual Neutral Athletes';
			}
			return 'Individuelle Neutrale Athleten';
	}
	$country = get_country($code);
    if (count($country) > 0)
	{
		return $country[$language];
	}
    return '';
}

function get_country_code($name, $language): string
{
    if ($name == NULL || $name == 0) {
        return '';
    }
	if ($language != 'en')
	{
		$language = 'de';
	}
	$name = escape($name);
	$language = escape($language);
    $sql = "SELECT * from countries WHERE name = '$name' AND language = '$language'";
    $country = query_row($sql);
    if (count($country) > 0)
	{
		return $country['code'];
	}
    return '';
}

function get_countries($language): array
{
	if ($language != 'en')
	{
		$language = 'de';
	}
	$language = escape($language);
    $sql = 'SELECT * from countries ORDER BY ' . $language;
    $countries = query_array($sql);
	$ret = array();
	foreach ($countries  as $key => $country)
	{
		$ret[$country['code']] = $country[$language];
	}
	return $ret;
}

function show_country_string_icons($country_string, $language, $class = '', $style = '')
{
	$ret = '';
	$countries = explode(';', $country_string); 
	foreach ($countries as $country)
	{
		$ret .= show_country_icon($country, $language, $class, $style);
	}
	return $ret;
}

function show_country_icon($code, $language, $class = '', $style = '')
{
	if (trim($code) == '')
	{
		return '';
	}
	switch($code)
	{
		case 'BY':
		case 'RU':
			$code = 'wjpf';
			break;
	}
	if ($class == '')
	{
		$class = 'country_button';
	}
    if ($style != '')
        return '<img class="' . $class . '" style="' . $style . '" src="img/flags/' . $code . '.png" data-id="'. $code . '" title="' . get_country_name($code, $language) . '">';
	return '<img class="' . $class . '" src="img/flags/' . $code . '.png" data-id="'. $code . '" title="' . get_country_name($code, $language) . '">';
	
}

function get_country_languages($language): array
{
    $language = escape($language);
    if ($language != 'en')
    {
        $language = 'de_language';
    }
    {
        $language = 'en_language';
    }
    $sql = 'SELECT * from countries WHERE de_language != "" ORDER BY ' . $language;
    $countries = query_array($sql);
    $ret = array();
    foreach ($countries  as $key => $country)
    {
        $ret[$country['code']] = $country[$language];
    }
    return $ret;
}
