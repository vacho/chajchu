<?php

/**
 * @file
 * Contains Drupal\chajchu\Plugin\Block\Searched.
 */

namespace Drupal\chajchu\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Searched' block.
 *
 * @Block(
 *  id = "searched",
 *  admin_label = @Translation("searched"),
 * )
 */
class Searched extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = array();
    
    $build['#markup'] = "<p> Result of search</p>";

    return $build;
  }

}
