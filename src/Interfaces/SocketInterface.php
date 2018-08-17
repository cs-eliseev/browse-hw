<?php

namespace browse\Interfaces;


interface SocketInterface
{
    /**
     * @param string $request
     */
    public function setRequest(string $request): void;

    /**
     * @return string
     */
    public function getRequest();

    /**
     * @return array|string
     */
    public function getResponse();
}