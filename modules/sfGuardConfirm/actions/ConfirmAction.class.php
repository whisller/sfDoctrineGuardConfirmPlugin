<?php
/**
 * Action that allow user to confirm anything that you want ;')
 *
 * @package    sfDoctrineGuardConfirmPlugin
 * @subpackage modules.sfGuardConfirm.actions
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class ConfirmAction extends sfAction
{
    /**
     * @param sfWebRequest $request
     */
    public function execute($request)
    {
        $hash = (string)$request->getParameter('hash');
        $kind = (string)$request->getParameter('kind');

        $sfGuardConfirm = sfGuardConfirmTable::getInstance()->findOneActiveByHash($hash, sfConfig::get('app_sfDoctrineGuardConfirmPlugin_expire_'.$kind, 604800));

        $this->forward404Unless($sfGuardConfirm instanceof sfGuardConfirm);

        $sfGuardConfirm->setConfirm(true);
        $sfGuardConfirm->save();

        $this->dispatcher->notify(new sfEvent($sfGuardConfirm, 'sf_doctrine_guard_confirm_plugin.confirm_success', array('hash' => $hash, 'kind' => $kind)));

        $url = sfConfig::get('app_sfDoctrineGuardConfirmPlugin_success_confirm_url_'.$kind, '@homepage');
        if ($url) {
            $this->redirect($url);
        }
    }
}