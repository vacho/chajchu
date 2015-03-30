<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Controller\PersonListController.
 */

namespace Drupal\chajchu\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for Person entity.
 *
 * @ingroup chajchu
 */
class PersonListController extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('PersonID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\chajchu\Entity\Person */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.person.edit_form', array(
          'person' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
