<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\PoliticalDivision.
 */

namespace Drupal\chajchu\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the PoliticalDivision entity type.
 */
class PoliticalDivisionViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['political_division']['table']['base'] = array(
      'field' => 'id',
      'title' => t('PoliticalDivision'),
      'help' => t('The political_division entity ID.'),
    );

    return $data;
  }

}
