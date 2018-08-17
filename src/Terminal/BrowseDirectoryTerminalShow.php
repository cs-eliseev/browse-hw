<?php

namespace browse\Terminal;

use browse\BrowseDirectory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BrowseDirectoryTerminalShow extends Command
{
    public function configure()
    {
        $this->setName('show')
            ->setDescription('Browse show directory info')
            ->setHelp('show s|f|d ~/download [s|j]')
            ->addArgument('operation', InputArgument::REQUIRED, 'Operation: view all, view dir, view file')
            ->addArgument('dir_path', InputArgument::REQUIRED, 'Set directory path')
            ->addArgument('response_options', InputArgument::OPTIONAL, 'Response options: string|json');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            // set response options
            $response_options = $input->getArgument('response_options');

            switch ($response_options) {

                case BrowseDirectory::RESPONSE_OPTIONS_JSON:
                case BrowseDirectory::RESPONSE_OPTIONS_STRING:
                    break;
                default:
                    // default options
                    $response_options = BrowseDirectory::RESPONSE_OPTIONS_STRING;
                    break;
            }

            $browse = new BrowseDirectory();

            $msg = $browse->showDir(
                $input->getArgument('dir_path'),
                $input->getArgument('operation'),
                $response_options
            );
        } catch (\Throwable $e) {
            $msg = 'error: ' . $e->getMessage();
        }

        $output->writeln($msg);
    }
}