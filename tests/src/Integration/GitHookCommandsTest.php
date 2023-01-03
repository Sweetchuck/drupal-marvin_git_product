<?php

declare(strict_types = 1);

namespace Drupal\Tests\marvin_git_product\Integration;

/**
 * @group marvin
 * @group marvin_git_product
 * @group drush-command
 *
 * @covers \Drush\Commands\marvin_git_product\GitHookCommands
 */
class GitHookCommandsTest extends UnishIntegrationTestCase {

  public function testMarvinGitHookPreCommit(): void {
    $this->drush(
      'marvin:git-hook:pre-commit',
      [],
      $this->getCommonCommandLineOptions(),
      NULL,
      NULL,
      0,
      NULL,
      $this->getCommonCommandLineEnvVars()
    );

    $actualStdOutput = $this->getOutput();
    $actualStdError = $this->getErrorOutput();

    static::assertSame(
      '[notice] there are no tasks for event: marvin:git-hook:pre-commit',
      $actualStdError,
      'StdError',
    );

    static::assertSame(
      '',
      $actualStdOutput,
      'StdOutput',
    );
  }

}
