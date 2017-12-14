<?php

namespace DrupalCodeGenerator\Helper;

use DrupalCodeGenerator\Utils;
use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Generator input handler.
 */
class InputHandler extends Helper {

  use QuestionSettersTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return 'dcg_input_handler';
  }

  /**
   * Interacts with the user and returns variables for templates.
   *
   * @param \Symfony\Component\Console\Input\InputInterface $input
   *   Input instance.
   * @param \Symfony\Component\Console\Output\OutputInterface $output
   *   Output instance.
   * @param \Symfony\Component\Console\Question\Question[] $questions
   *   List of questions that the user should answer.
   * @param array $vars
   *   Array of predefined template variables.
   *
   * @return array
   *   Template variables.
   */
  public function collectVars(InputInterface $input, OutputInterface $output, array $questions, array $vars = []) {

    $questions = $this->normalizeQuestions($questions);

    // A user can pass answers through command line option.
    if ($answers_raw = $input->getOption('answers')) {
      $answers = json_decode($answers_raw, TRUE);
      if (!is_array($answers)) {
        throw new InvalidOptionException('Answers should be encoded in JSON format.');
      }
    }

    /** @var \DrupalCodeGenerator\Command\GeneratorInterface $command */
    $command = $this->getHelperSet()->getCommand();
    $directory = $command->getDirectory();

    foreach ($questions as $name => $question) {
      /** @var \Symfony\Component\Console\Question\Question $question */
      $default_value = $question->getDefault();

      // Make some assumptions based on question name.
      if ($default_value === NULL) {
        switch ($name) {
          case 'name':
            $root_directory = basename(Utils::getExtensionRoot($directory) ?: $directory);
            $default_value = Utils::machine2human($root_directory);
            break;

          case 'machine_name':
            $default_value = function (array $vars) use ($directory) {
              return Utils::human2machine(isset($vars['name']) ? $vars['name'] : basename($directory));
            };
            break;
        }
      }

      // Turn the callback into a value acceptable for Symfony question helper.
      if (is_callable($default_value)) {
        // Do not treat simple strings as callable because they may match PHP
        // builtin functions.
        if (!is_string($default_value) || strpos('::', $default_value) !== FALSE) {
          $default_value = call_user_func($default_value, $vars);
        }
      }

      $this->setQuestionDefault($question, $default_value);

      if (isset($answers[$name])) {
        $answer = $answers[$name];
      }
      else {
        $this->formatQuestionText($question);
        /** @var \Symfony\Component\Console\Helper\QuestionHelper $question_helper */
        $question_helper = $this->getHelperSet()->get('question');
        $answer = $question_helper->ask($input, $output, $question);
      }

      $vars[$name] = $answer;
    }

    return $vars;
  }

  /**
   * Formats question text.
   *
   * @param \Symfony\Component\Console\Question\Question $question
   *   The question.
   */
  protected function formatQuestionText(Question $question) {
    $question_text = $question->getQuestion();
    $default_value = $question->getDefault();

    $question_text = "<info>$question_text</info>";
    if (is_bool($default_value)) {
      $default_value = $default_value ? 'Yes' : 'No';
    }
    if ($default_value) {
      $question_text .= " [<comment>$default_value</comment>]";
    }
    $question_text .= ': ';

    $this->setQuestionText($question, $question_text);
  }

  /**
   * Normalizes questions.
   *
   * @param \Symfony\Component\Console\Question\Question[] $questions
   *   Questions to normalize.
   *
   * @return \Symfony\Component\Console\Question\Question[]
   *   Normalized questions
   *
   * @todo Remove it when all generators use object syntax for questions.
   */
  protected function normalizeQuestions(array $questions) {
    return array_map(function ($question) {
      // Support array syntax.
      if (is_array($question)) {
        if (count($question) > 2) {
          throw new \OutOfBoundsException('The question array is too long.');
        }
        list($question_text, $default_value) = array_pad($question, 2, NULL);
        $question = new Question($question_text, $default_value);
      }
      return $question;
    }, $questions);
  }

}