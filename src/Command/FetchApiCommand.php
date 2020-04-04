<?php

namespace App\Command;

use App\Service\DataProvider\DataProviderOne;
use App\Service\DataProvider\DataProviderTwo;
use App\Service\Operation\ApiFetchFacade;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FetchApiCommand extends Command
{
    protected static $defaultName = 'api:fetch';
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setDescription('Get data from api and assign to developers')
            ->addArgument('dataProvider', InputArgument::REQUIRED, 'Choose one of data providers to get data from[one/two]')
            ->addOption('empty', null, InputOption::VALUE_OPTIONAL, 'Truncate pivot table to set new data', 0);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $progressBar = new ProgressBar($output, 4);
        $progressBar->start();
        $doctrine = $this->container->get('doctrine');
        $arg = $input->getArgument('dataProvider');
        $option = $input->getOption('empty');
        // option
        if ($option) {
            // truncate pivot table
            $connection = $doctrine->getManager()->getConnection();
            $connection->executeUpdate("SET foreign_key_checks = 0;");
            $platform = $connection->getDatabasePlatform();
            $connection->executeUpdate($platform->getTruncateTableSQL('developer_task', true));
            $connection->executeUpdate($platform->getTruncateTableSQL('task', true));
        }
        // argument
        switch ($arg) {
            case 'one':
                $dataProvider = new DataProviderOne();
                break;
            case 'two':
                $dataProvider = new DataProviderTwo();
                break;
            default:
                $io->note(sprintf('Please choose one of these data providers[one/two]'));
                return 0;
                break;
        }
        // do step by step all requirements
        $api = new ApiFetchFacade($doctrine, $dataProvider, $progressBar);
        $api->doSteps();

        $progressBar->finish();
        $io->success('Fetching data is finished successfully.');
        return 0;
    }
}
