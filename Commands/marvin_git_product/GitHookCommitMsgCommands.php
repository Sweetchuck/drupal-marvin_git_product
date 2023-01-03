<?php

declare(strict_types = 1);

namespace Drush\Commands\marvin_git_product;

use Consolidation\AnnotatedCommand\Hooks\HookManager;
use Drupal\marvin_git\Robo\GitCommitMsgValidatorTaskLoader;
use Drush\Attributes as CLI;
use Drush\Commands\marvin\CommandsBase;
use Robo\Collection\CollectionBuilder;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Path;

class GitHookCommitMsgCommands extends CommandsBase {

  use GitCommitMsgValidatorTaskLoader;

  #[CLI\Hook(
    type: HookManager::ON_EVENT,
    target: 'marvin:git-hook:commit-msg',
  )]
  public function onEventMarvinGitHookCommitMsg(InputInterface $input): array {
    $commitMsgFileName = $input->getArgument('commitMsgFileName');
    if (!file_exists($commitMsgFileName)) {
      $commitMsgFileName = Path::join($this->getProjectRootDir(), $commitMsgFileName);
    }

    return [
      'marvin_git_product.commit_msg_validator' => [
        'weight' => 0,
        'task' => $this->getTaskGitCommitMsgValidator($commitMsgFileName, $this->getRules()),
      ],
    ];
  }

  /**
   * @return \Robo\Collection\CollectionBuilder|\Drupal\marvin_git\Robo\Task\GitCommitMsgValidatorTask
   */
  protected function getTaskGitCommitMsgValidator(string $commitMsgFileName, array $rules): CollectionBuilder {
    return $this
      ->taskMarvinGitCommitMsgValidator()
      ->setFileName($commitMsgFileName)
      ->setRules($rules);
  }

  protected function getRules(): array {
    return $this
      ->getConfig()
      ->get('marvin_git.hook.commit-msg.settings.rules', []);
  }

}
