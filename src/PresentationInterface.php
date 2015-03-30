<?php

/**
 * @file
 * Contains Drupal\chajchu\PresentationInterface.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Presentation entity.
 *
 * @ingroup account
 */
interface PresentationInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
