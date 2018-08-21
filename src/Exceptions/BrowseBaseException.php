<?php

namespace browse\Exceptions;

use browse\Interfaces\BrowseDirectoryExceptionInterface;
use Exception;

class BrowseBaseException extends Exception implements BrowseDirectoryExceptionInterface
{
    const ERROR_DIR_NOT_EXIST = 1;

    const ERROR_SOCKET_CREATE_FAILED = 200;
    const ERROR_SOCKET_CONNECT_FAILED = 201;
    const ERROR_SOCKET_BIND_FAILED = 202;
    const ERROR_SOCKET_LISTEN_FAILED = 203;

    protected static $errors = [
        self::ERROR_DIR_NOT_EXIST => 'Directory is not exist',
        self::ERROR_SOCKET_CREATE_FAILED => 'Socket created failed',
        self::ERROR_SOCKET_CONNECT_FAILED => 'Socket connect failed',
        self::ERROR_SOCKET_BIND_FAILED => 'Socket bind failed',
        self::ERROR_SOCKET_LISTEN_FAILED => 'Socket listen failed',
    ];

    /**
     * Throw New Exceptions
     *
     * @param int $code
     * @param string $msg
     *
     * @throws Exception
     */
    public static function throwException(int $code, $msg = '') : void
    {
        throw new self(
            self::$errors[$code] . (empty($msg) ? '!' . PHP_EOL : '! ' . print_r($msg ,1) . PHP_EOL),
            $code
        );
    }
}