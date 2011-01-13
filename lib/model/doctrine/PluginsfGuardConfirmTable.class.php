<?php

/**
 * PluginsfGuardConfirmTable
 *
 * @package    sfDoctrineGuardConfirmPlugin
 * @subpackage model
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class PluginsfGuardConfirmTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginsfGuardConfirmTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginsfGuardConfirm');
    }

    /**
     * Find record by its hash
     *
     * @param  String  $hash
     * @param  Integer $expireAt
     *
     * @return sfGuardConfirmRegister
     *
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    public function findOneActiveByHash($hash, $expireAt = null)
    {
        $query = $this->createQuery('sgc')
                      ->where('sgc.hash = ?',       array($hash))
                      ->addWhere('sgc.confirm = ?', false);

        if (null !== $expireAt) {
            $query->addWhere('sgc.created_at + ? > now()', $expireAt);
        }

        $query->addOrderBy('sgc.created_at DESC');

        return $query->fetchOne();
    }

    /**
     * Find record by its kind
     *
     * @param  String  $kind
     * @param  Integer $expireAt
     *
     * @return sfGuardConfirmRegister
     *
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    public function findOneActiveByKind($kind, $expireAt = null)
    {
        $query = $this->createQuery('sgc')
                      ->where('sgc.kind = ?',       array($kind))
                      ->addWhere('sgc.confirm = ?', false);

        if (null !== $expireAt) {
            $query->addWhere('sgc.created_at + ? > now()', $expireAt);
        }

        $query->addOrderBy('sgc.created_at DESC');

        return $query->fetchOne();
    }

    /**
     * Create new sfGuardConfirm object
     *
     * @param sfGuardUser $sfGuardUser
     * @param String $kind
     *
     * @return sfGuardConfirm
     *
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    public function createNewConfirm(sfGuardUser $sfGuardUser, $kind, $conn = null)
    {
        $sfGuardConfirm = new sfGuardConfirm();
        $sfGuardConfirm->setSfGuardUserId($sfGuardUser->getId());
        $sfGuardConfirm->setHash(sha1(mt_rand(5,15).microtime().uniqid().microtime().mt_rand(5,15)));
        $sfGuardConfirm->setKind($kind);
        $sfGuardConfirm->save($conn);

        return $sfGuardConfirm;
    }
}