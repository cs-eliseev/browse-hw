<?php

namespace browse\socket;

use browse\Abstracts\AbstractSocket;

class SocketClient extends AbstractSocket
{
    public function __construct(string $host = '', ?int $port = null)
    {
        $this->init($host, $port);
    }

    protected function run(): void
    {
        $connect = socket_connect($this->socket, $this->host, $this->port);
        if ($connect === false) {
            $this->close();
            throw new \Exception('Socket connect failed: ' . socket_strerror(socket_last_error()));
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    public function sender($msg): void
    {
        socket_write($this->socket, $msg, strlen($msg));

        $this->result = '';
        while (($chunk = socket_read($this->socket, 2048) ) !== '') {
            $this->result .= $chunk;
        }
    }
}