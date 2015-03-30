<?php

/**
 * @file
 * Contains Drupal\chajchu\ProductInterface.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Product entity.
 *
 * @ingroup account
 */
interface ProductInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
