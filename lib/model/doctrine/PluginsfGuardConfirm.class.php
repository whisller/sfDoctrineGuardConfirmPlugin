<?php

/**
 * PluginsfGuardConfirm
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    sfDoctrineGuardConfirmPlugin
 * @subpackage model
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
abstract class PluginsfGuardConfirm extends BasesfGuardConfirm
{
    /**
     * Default name what can be use when user want confirm registration
     *
     * @var    String
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    const KIND_REGISTER     = 'register';

    /**
     * Default name what can be use when user want confirm change mail
     *
     * @var    String
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    const KIND_CHANGE_EMAIL = 'change_email';

    /**
     * @see    Doctrine_Record::preInsert()
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    public function preInsert($event)
    {
        parent::preInsert($event);

        // setup hash for this object
        $this->setHash(sha1(mt_rand(5,15).microtime().uniqid().microtime().mt_rand(5,15)));
    }
}