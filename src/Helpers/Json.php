<?php

namespace browse\Helpers;

class Json
{
    /**
     * @param array $data
     * @param int $options - Default is `JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE`
     * @return string
     */
    public static function encode(array $data, int $options = 320): string
    {
        return json_encode($data, $options);
    }

    /**
     * @param string $data
     * @param bool $as_array
     * @return array
     */
    public static function decode(string $data, bool $as_array = true): array
    {
        return json_decode($data, $as_array);
    }
}