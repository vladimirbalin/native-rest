<?php

namespace core;

class Response
{

    public static function setHttpStatus(int $int): void
    {
        http_response_code($int);
    }
}