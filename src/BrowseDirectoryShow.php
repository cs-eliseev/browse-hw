<?php

namespace browse;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BrowseDirectoryShow extends Command
{
    public function configure()
    {
        $this->setName('show')
             ->setDescription('Browse show directory info')
             ->setHelp('run show method(s|f|d) ~/download')
             ->addArgument('operation', InputArgument::REQUIRED, 'Set show operation')
             ->addArgument('dir_patch', InputArgument::REQUIRED, 'Set directory patch');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $browse = new BrowseDirectory();
            $msg = 'result: ' . print_r(
                    $browse->showDir(
                        $input->getArgument('dir_patch'),
                        $input->getArgument('operation')
                    ), 1);
        } catch (\Throwable $e) {
            $msg = 'error: ' . $e->getMessage();
        }

        $output->writeln($msg);
    }


}