<?php

namespace Drupal\base\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EstablishmentTypeForm.
 */
class EstablishmentTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $establishment_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $establishment_type->label(),
      '#description' => $this->t("Label for the Establishment type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $establishment_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\base\Entity\EstablishmentType::load',
      ],
      '#disabled' => !$establishment_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $establishment_type = $this->entity;
    $status = $establishment_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Establishment type.', [
          '%label' => $establishment_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Establishment type.', [
          '%label' => $establishment_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($establishment_type->toUrl('collection'));
  }

}
