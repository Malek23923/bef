<?php

/**
 * @file
 * Contains \Drupal\example\Controller\ExampleController.
 */

namespace Drupal\befab_base\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Unicode;

class Befab_baseStartController {

    /**
     * 
     * @return type
     */
    public function startAction() {
        // embed search form in controller

        $form_class = '\Drupal\base\Form\SearchForm';
        $form = \Drupal::formBuilder()->getForm($form_class);

        return [
            '#theme' => 'my_template',
            '#form' => $form];
    }

    /**
     * 
     * @param type $service
     * @param type $location
     * @param type $time
     * @return type
     */
    public function SearchresultAction($service, $location, $time) {



        $vars = [
            'establishment' => $service,
            'location ' => $location,
            'time' => $time
        ];

        $results = $this->getResults($vars);


        return [
            '#theme' => 'search_results',
            '#entities' => $results];
    }

    /**
     * 
     * @param array $vars
     * @return type
     */
    private function getResults(array $vars = null) {

        $results = array();
        $values = $vars;
        $query = \Drupal::entityQuery('establishment');
        $query->condition('status', 1);
        $query->condition('type', 'service');

        $entity_ids = $query->execute();
        // loads the entities
        $establishments = \Drupal::entityTypeManager()->getStorage('establishment')->loadMultiple($entity_ids);

        foreach ($establishments as $id => $entity) {
            $name = $entity->get('name')->value;
            $description = $entity->get('field_description')->value;

            if (stripos($description, $values['establishment']) !== false || stripos($name, $values['establishment']) !== false) {
                $locality = $entity->get('field_location')->locality;
                // checks if the location exists
                if (stripos($locality, $values['location']) !== false) {
                    $results[] = $entity;
                }
            }
        }

        if (empty($results)) {
            foreach ($establishments as $id => $entity) {
                $results[] = $entity;
            }
        }

        return $results;
    }

    /**
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function LocationAutocomplete(Request $request) {

        $results = array();
        $input = $request->query->get('q');

        // starts the query
        $query = \Drupal::entityQuery('establishment');
        $query->condition('status', 1);
        $query->condition('type', 'service');
        $entity_ids = $query->execute();
        // loads the entities
        $establishments = \Drupal::entityTypeManager()->getStorage('establishment')->loadMultiple($entity_ids);

        foreach ($establishments as $id => $entity) {
            $locality = $entity->get('field_location')->locality;

            if (stripos($locality, $input) !== false) {
                $results[] = [
                    'value' => $locality,
                    'hidden' => $id,
                    'label' => $locality];
            }
        }

        return new JsonResponse($results);
    }

    /**
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function EstablishmentAutocomplete(Request $request) {

        $results = array();
        $input = $request->query->get('q');

        // starts the query
        $query = \Drupal::entityQuery('establishment');
        $query->condition('status', 1);
        $query->condition('type', 'service');

        $entity_ids = $query->execute();
        // loads the entities
        $establishments = \Drupal::entityTypeManager()->getStorage('establishment')->loadMultiple($entity_ids);

        foreach ($establishments as $id => $entity) {
            $name = $entity->get('name')->value;
            $description = $entity->get('field_description')->value;

            if (stripos($description, $input) !== false || stripos($name, $input) !== false) {
                $results[] = [
                    'value' => $name,
                    'hidden' => $id,
                    'label' => $name];
            }
        }

        return new JsonResponse($results);
    }

}
