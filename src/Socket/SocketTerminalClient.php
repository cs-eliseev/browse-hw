<?php

namespace browse\Socket;

use browse\BrowseDirectory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class SocketTerminalClient extends Command
{
    public function configure()
    {
        $this->setName('client')
             ->setDescription('Socket client')
             ->setHelp('client 127.0.0.1 5030 scan|show s|f|d ~/download [s|j]')
             ->addArgument('host', InputArgument::REQUIRED, 'Set host')
             ->addArgument('port', InputArgument::REQUIRED, 'Set port')
             ->addArgument('method', InputArgument::REQUIRED, 'Method: scan, show')
             ->addArgument('operation', InputArgument::REQUIRED, 'Operation: view all, view dir, view file')
             ->addArgument('dir_path', InputArgument::REQUIRED, 'Set directory path')
             ->addArgument('response_options', InputArgument::OPTIONAL, 'Response options: array|string|json');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            // create client
            $client = new SocketClient(
                $input->getArgument('host'),
                (int)$input->getArgument('port')
            );

            // create msg to server
            $request = $input->getArgument('method') .  ' '
                . $input->getArgument('operation') . ' '
                . $input->getArgument('dir_path');

            $response_options = $input->getArgument('response_options');

            switch ($response_options) {

                case BrowseDirectory::RESPONSE_OPTIONS_JSON:
                case BrowseDirectory::RESPONSE_OPTIONS_STRING:
                    $request .= ' ' . $response_options;
                    break;
            }

            $client->setRequest($request);
            $client->send();

            $response = $client->getResponse();

        } catch (Throwable $e) {
            $response = 'error: ' . $e->getMessage();
        }

        $output->writeln($response);
    }
}