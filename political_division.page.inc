<?php

/**
 * @file
 * Contains political_division.page.inc.
 *
 * PoliticalDivision page callback file for the political_division entity.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for political_division templates.
 *
 * Default template: political_division.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_political_division(array &$variables) {
  // Fetch PoliticalDivision Entity Object.
  $political_division = $variables['elements']['#political_division'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
