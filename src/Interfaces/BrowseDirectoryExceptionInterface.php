<?php

namespace browse\Interfaces;


interface BrowseDirectoryExceptionInterface
{
    /**
     * Throw New Exceptions
     *
     * @param int $code
     * @param $msg
     */
    public static function throwException(int $code, $msg = ''): void;
}