<?php

/**
 * @file
 * Contains Drupal\chajchu\Plugin\Block\Searcher.
 */

namespace Drupal\chajchu\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Searcher' block.
 *
 * @Block(
 *  id = "searcher",
 *  admin_label = @Translation("searcher"),
 * )
 */
class Searcher extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['need'] = $form_state->getValue('need');
    $this->configuration['offer'] = $form_state->getValue('offer');
    $this->configuration['demand'] = $form_state->getValue('demand');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = array();
    
    $build['need'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('What do you need?'),
        '#description' => $this->t('What do you need'),
        '#default_value' => isset($this->configuration['need']) ? $this->configuration['need'] : '',
    );
    $build['offer'] = array(
        '#type' => "button",
        '#value' => $this->t("Offer"),
        '#ajax' => array(
            'callback' => array($this, 'viewFactors'),
            'wrapper' => 'tableForAdd',
            'method' => 'replace',
            'effect' => 'fade',
        ),
    );
    $build['demand'] = array(
        '#type' => "button",
        '#value' => $this->t("Demand"),
        '#ajax' => array(
            'callback' => array($this, 'viewFactors'),
            'wrapper' => 'tableForAdd',
            'method' => 'replace',
            'effect' => 'fade',
        ),
    );

    return $build;
  }

}
