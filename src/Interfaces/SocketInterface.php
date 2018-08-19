<?php

namespace browse\Interfaces;


interface SocketInterface
{
    /**
     * @param string $request
     * @return SocketInterface
     */
    public function setRequest(string $request) : self;

    /**
     * @return string
     */
    public function getRequest() : string;

    /**
     * @return array|string
     */
    public function getResponse();
}