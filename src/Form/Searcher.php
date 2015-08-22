<?php

/**
 * @file
 * Contains Drupal\chajchu\Form\Searcher.
 */

namespace Drupal\chajchu\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\chajchu\Entity\Product;
use Drupal\chajchu\Entity\Category;
use Drupal\Component\Utility\SafeMarkup;

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

    /*
     * SEARCHER
     */
    $form['#attached']['library'][] = 'chajchu/searcher';
    $form['#attached']['library'][] = 'chajchu/awesomplete';

    $result = db_query('SELECT DISTINCT(name) FROM {product}');
    $services = "";
    foreach ($result as $record) {
      $services = $record->name . ", " . $services;
    }
    $result = db_query('SELECT DISTINCT(detail) FROM {product}');
    foreach ($result as $record) {
      if (strpos($services, $record->detail) === FALSE) {
        $services = $record->detail . ", " . $services;
      }
    }

    $form['top']['need'] = array(
      '#type' => 'textfield',
      '#description' => $this->t(''),
      '#default_value' => "",
      '#attributes' => array(
        'placeholder' => '_' . $this->t('What do you need?'),
        'id' => 'busqueda',
        'class' => array(
          'awesomplete',
        ),
        'data-list' => $services,
      ),
      '#weight' => 1,
      '#maxlength' => 700,
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

    $form['left']['searched'] = array(
      '#markup' => "<div id='left'><div id='searching'><div id='searched'>",
    );

    $i = 1;

    if (isset($_GET['category'])) {
      $idCategory = $_GET['category'];

      $result = db_query(
        'SELECT * FROM {product} WHERE category = :id', array(':id' => $idCategory)
      );
    }
    else {
      //@Todo dinamic random number of products
      $result = db_query(
        'SELECT * FROM {product} ORDER BY RAND() LIMIT 8'
      );
    }


    foreach ($result as $record) {
      $id = $record->id;
      $name = ($record->name != '' ? "<h2>" . $record->name . "</h2>" : "");
      $phone = ($record->phone != '' ? "<p><span class='highlight'>" . t("Phone") . ": </span>" . $record->phone . "</p>" : "");
      $cellphone = ($record->cellphone != '' ? "<p><span class='normal'>" . t("Cellphone") . ": </span>" . $record->cellphone . "</p>" : "");
      $email = ($record->email != '' ? "<p><span class='normal'>" . t("Email") . ": </span>" . $record->email . "</p>" : "");
      $webpage = ($record->webpage != '' ? "<p><span class='normal'>" . t("Webpage") . ": </span><a href='http://" . $record->webpage . "' target='_blank' >" . $record->webpage . "</a></p>" : "");
      $address = ($record->address != '' ? "<p><span class='normal'>" . t("Address") . ": </span>" . $record->address . "</p>" : "");

      $form['left']['newContent_' . $i] = array(
        '#markup' => "
          <div id='searched_" . $i . "'>
          <a href='product/" . $id . "' >" . $name . " </a>
          " . $phone . "
          " . $cellphone . "
          " . $email . "
          " . $webpage . "
          " . $address . "
          </div>",
      );
      $i++;
    }

    $form['left']['searched_end'] = array(
      '#markup' => "</div></div></div>",
    );

    /*
     * TAGS
     */
    //@todo dinamic limit
    $result = db_query(
      'SELECT * FROM {category} ORDER BY RAND() LIMIT 22'
    );
    $categories = "<div id='tags'>";
    foreach ($result as $record) {
      $weight = rand(1, 8);
      $categories .= "
        <span class='weight_" . $weight . "'>
            <a href='?category=" . $record->id . "' >" . $record->name . " </a>
        </span>" . $endLine;
    }
    $categories .= "</div>";

    $form['right']['forTags'] = array(
      '#markup' =>
        "<div id='right'>
            <div id='tags'>"
        . $categories .
        "   </div>",
      '#weight' => 5,
    );

    /*
     * Adsense
     */

    $form['right']['forAdsense'] = [
      '#markup' =>
        SafeMarkup::set("<div id='adsense'>"
          . '
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Right side -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:600px"
     data-ad-client="ca-pub-5452341099082270"
     data-ad-slot="5378862542"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
        ' .
          "</div></div></div>"),
      '#weight' => 6,
    ];

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

    if ($operation == "Oferta") {
      $operation = "Offer";
    }

    $idsEntities = \Drupal::entityQuery('product', 'OR')
      ->condition('name', $searched, 'CONTAINS')
      ->condition('detail', $searched, 'CONTAINS')
      ->execute();
    $entities = Product::loadMultiple($idsEntities);
    $i = 0;

    $formres['searched'] = array(
      '#markup' => "<div id='searched'>",
    );

    if (empty($entities)) {
      $formres['newContent'] = array(
        '#markup' =>
          "<div id='searched'><div id='searched_0'>"
          . t("Search empty...") .
          "</div></div>",
      );
    }
    foreach ($entities as $entity) {
      if ($entity->getType() == $operation) {
        $id = $entity->getId();
        $name = ($entity->get('name')->value != '' ? "<h2>" . $entity->get('name')->value . "</h2>" : "");
        $phone = ($entity->get('phone')->value != '' ? "<p><span class='highlight'>" . t("Phone") . ": </span>" . $entity->get('phone')->value . "</p>" : "");
        $cellphone = ($entity->get('cellphone')->value != '' ? "<p><span class='normal'>" . t("Cellphone") . ": </span>" . $entity->get('cellphone')->value . "</p>" : "");
        $email = ($entity->get('email')->value != '' ? "<p><span class='normal'>" . t("Email") . ": </span>" . $entity->get('email')->value . "</p>" : "");
        $webpage = ($entity->get('webpage')->value != '' ? "<p><span class='normal'>" . t("Webpage") . ": </span><a href='http://" . $entity->get('webpage')->value . "' target='_blank' >" . $entity->get('webpage')->value . "</a></p>" : "");
        $address = ($entity->get('address')->value != '' ? "<p><span class='normal'>" . t("Address") . ": </span>" . $entity->get('address')->value . "</p>" : "");

        $formres['newContent_' . $i] = array(
          '#markup' => "
          <div id='searched_" . $i . "'>
          <a href='product/" . $id . "'>" . $name . " </a>
          " . $phone . "
          " . $cellphone . "
          " . $email . "
          " . $webpage . "
          " . $address . "
          </div>",
        );
        $i++;
      }
    }
    $formres['searched_end'] = array(
      '#markup' => "</div>",
    );

    return $formres;
  }

}