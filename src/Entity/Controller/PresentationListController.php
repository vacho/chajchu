<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Controller\PresentationListController.
 */

namespace Drupal\chajchu\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for Presentation entity.
 *
 * @ingroup chajchu
 */
class PresentationListController extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('PresentationID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\chajchu\Entity\Presentation */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.presentation.edit_form', array(
          'presentation' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
