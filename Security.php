<?php

function app_get_int($name, $default = 0)
{
    if (!isset($_GET[$name])) {
        return $default;
    }

    return (int) $_GET[$name];
}

function app_get_string($name, $default = '')
{
    if (!isset($_GET[$name])) {
        return $default;
    }

    return trim((string) $_GET[$name]);
}

function app_get_float($name, $default = 0.0)
{
    if (!isset($_GET[$name]) || $_GET[$name] === '') {
        return (float) $default;
    }

    return (float) str_replace(',', '.', $_GET[$name]);
}

function app_post_int($name, $default = 0)
{
    if (!isset($_POST[$name])) {
        return $default;
    }

    return (int) $_POST[$name];
}

function app_post_string($name, $default = '')
{
    if (!isset($_POST[$name])) {
        return $default;
    }

    return trim((string) $_POST[$name]);
}

function app_escape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function app_safe_basename($name)
{
    return basename(str_replace(["\0", '/', '\\'], '', (string) $name));
}
