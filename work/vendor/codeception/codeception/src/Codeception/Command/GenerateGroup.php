<?php
namespace Codeception\Command;

use Codeception\Configuration;
use Codeception\Lib\Generator\Group as GroupGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Creates empty GroupObject - extension which handles all group events.
 *
 * * `codecept g:group Admin`
 */
class GenerateGroup extends Command
{
    use Shared\FileSystem;
    use Shared\Config;

    protected function configure()
    {
        $this->setDefinition([
            new InputArgument('group', InputArgument::REQUIRED, 'Group class name'),
        ]);
    }

    public function getDescription()
    {
        return 'Generates Group subscriber';
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getGlobalConfig();
        $group = $input->getArgument('group');

        $class = ucfirst($group);
        $path = $this->createDirectoryFor(Configuration::supportDir() . 'Group' . DIRECTORY_SEPARATOR, $class);

        $filename = $path . $class . '.php';

        $gen = new GroupGenerator($config, $group);
        $res = $this->createFile($filename, $gen->produce());

        if (!$res) {
            $output->writeln("<error>Group $filename already exists</error>");
            return 1;
        }

        $output->writeln("<info>Group extension was created in $filename</info>");
        $output->writeln(
            'To use this group extension, include it to "extensions" option of global Codeception config.'
        );
        return 0;
    }
}
