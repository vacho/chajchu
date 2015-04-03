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
use Drupal\chajchu\Entity\Product;
use Drupal\chajchu\Entity\Category;

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
            'callback' => array($this, 'viewSearch'),
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
            'callback' => array($this, 'viewSearch'),
            'wrapper' => 'searched',
            'method' => 'replace',
            'effect' => 'fade',
        ),
        '#weight' => 3,
        '#suffix' => "</div></div>",
        
    );
    
    $form['left']['forSearch'] = array(
        '#markup' => 
        "<div id='searching'><div id='left'><div id='searched'><div id='searched_0'>" 
          . t("Please search a product o service...") .
        "</div></div></div>",
        '#weight' => 4,
    );
    
    /*
     * TAGS
     */
    $idsEntities = \Drupal::entityQuery('category')
    ->execute();
    $entities = Category::loadMultiple($idsEntities);
    $limit = 6;
    $categories = "<div id='tags'>";
    foreach ($entities as $entity) {
      $weight = rand(1,8);
      if($limit <= 0){
        break;
      }else {
        $categories .= "<span class='weight_" . $weight . "'>" . $entity->get('name')->value . "</span>";
        $limit--;
      }
    }
    $categories .= "</div>";
    
    $form['right']['forTags'] = array(
        '#markup' =>
        "<div id='right'><div id='tags'>"
        . $categories .
        "</div>",
        '#weight' => 5,
    );
    
    /*
     * Adsense
     */
    
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
                                                                                                                                                                                                      
  public function viewSearch(array &$form, FormStateInterface $form_state) {
    $searched = $form_state->getValue('need');
    $operation = $form_state->getValue('op');
    
    $idsEntities = \Drupal::entityQuery('product')
    ->condition('name', $searched, 'CONTAINS')
    ->condition('type', $operation, '=')
    ->execute();
    $entities = Product::loadMultiple($idsEntities);
    $i = 0;
    
    $formres['searched'] = array(
        '#markup' => "<div id='searched'>",
    );
    
    if(empty($entities)){
      $formres['newContent'] = array(
          '#markup' =>
          "<div id='searched'><div id='searched_0'>"
          . t("Search empty...") .
          "</div></div>",
      );
    }
    foreach ($entities as $entity) {      
      $name = ($entity->get('name')->value != '' ? "<h2>" . $entity->get('name')->value . "</h2>" : "");
      $phone = ($entity->get('phone')->value != '' ? "<p><span class='highlight'>" . t("Phone") . ": </span>" . $entity->get('phone')->value . "</p>" : "");
      $cellphone = ($entity->get('cellphone')->value != '' ? "<p><span class='normal'>" . t("Cellphone") . ": </span>" . $entity->get('cellphone')->value . "</p>" : "");
      $email = ($entity->get('email')->value != '' ? "<p><span class='normal'>" . t("Email") . ": </span>" . $entity->get('email')->value . "</p>" : "");
      $webpage = ($entity->get('webpage')->value != '' ? "<p><span class='normal'>" . t("Webpage") . ": </span>" . $entity->get('webpage')->value . "</p>" : "");
      $address = ($entity->get('address')->value != '' ? "<p><span class='normal'>" . t("Address") . ": </span>" . $entity->get('address')->value . "</p>" : "");
      
      $formres['newContent_'.$i] = array(
          '#markup' => "
          <div id='searched_" . $i . "'>
          " . $name . "
          " . $phone . "
          " . $cellphone . "
          " . $email . "
          " . $webpage . "
          " . $address . "
          </div>",
      );
      
      $i++;
      
    }   
    $formres['searched_end'] = array(
        '#markup' => "</div>",
    );
    
    return $formres;
  }
  
}
