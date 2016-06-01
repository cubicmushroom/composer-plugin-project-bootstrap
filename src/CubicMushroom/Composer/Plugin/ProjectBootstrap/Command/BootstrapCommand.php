<?php
/**
 * Author: Toby Griffiths <toby@cubicmushroom.co.uk>
 * Created: 15/05/2016
 */

namespace CubicMushroom\Composer\Plugin\ProjectBootstrap\Command;

use Composer\Command\BaseCommand;
use CubicMushroom\Composer\Plugin\ProjectBootstrap\Exception\Filesystem\UnsupportedDirectoryPathException;
use CubicMushroom\Filesystem\SplFileInfo;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Command to setup new projects
 *
 * @package CubicMushroom\Composer\Plugin\ProjectBootstrap
 */
class BootstrapCommand extends BaseCommand
{
    const INPUT_ARG_DIR = 'dir';

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;


    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('cm:bootstrap-project')
             ->setDescription('Bootstraps a new project')
             ->addArgument(
                 self::INPUT_ARG_DIR,
                 InputArgument::OPTIONAL,
                 'The directory to bootstrap the new project into'
             )
             ->setHelp('Help is here!');
    }


    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input  = $input;
        $this->output = $output;

        $this->info(
            [
                '',
                "****************************",
                "* Boostrapping new project *",
                "****************************",
                '',
            ]
        );

        $dir = $this->getDirectory();

        $this->info(sprintf('Installing into %s', $dir->getPathname()));
    }


    /**
     * Gets the directory for the project from either the input argument, or asks for it
     *
     * @return \SplFileInfo
     *
     * @throws UnsupportedDirectoryPathException if the path given on the input is problematic
     */
    protected function getDirectory()
    {
        $dir = $this->input->getArgument(self::INPUT_ARG_DIR);

        if (!is_null($dir)) {
            $dir = $this->validateAndConvertDirectoryPath($dir, getcwd());
        } else {
            $dir = $this->askForDirectory();
        }

        return new \SplFileInfo($dir);
    }


    /**
     * Asks the user for the directory to use
     *
     * @return SplFileInfo
     */
    protected function askForDirectory()
    {
        $cwd = getcwd();

        do {
            $dir = $this->question('Which directory would you like to setup your new project in?', $cwd);

            try {
                $dir = $this->validateAndConvertDirectoryPath($dir, $cwd);
            } catch (UnsupportedDirectoryPathException $e) {
                // Set to false to re-prompt for dir
                $dir = false;
            }

        } while (empty($dir) || !$this->confirm("Install to directory {$dir}?"));

        return $dir;
    }


    /**
     * @param string $dir
     * @param string $cwd
     *
     * @return SplFileInfo
     *
     * @throws UnsupportedDirectoryPathException if '~' is used in the path
     */
    protected function validateAndConvertDirectoryPath($dir, $cwd)
    {
        // Resolve the path
        $dir = (new SplFileInfo($dir))->resolvePathToNew($cwd);

        return $dir;
    }


    /**
     * @return QuestionHelper
     */
    protected function getQuestionHelper()
    {
        return $this->getHelper('question');
    }


    /**
     * @return FormatterHelper
     */
    protected function getFormatHelper()
    {
        $formatter = $this->getHelper('formatter');

        return $formatter;
    }


    /**
     * @param string|array $infoText
     * @param bool         $large
     */
    protected function info($infoText, $large = false)
    {
        $this->output->writeln($this->getFormatHelper()->formatBlock($infoText, 'info', $large));
    }


    /**
     * @param string $questionText
     * @param string $defaultValue
     *
     * @return string
     */
    protected function question($questionText, $defaultValue)
    {
        $question = $this->prepareQuestion($questionText, $defaultValue);

        $answer = $this->getQuestionHelper()->ask($this->input, $this->output, $question);

        // Add blank line afterwards
        $this->output->writeln('');

        return $answer;
    }


    /**
     * Prepares a question, with it's default answer
     *
     * @param string $questionText
     * @param string $defaultValue
     *
     * @return Question
     */
    protected function prepareQuestion($questionText, $defaultValue)
    {
        $question = new Question(
            sprintf(
                '<question>' . $questionText . ".</question>\n<info>[%s]</info>: ",
                $defaultValue
            ),
            $defaultValue
        );

        return $question;
    }


    /**
     * Asks for confirmation to a question
     *
     * @param string $questionText
     * @param bool   $default
     *
     * @return bool
     */
    protected function confirm($questionText, $default = false)
    {
        $optionsString = $default ? 'Y/n' : 'y/N';

        $question = new ConfirmationQuestion(
            "<question>{$questionText}</question>\n<info>[$optionsString]</info> ", $default
        );

        $answer = $this->getQuestionHelper()->ask($this->input, $this->output, $question);

        // Add blank line afterwards
        $this->output->writeln('-');

        return $answer;
    }


    /**
     * Displayed the given error
     *
     * @param string|array $errorText
     * @param bool         $large
     */
    protected function error($errorText, $large = false)
    {
        $this->output->writeln($this->getFormatHelper()->formatBlock($errorText, 'error', (bool)$large));
    }
}