<?php

/**
 * @file
 * Contains Drupal\chajchu\PoliticalDivisionInterface.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a PoliticalDivision entity.
 *
 * @ingroup account
 */
interface PoliticalDivisionInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
