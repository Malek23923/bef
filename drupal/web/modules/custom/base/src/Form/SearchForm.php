<?php

namespace Drupal\base\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Entity\EntityTypeRepository;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Session\PermissionsHashGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class SearchForm.
 */
class SearchForm extends FormBase {

    /**
     * Drupal\Core\Entity\EntityManager definition.
     *
     * @var \Drupal\Core\Entity\EntityManager
     */
    protected $entityManager;

    /**
     * Drupal\Core\Entity\EntityTypeManager definition.
     *
     * @var \Drupal\Core\Entity\EntityTypeManager
     */
    protected $entityTypeManager;

    /**
     * Drupal\Core\Entity\EntityTypeRepository definition.
     *
     * @var \Drupal\Core\Entity\EntityTypeRepository
     */
    protected $entityTypeRepository;

    /**
     * Drupal\Core\Entity\Query\QueryFactory definition.
     *
     * @var \Drupal\Core\Entity\Query\QueryFactory
     */
    protected $entityQuery;

    /**
     * Drupal\Core\Session\PermissionsHashGenerator definition.
     *
     * @var \Drupal\Core\Session\PermissionsHashGenerator
     */
    protected $userPermissionsHashGenerator;

    /**
     * Constructs a new SearchForm object.
     */
    public function __construct() {
        
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'search_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['#attributes'] = array('class' => 'searchbar ng-pristine ng-valid');
        $fomr['#prefix'] = ' <section class="cover-wrapper homepage-search"><div class="cover-background country-fr year-2017 month-7 week-29 day-19"></div>
                <div class="search-zone row-center">
                    <h1>Prenez un rendez-vous en ligne chez un Coiffeur ou un Esthéticien </h1><h4>C&#39;est immédiat, simple et gratuit.</h4>
                    <div id="doctor_search_bar" data-props="{&quot;queryInputProps&quot;:{&quot;defaultValue&quot;:null,&quot;speciality&quot;:null},&quot;placeInputProps&quot;:{&quot;defaultValue&quot;:null,&quot;place_id&quot;:null}}">
           ';
        $form['#suffix'] = '</div>
                </div>
            </section>';

        $form['establishment'] = [
            '#type' => 'textfield',
            '#autocomplete_route_name' => 'establishment.autocomplete',
            '#attributes' => array(
                'placeholder' => 'Coiffeur, Salon de coiffure, Esthéticien ...',
                'class' => array('searchbar-input searchbar-query-input')
            ),];

        $form['location'] = [
            '#type' => 'textfield',
            '#autocomplete_route_name' => 'location.autocomplete',
            '#attributes' => array(
                'placeholder' => 'Où ?',
                'class' => array('searchbar-input searchbar-place-input')
            ),];

        $form['time'] = [
            '#type' => 'select',
            '#options' => [
                "9h" => "9h",
                "10h" => "10h",
                "11h" => "11h",
                "12h" => "12h",
                "13h" => "13h",
                "14h" => "14h",
                "15h" => "15h",
                "16h" => "16h",
                "17h" => "17h",
                "18h" => "18h",
                "19h" => "19h",
                "20h" => "20h",
                "21h" => "21h",],
            '#attributes' => array('class' => array('searchbar-input searchbar-place-input')),];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('RECHERCHER >'),
            '#attributes' => array(
                'class' => array('Tappable-inactive dl-button-primary searchbar-submit-button dl-button dl-button-size-normal'),
                'style' => '-webkit-tap-highlight-color: rgba(0, 0, 0, 0); user-select: none; cursor: pointer;',
                'role' => 'button'
            ),];

        $form['#theme'] = 'search_form';

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $values = $form_state->getValues();

        $response = new RedirectResponse(\Drupal::url('search.results', [
                    'service' => isset($values['establishment']) && !empty($values['establishment']) ? $values['establishment'] : 'null',
                    'location' => isset($values['location']) && !empty($values['location']) ? $values['location'] : 'null',
                    'time' => isset($values['time']) && !empty($values['time']) ? $values['time'] : 'null'
        ]));



        $response->send();
        return;
    }

}
