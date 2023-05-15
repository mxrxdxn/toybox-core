<?php

namespace Toybox\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Toybox\Core\Console\Kernel;

class MediaRegenerateCommand extends Command
{
    /**
     * @var string $defaultName The name/signature of the command.
     */
    protected static $defaultName = "media:regenerate";

    /**
     * @var string $defaultDescription The command description shown when running "php toybox list".
     */
    protected static $defaultDescription = "Regenerates media after changing image sizes.";

    /**
     * Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Connect to WordPress
        Kernel::connectToWordpress();

        // Make sure we can resize images (check to see if GD/Imagick is available).
        if (! wp_image_editor_supports(['methods' => ['resize']])) {
            $output->writeln("<error>GD/Imagick not available. Please install one of these PHP extensions in order to use this command.</error>");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * Override descriptions, help text etc.
     */
    protected function configure(): void
    {
        // Set help text
        $this->setHelp("Regenerates media after changing image sizes.");
    }
}