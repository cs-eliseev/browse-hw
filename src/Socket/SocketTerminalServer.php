<?php

namespace browse\Socket;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SocketTerminalServer extends Command
{
    public function configure()
    {
        $this->setName('server')
            ->setDescription('Socket server')
            ->setHelp('server 127.0.0.1 5030 [number]')
            ->addArgument('host', InputArgument::REQUIRED, 'Set host')
            ->addArgument('port', InputArgument::REQUIRED, 'Set port')
            ->addArgument('threads', InputArgument::OPTIONAL, 'Set threads');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $msg = '';
        try {
            $threads = $input->getArgument('threads') ?? 1;

            // create server
            $server = new SocketServer(
                $input->getArgument('host'),
                (int)$input->getArgument('port')
            );

            echo 'Server start!' . PHP_EOL;

            for ($i = 0; $i < $threads; $i ++) {
                $pid_fork = pcntl_fork();
                if ($pid_fork == 0) {
                    // child process
                    echo 'thread start: ' . $i . PHP_EOL;
                    $server->listener($i);
                    echo 'request: ' . $server->getRequest() . PHP_EOL;

                    if ($server->isShotDown()) break;
                }
            }

            while (($cid = pcntl_waitpid(0 , $status)) != -1) {
                $exit_code = pcntl_wexitstatus($status);
                echo '[' . $cid . '] exited with status: ' . $exit_code . PHP_EOL;
                $msg = 'Server stop!' . PHP_EOL;
            }

        } catch (\Throwable $e) {
            $msg = 'error: ' . $e->getMessage();
        }

        $output->writeln($msg);
    }


}