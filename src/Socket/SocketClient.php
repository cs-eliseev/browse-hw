<?php

namespace browse\Socket;

use browse\Abstracts\AbstractSocket;
use browse\Socket\Exceptions\SocketException;

class SocketClient extends AbstractSocket
{
    /**
     * SocketClient constructor
     *
     * @param string $host
     * @param int|null $port
     *
     * @throws SocketException
     */
    public function __construct(string $host = '', ?int $port = null)
    {
        $this->init($host, $port);
    }

    /**
     * Run client
     *
     * @throws SocketException
     */
    protected function run(): void
    {
        $connect = socket_connect($this->socket, $this->host, $this->port);
        if ($connect === false) {
            $this->close();
            SocketException::throwException(
                SocketException::ERROR_SOCKET_CONNECT_FAILED,
                socket_strerror(socket_last_error())
            );
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * Send message
     */
    public function send(): void
    {
        socket_write($this->socket, $this->request, strlen($this->request));

        $this->response = '';
        while (($chunk = socket_read($this->socket, 2048) ) !== '') {
            $this->response .= $chunk;
        }
    }
}