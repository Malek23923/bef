<?php

namespace Drupal\base\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Establishment entities.
 *
 * @ingroup base
 */
interface EstablishmentInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Establishment name.
   *
   * @return string
   *   Name of the Establishment.
   */
  public function getName();

  /**
   * Sets the Establishment name.
   *
   * @param string $name
   *   The Establishment name.
   *
   * @return \Drupal\base\Entity\EstablishmentInterface
   *   The called Establishment entity.
   */
  public function setName($name);

  /**
   * Gets the Establishment creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Establishment.
   */
  public function getCreatedTime();

  /**
   * Sets the Establishment creation timestamp.
   *
   * @param int $timestamp
   *   The Establishment creation timestamp.
   *
   * @return \Drupal\base\Entity\EstablishmentInterface
   *   The called Establishment entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Establishment published status indicator.
   *
   * Unpublished Establishment are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Establishment is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Establishment.
   *
   * @param bool $published
   *   TRUE to set this Establishment to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\base\Entity\EstablishmentInterface
   *   The called Establishment entity.
   */
  public function setPublished($published);

}
