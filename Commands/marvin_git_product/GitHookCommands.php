<?php

declare(strict_types = 1);

namespace Drush\Commands\marvin_git_product;

use Drupal\marvin\Attributes as MarvinCLI;
use Drush\Attributes as CLI;
use Drush\Boot\DrupalBootLevels;
use Drush\Commands\marvin_git\GitHookCommandsBase;
use Robo\Collection\CollectionBuilder;

/**
 * Git hook related commands.
 *
 * All command is hidden, because no need to call them manually.
 */
class GitHookCommands extends GitHookCommandsBase {

  /**
   * Git hook callback command for "./.git/hooks/applypatch-msg".
   */
  #[CLI\Command(name: 'marvin:git-hook:applypatch-msg')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'commitMsgFilePath',
    description: 'The name of the file that holds the proposed commit log message.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdApplyPatchMsgExecute(string $commitMsgFilePath): CollectionBuilder {
    return $this->delegate('applypatch-msg', $commitMsgFilePath);
  }

  /**
   * Git hook callback command for "./.git/hooks/commit-msg".
   */
  #[CLI\Command(name: 'marvin:git-hook:commit-msg')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'commitMsgFilePath',
    description: 'The name of the file that contains the commit log message.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdCommitMsgExecute(string $commitMsgFilePath): CollectionBuilder {
    return $this->delegate('commit-msg', $commitMsgFilePath);
  }

  /**
   * Git hook callback command for "./.git/hooks/post-applypatch".
   */
  #[CLI\Command(name: 'marvin:git-hook:post-applypatch')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPostApplyPatchExecute(): CollectionBuilder {
    return $this->delegate('post-applypatch');
  }

  /**
   * Git hook callback command for "./.git/hooks/post-checkout".
   *
   * @todo Consider to change the @bootstrap to "none", because after `git
   *       checkout` the code base can be inconsistent.
   *       (3rd-party packages aren't up to date; composer.lock).
   *       This can be true for other Git hooks as well.
   */
  #[CLI\Command(name: 'marvin:git-hook:post-checkout')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'refPrevious',
    description: 'The ref of the previous HEAD.',
  )]
  #[CLI\Argument(
    name: 'refHead',
    description: 'The ref of the new HEAD (which may or may not have changed).',
  )]
  #[CLI\Argument(
    name: 'isBranchCheckout',
    description: 'Flag indicating whether the checkout was a branch checkout (changing branches = 1) or a file checkout (retrieving a file from the index = 0)',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPostCheckoutExecute(string $refPrevious, string $refHead, bool $isBranchCheckout): CollectionBuilder {
    return $this->delegate('post-checkout', $refPrevious, $refHead, $isBranchCheckout);
  }

  /**
   * Git hook callback command for "./.git/hooks/post-commit".
   */
  #[CLI\Command(name: 'marvin:git-hook:post-commit')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPostCommitExecute(): CollectionBuilder {
    return $this->delegate('post-commit');
  }

  /**
   * Git hook callback command for "./.git/hooks/post-merge".
   */
  #[CLI\Command(name: 'marvin:git-hook:post-merge')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'isSquashMerge',
    description: 'Status flag specifying whether or not the merge being done was a squash merge.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPostMergeExecute(bool $isSquashMerge): CollectionBuilder {
    return $this->delegate('post-merge', $isSquashMerge);
  }

  /**
   * Git hook callback command for "./.git/hooks/post-receive".
   */
  #[CLI\Command(name: 'marvin:git-hook:post-receive')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPostReceiveExecute(): CollectionBuilder {
    return $this->delegate('post-receive');
  }

  /**
   * Git hook callback command for "./.git/hooks/post-rewrite".
   */
  #[CLI\Command(name: 'marvin:git-hook:post-rewrite')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'commandType',
    description: 'Denotes the command the hook was invoked by.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPostRewriteExecute(string $commandType): CollectionBuilder {
    return $this->delegate('post-rewrite', $commandType);
  }

  /**
   * Git hook callback command for "./.git/hooks/post-update".
   */
  #[CLI\Command(name: 'marvin:git-hook:post-update')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'refNames',
    description: 'Name of ref that was actually updated.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPostUpdateExecute(array $refNames): CollectionBuilder {
    return $this->delegate('post-update', $refNames);
  }

  /**
   * Git hook callback command for "./.git/hooks/apply-patch".
   */
  #[CLI\Command(name: 'marvin:git-hook:pre-applypatch')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPreApplyPatchExecute(): CollectionBuilder {
    return $this->delegate('pre-applypatch');
  }

  /**
   * Git hook callback command for "./.git/hooks/pre-auto-gc".
   */
  #[CLI\Command(name: 'marvin:git-hook:pre-auto-gc')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPreAutoGcExecute(): CollectionBuilder {
    return $this->delegate('pre-auto-gc');
  }

  /**
   * Git hook callback command for "./.git/hooks/pre-commit".
   */
  #[CLI\Command(name: 'marvin:git-hook:pre-commit')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Help(
    hidden: TRUE,
  )]
  #[MarvinCLI\PreCommandInitLintReporters]
  public function cmdPreCommitExecute(): CollectionBuilder {
    return $this->delegate('pre-commit');
  }

  /**
   * Git hook callback command for "./.git/hooks/pre-push".
   */
  #[CLI\Command(name: 'marvin:git-hook:pre-push')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'remoteName',
    description: 'Name or URL of the destination remote',
  )]
  #[CLI\Argument(
    name: 'remoteUrl',
    description: 'URL of the destination remote.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPrePushExecute(string $remoteName, string $remoteUrl): CollectionBuilder {
    return $this->delegate('pre-push', $remoteName, $remoteUrl);
  }

  /**
   * Git hook callback command for "./.git/hooks/pre-rebase".
   */
  #[CLI\Command(name: 'marvin:git-hook:pre-rebase')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'upstream',
    description: 'The upstream from which the series was forked.',
  )]
  #[CLI\Argument(
    name: 'branch',
    description: 'The branch being rebased, and is not set when rebasing the current branch.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPreRebaseExecute(string $upstream, ?string $branch = NULL): CollectionBuilder {
    return $this->delegate('pre-rebase', $upstream, $branch);
  }

  /**
   * Git hook callback command for "./.git/hooks/pre-receive".
   */
  #[CLI\Command(name: 'marvin:git-hook:pre-receive')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPreReceiveExecute(): CollectionBuilder {
    return $this->delegate('pre-receive');
  }

  /**
   * Git hook callback command for "./.git/hooks/prepare-commit-msg".
   */
  #[CLI\Command(name: 'marvin:git-hook:prepare-commit-msg')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'commitMsgFilePath',
    description: 'The name of the file that contains the commit log message.',
  )]
  #[CLI\Argument(
    name: 'messageSource',
    description: 'The source of the commit message. message|template|merge|squash||commit.',
  )]
  #[CLI\Argument(
    name: 'sha1',
    description: 'Documentation @todo.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPrepareCommitMsgExecute(string $commitMsgFilePath, string $messageSource = '', string $sha1 = ''): CollectionBuilder {
    return $this->delegate('prepare-commit-msg', $commitMsgFilePath, $messageSource, $sha1);
  }

  /**
   * Git hook callback command for "./.git/hooks/push-to-checkout".
   */
  #[CLI\Command(name: 'marvin:git-hook:push-to-checkout')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'newCommit',
    description: 'The commit with which the tip of the current branch is going to be updated.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdPushToCheckoutExecute(string $newCommit): CollectionBuilder {
    return $this->delegate('push-to-checkout', $newCommit);
  }

  /**
   * Git hook callback command for "./.git/hooks/update".
   */
  #[CLI\Command(name: 'marvin:git-hook:update')]
  #[CLI\Bootstrap(level: DrupalBootLevels::MAX)]
  #[CLI\Argument(
    name: 'refName',
    description: 'The name of the ref being updated.',
  )]
  #[CLI\Argument(
    name: 'oldObjectName',
    description: 'The old object name stored in the ref.',
  )]
  #[CLI\Argument(
    name: 'newObjectName',
    description: 'The new object name to be stored in the ref.',
  )]
  #[CLI\Help(
    hidden: TRUE,
  )]
  public function cmdUpdateExecute(string $refName, string $oldObjectName, string $newObjectName): CollectionBuilder {
    return $this->delegate('update', $refName, $oldObjectName, $newObjectName);
  }

}
