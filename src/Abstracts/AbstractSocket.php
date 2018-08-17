<?php

namespace browse\Abstracts;


abstract class AbstractSocket
{
    const DEFAULT_HOST = '127.0.0.1';
    const DEFAULT_PORT = 5030;

    protected $socket;
    protected $result;

    protected $host;
    protected $port;

    protected abstract function run(): void;

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @param string $host
     * @param int|null $port
     * @throws \Exception
     */
    public function init(string $host = self::DEFAULT_HOST, ?int $port = self::DEFAULT_PORT): void
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (!is_resource($this->socket)) {
            throw new \Exception('Socket created failed: ' . socket_strerror(socket_last_error()));
        }

        $this->host = $host;
        $this->port = $port;

        $this->run();
    }

    protected function close(): void
    {
        if (is_resource($this->socket)) socket_close($this->socket);
    }
}