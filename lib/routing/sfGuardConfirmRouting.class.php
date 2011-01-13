<?php
/**
 * Class is adding routing for plugin
 *
 * @package    sfDoctrineGuardConfirmPlugin
 * @subpackage lib.routing
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class sfGuardConfirmRouting
{
    /**
     * Listens to the routing.load_configuration event.
     *
     * @param sfEvent An sfEvent instance
     */
    static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
    {
        $r = $event->getSubject();

        // preprend our routes

        // add route for action to confirm by user
        $r->prependRoute('sf_doctrine_guard_confirm_plugin', new sfRoute('/sf_guard_confirm/:hash/:kind', array('module' => 'sfGuardConfirm',
                                                                                                                'action' => 'Confirm')));
    }
}