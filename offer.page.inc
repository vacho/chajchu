<?php

/**
 * @file
 * Contains offer.page.inc.
 *
 * Offer page callback file for the offer entity.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for offer templates.
 *
 * Default template: offer.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_offer(array &$variables) {
  // Fetch Offer Entity Object.
  $offer = $variables['elements']['#offer'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
