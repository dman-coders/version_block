<?php

namespace Drupal\Tests\version_block\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests the Version Block module.
 *
 * @group version_block
 */
class VersionBlockTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['version_block'];

  /**
   * @var string
   *
   *  The theme used for testing visibility ust have a "highlighted" region. Not all do.
   */
  protected $defaultTheme = 'bartik';

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    // Nothing special here.
  }

  /**
   * Tests that the version block appears on the front page.
   */
  public function testVersionBlock() {

    // Visit the front page. Anon user by default/
    $this->drupalGet('');
    $this->assertSession()->statusCodeEquals(200);

    // Verify that the version block appears in the highlighted region.
    $this->assertSession()
      ->pageTextContains('Drupal version: ' . \Drupal::VERSION);
    $this->assertSession()
      ->elementTextContains('css', '.region-highlighted', 'Drupal version: ' .
        \Drupal::VERSION);
  }

}
