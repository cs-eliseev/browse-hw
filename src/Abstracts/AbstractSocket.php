<?php

namespace browse\Abstracts;

use browse\Interfaces\SocketInterface;
use browse\Socket\Exceptions\SocketException;

abstract class AbstractSocket implements SocketInterface
{
    const DEFAULT_HOST = '127.0.0.1';
    const DEFAULT_PORT = 5030;

    protected $socket;

    protected $request;
    protected $response;

    protected $host;
    protected $port;

    protected abstract function run(): void;

    /**
     * @param string $request
     */
    public function setRequest(string $request): void
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array|string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Init client-server
     *
     * @param string $host
     * @param int|null $port
     *
     * @throws \Exception
     */
    protected function init(string $host = self::DEFAULT_HOST, ?int $port = self::DEFAULT_PORT): void
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $this->validateSocket();

        $this->host = $host;
        $this->port = $port;

        $this->run();
    }

    protected function close(): void
    {
        if (is_resource($this->socket)) socket_close($this->socket);
    }

    /**
     * @throws SocketException
     */
    protected function validateSocket(): void
    {
        if (!is_resource($this->socket)) {
            SocketException::throwException(
                SocketException::ERROR_SOCKET_CREATE_FAILED,
                socket_strerror(socket_last_error())
            );
        }
    }
}