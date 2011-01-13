<?php
/**
 * sfDoctrineGuardConfirmPlugin configuration.
 *
 * @package    sfDoctrineGuardConfirmPlugin
 * @subpackage config
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class sfDoctrineGuardConfirmPluginConfiguration extends sfPluginConfiguration
{
    /**
     * @see sfPluginConfiguration
     */
    public function initialize()
    {
        if (sfConfig::get('app_sf_guard_confirm_plugin_routes_register', true) && in_array('sfGuardConfirm', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('sfGuardConfirmRouting', 'listenToRoutingLoadConfigurationEvent'));
        }
    }
}