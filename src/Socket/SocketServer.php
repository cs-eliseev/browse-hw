<?php

namespace browse\Socket;

use browse\Abstracts\AbstractSocket;
use browse\BrowseDirectory;
use browse\Socket\Exceptions\SocketException;

class SocketServer extends AbstractSocket
{
    protected $connect;
    protected $shotDown = false;

    /**
     * SocketServer constructor
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

    public function __destruct()
    {
        $this->close();
    }

    /**
     * Run server
     *
     * @throws SocketException
     */
    protected function run(): void
    {
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
        if (!socket_bind($this->socket, $this->host, $this->port)) {
            SocketException::throwException(
                SocketException::ERROR_SOCKET_BIND_FAILED,
                socket_strerror(socket_last_error())
            );
        }

        if (!socket_listen($this->socket, 1)) {
            SocketException::throwException(
                SocketException::ERROR_SOCKET_LISTEN_FAILED,
                socket_strerror(socket_last_error())
            );
        }
    }

    /**
     * Listener
     *
     * @param $threadNo
     */
    public function listener($threadNo): void
    {
        while (true) {

            $pid = posix_getpid();
            $this->connect = socket_accept($this->socket);

            echo '[' . $pid . '] [' . $threadNo . '] Acceptor connect: ' . $this->connect . PHP_EOL;
            socket_write($this->connect, 'Process pid: ' . $pid . PHP_EOL);

            // get request
            if (false === ($this->request = trim(socket_read($this->connect, 2048)))) {
                echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($this->connect)) . "\n";
                break;
            }

            // exec request
            switch ($this->request) {
                case 'quit':
                    echo 'Client #' . $threadNo .': Disconnect' . "\n";
                    break;

                case 'shutdown':
                    echo 'Client #' . $threadNo .': Server stop' . "\n";
                    socket_close($this->connect);
                    $this->shotDown = true;
                    break 2;

                default:
                    $this->execCommand();
                    socket_write($this->connect, $this->response);
            }

            socket_close($this->connect);
        }
    }

    /**
     * Is shot down
     *
     * @return bool
     */
    public function isShotDown(): bool
    {
        return $this->shotDown;
    }

    /**
     * Exec command
     */
    protected function execCommand(): void
    {
        try {
            $command = explode(' ', trim($this->request));

            $method = $command[0];
            $operation = $command[1];
            $path_dir = $command[2];

            // set response options
            switch ($command[3] ?? '') {
                case BrowseDirectory::RESPONSE_OPTIONS_JSON:
                case BrowseDirectory::RESPONSE_OPTIONS_STRING:
                    $response_options = $command[3];
                    break;
                default:
                    // default response options
                    $response_options = BrowseDirectory::RESPONSE_OPTIONS_STRING;
                    break;
            }

            $browse = new BrowseDirectory();

            switch ($method) {
                case 'scan':
                    $this->response = $browse->scanDir($path_dir, $operation, $response_options);
                    break;

                case 'show':
                    $this->response = $browse->showDir($path_dir, $operation, $response_options);
                    break;
            }

        } catch (\Throwable $e) {
            $this->response = $e->getMessage() . PHP_EOL;
        }
    }
}