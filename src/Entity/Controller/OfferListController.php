<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Controller\OfferListController.
 */

namespace Drupal\chajchu\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for Offer entity.
 *
 * @ingroup chajchu
 */
class OfferListController extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('OfferID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\chajchu\Entity\Offer */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.offer.edit_form', array(
          'offer' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
