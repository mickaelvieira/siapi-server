<?php


namespace Siapi\IndexerBundle\Command;

use Siapi\IndexerBundle\Service\Generator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GeneratorCommand
 * @package Siapi\IndexerBundle\Command
 */
final class GeneratorCommand extends ContainerAwareCommand
{
    /**
     * @var \Siapi\IndexerBundle\Service\Generator
     */
    private $service;

    /**
     * @param string $name
     * @param \Siapi\IndexerBundle\Service\Generator $service
     */
    public function __construct($name, Generator $service)
    {
        $this->service = $service;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('siapi:generator')
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
