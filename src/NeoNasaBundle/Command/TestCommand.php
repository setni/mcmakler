<?php

namespace NeoNasaBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Input\InputArgument;

class TestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('test:command')
            ->setDescription('Test something.')
            ->setHelp("This command is to test...")
            ->addArgument('id', InputArgument::REQUIRED, 'The id of the document.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $test = $input->getArgument('id');
        if($test == '2') $output->writeln('document exists');
        else $output->writeln('document doesn\'t exist');
        
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('This is a test. Do you want to continue (y/N) ?', false, '/^(y|j)/i');

        if (!$helper->ask($input, $output, $question)) {
            $output->writeln('Nothing done. Exiting...');
        } else $this->execute($input, $output);
        
    }
}