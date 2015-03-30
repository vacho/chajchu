<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Controller\PhotoListController.
 */

namespace Drupal\chajchu\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for Photo entity.
 *
 * @ingroup chajchu
 */
class PhotoListController extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('PhotoID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\chajchu\Entity\Photo */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.photo.edit_form', array(
          'photo' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
