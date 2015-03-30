<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Offer.
 */

namespace Drupal\chajchu\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Offer entity type.
 */
class OfferViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['offer']['table']['base'] = array(
      'field' => 'id',
      'title' => t('Offer'),
      'help' => t('The offer entity ID.'),
    );

    return $data;
  }

}
