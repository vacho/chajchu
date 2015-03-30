<?php

/**
 * @file
 * Contains Drupal\chajchu\PersonInterface.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Person entity.
 *
 * @ingroup account
 */
interface PersonInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
