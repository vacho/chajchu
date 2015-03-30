<?php

/**
 * @file
 * Contains Drupal\chajchu\CategoryInterface.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Category entity.
 *
 * @ingroup account
 */
interface CategoryInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
