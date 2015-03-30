<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Controller\PoliticalDivisionListController.
 */

namespace Drupal\chajchu\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for PoliticalDivision entity.
 *
 * @ingroup chajchu
 */
class PoliticalDivisionListController extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('PoliticalDivisionID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\chajchu\Entity\PoliticalDivision */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.political_division.edit_form', array(
          'political_division' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
