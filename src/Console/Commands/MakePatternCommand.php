<?php

namespace Toybox\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Toybox\Core\Theme;

class MakePatternCommand extends Command
{
    /**
     * @var string $defaultName The name/signature of the command.
     */
    protected static $defaultName = "make:pattern";

    /**
     * @var string $defaultDescription The command description shown when running "php toybox list".
     */
    protected static $defaultDescription = 'Creates a new pattern.';

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Arguments
        $name        = $input->getArgument("name");
        $sluggedName = slugify($name);

        // Create directory if it doesn't already exist
        if (! is_dir(TOYBOX_DIR . "/patterns")) {
            mkdir(TOYBOX_DIR . "/patterns");
        }

        // Create the file
        $patternFile = file_get_contents(Theme::CORE . "/stubs/example-pattern.php");
        $patternFile = str_replace('example-pattern-name', $name, $patternFile);
        $patternFile = str_replace('example-pattern-slug', $sluggedName, $patternFile);
        file_put_contents(TOYBOX_DIR . "/patterns/{$sluggedName}.php", $patternFile);

        // Show success message
        $output->writeln("<info>Created pattern successfully.</info>");

        return Command::SUCCESS;
    }

    /**
     * Override descriptions, help text etc.
     */
    protected function configure(): void
    {
        // Set help text
        $this->setHelp("Create a pattern from the stub.");

        /**
         * Arguments
         */

        // Pattern Name
        $this->addArgument(
            "name",
            InputArgument::REQUIRED,
            "The name of the pattern."
        );
    }
}
