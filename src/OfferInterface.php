<?php

/**
 * @file
 * Contains Drupal\chajchu\OfferInterface.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Offer entity.
 *
 * @ingroup account
 */
interface OfferInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
