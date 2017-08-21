<?php

namespace Drupal\base\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Establishment type entity.
 *
 * @ConfigEntityType(
 *   id = "establishment_type",
 *   label = @Translation("Establishment type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\base\EstablishmentTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\base\Form\EstablishmentTypeForm",
 *       "edit" = "Drupal\base\Form\EstablishmentTypeForm",
 *       "delete" = "Drupal\base\Form\EstablishmentTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\base\EstablishmentTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "establishment_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "establishment",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/establishment_type/{establishment_type}",
 *     "add-form" = "/admin/structure/establishment_type/add",
 *     "edit-form" = "/admin/structure/establishment_type/{establishment_type}/edit",
 *     "delete-form" = "/admin/structure/establishment_type/{establishment_type}/delete",
 *     "collection" = "/admin/structure/establishment_type"
 *   }
 * )
 */
class EstablishmentType extends ConfigEntityBundleBase implements EstablishmentTypeInterface {

  /**
   * The Establishment type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Establishment type label.
   *
   * @var string
   */
  protected $label;

}
