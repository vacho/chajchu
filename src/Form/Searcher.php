<?php

/**
 * @file
 * Contains Drupal\chajchu\Form\Searcher.
 */

namespace Drupal\chajchu\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Url;

/**
 * Class Searcher.
 *
 * @package Drupal\chajchu\Form
 */
class Searcher extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'searcher';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['top']['need'] = array(
        '#type' => 'textfield',
        '#description' => $this->t(''),
        '#default_value' => "",
        '#attributes' => array(
            'placeholder' => '_' . $this->t('What do you need?'),
        ),
        '#weight' => 1,
        '#prefix' => "<div id='search'><div id='search-content'>",
    );
    
    $form['top']['offer'] = array(
        '#type' => "button",
        '#value' => $this->t("Offer"),
        '#ajax' => array(
            'callback' => '::viewOffers',
            'wrapper' => 'searched',
            'method' => 'replace',
            'effect' => 'fade',
        ),
        '#weight' => 2,
    );
    
    $form['top']['demand'] = array(
        '#type' => "button",
        '#value' => $this->t("Demand"),
        '#ajax' => array(
            'callback' => array($this, 'viewDemands'),
            'wrapper' => 'searched',
            'method' => 'replace',
            'effect' => 'fade',
        ),
        '#weight' => 3,
        '#suffix' => "</div></div>",
        
    );
    
    $form['left']['forSearch'] = array(
        '#markup' => 
        "<div id='searching'><div id='left'><div id='searched'>" 
          . t("Please search a producto o service") .
        "</div></div>",
        '#weight' => 4,
    );
    
    $form['right']['forTags'] = array(
        '#markup' =>
        "<div id='right'><div id='tags'>"
        . t("Tags") .
        "</div>",
        '#weight' => 5,
    );
    $form['right']['forAdsense'] = array(
        '#markup' =>
        "<div id='adsense'>"
        . t("Publicity") .
        "</div></div></div>",
        '#weight' => 6,
    );
    
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    return;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    return $form;
  }
  
  public function viewOffers() {
    $form['newContent'] = array(
        '#markup' => "<div id='searched'><p>Ofertas: Hola mundo de las busquedas</p></div>",
    );
    return $form;
  }
  
  public function viewDemands() {
    $form['newContent'] = array(
        '#markup' => "<div id='searched'><p>Demandas: Hola mundo de las busquedas</p></div>",
    );
    return $form;
  }

}
