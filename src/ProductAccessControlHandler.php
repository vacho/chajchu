<?php

/**
 * @file
 * Contains Drupal\account\ProductAccessController.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Product entity.
 *
 * @see \Drupal\chajchu\Entity\Product.
 */
class ProductAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view Product entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit Product entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Product entity');
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
