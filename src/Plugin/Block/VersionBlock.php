<?php

namespace Drupal\version_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block that displays the current Drupal and PHP versions.
 *
 * @Block(
 *   id = "version_block",
 *   admin_label = @Translation("Version block"),
 * )
 */
class VersionBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The current Drupal version.
   *
   * @var string
   */
  protected $drupalVersion;

  /**
   * The current PHP version.
   *
   * @var string
   */
  protected $phpVersion;

  /**
   * Constructs a VersionBlock object.
   *
   * @param array $configuration
   *   The block configuration.
   * @param string $plugin_id
   *   The block plugin ID.
   * @param mixed $plugin_definition
   *   The block plugin definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->drupalVersion = \Drupal::VERSION;
    $this->phpVersion = $php_version = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Drupal version: @drupal_version<br>PHP version: @php_version', [
        '@drupal_version' => $this->drupalVersion,
        '@php_version' => $this->phpVersion,
      ]),
    ];
  }

}
