<?php

/**
 * @file
 * Contains Drupal\account\OfferAccessController.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Offer entity.
 *
 * @see \Drupal\chajchu\Entity\Offer.
 */
class OfferAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view Offer entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit Offer entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Offer entity');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add Bar entity');
  }

}
