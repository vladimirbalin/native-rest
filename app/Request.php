<?php

namespace app;

class Request
{
    public function getParams()
    {
        return filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = mb_strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return mb_substr($path, 0, $position);
    }
}