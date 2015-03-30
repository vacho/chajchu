<?php

/**
 * @file
 * Contains Drupal\account\PersonAccessController.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Person entity.
 *
 * @see \Drupal\chajchu\Entity\Person.
 */
class PersonAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view Person entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit Person entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Person entity');
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
