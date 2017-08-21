<?php

/**
 * @file
 * Contains establishment.page.inc.
 *
 * Page callback for Establishment entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Establishment templates.
 *
 * Default template: establishment.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_establishment(array &$variables) {
  // Fetch Establishment Entity Object.
  $establishment = $variables['elements']['#establishment'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
