<?php

/**
 * @file
 * Contains Drupal\account\CategoryAccessController.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Category entity.
 *
 * @see \Drupal\chajchu\Entity\Category.
 */
class CategoryAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view Category entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit Category entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Category entity');
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
