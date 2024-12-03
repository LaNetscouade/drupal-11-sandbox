<?php

namespace Drupal\ap_example\Access;

use Drupal\ap_example\Cache\PirateDayCacheContext;
use Drupal\Core\Session\AccessPolicyBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Session\CalculatedPermissionsItem;
use Drupal\Core\Session\RefinableCalculatedPermissionsInterface;

/**
 * Allows people to talk like a pirate on Pirate Day.
 */
final class PirateDayAccessPolicy extends AccessPolicyBase {

  /**
   * {@inheritdoc}
   */
  public function calculatePermissions(AccountInterface $account, string $scope): RefinableCalculatedPermissionsInterface {
    $calculated_permissions = parent::calculatePermissions($account, $scope);

    if (!PirateDayCacheContext::isPirateDay()) {
      return $calculated_permissions;
    }

    return $calculated_permissions->addItem(new CalculatedPermissionsItem(['talk like a pirate']));
  }

  /**
   * {@inheritdoc}
   */
  public function getPersistentCacheContexts(): array {
    return ['pirate_day'];
  }

}