<?php

namespace browse\Socket;

use browse\Abstracts\AbstractSocket;

class SocketServer extends AbstractSocket
{
    public function __construct(string $host = '', ?int $port = null)
    {
        $this->init($host, $port);
    }

    public function __destruct()
    {
        $this->close();
    }

    protected function run(): void
    {
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
        if (!socket_bind($this->socket, $this->host, $this->port)) {
            throw new \Exception('Socket bind failed: ' . socket_strerror(socket_last_error()));
        }

        if (!socket_listen($this->socket, 1)) {
            throw new \Exception('Socket listen failed: ' . socket_strerror(socket_last_error()));
        }
    }

    public function listener($threadNo)
    {
        while (true) {

            $pid = posix_getpid();
            $socket = socket_accept($this->socket);

            echo '[' . $pid . '] [' . $threadNo . '] Acceptor connect: ' . $socket . PHP_EOL;
            socket_write($socket, 'Process pid: ' . $pid . PHP_EOL);

            $this->result = '';
            while (($chunk = socket_read($this->socket, 2048) ) !== '') {
                $this->result .= $chunk;
            }

            socket_write($socket, '[' . $this->result . ']' . PHP_EOL);
            socket_close($socket);
        }
    }
}