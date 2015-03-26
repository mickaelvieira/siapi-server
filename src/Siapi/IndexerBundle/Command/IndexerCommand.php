<?php

namespace Siapi\IndexerBundle\Command;

use Siapi\IndexerBundle\Service\Indexer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IndexerCommand extends ContainerAwareCommand
{

    /**
     * @var \Siapi\IndexerBundle\Service\Indexer
     */
    private $service;

    /**
     * @param string $name
     * @param \Siapi\IndexerBundle\Service\Indexer $service
     */
    public function __construct($name, Indexer $service)
    {
        $this->service = $service;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('siapi:indexer')
            ->setDescription('');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->service->process();
    }
}
