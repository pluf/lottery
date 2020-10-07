<?php

/**
 * Defines a bet in a lottery game 
 * 
 */
class Lottery_Referral extends Pluf_Model
{

    /**
     * Loads data model
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'lottery_referrals';
        $this->_a['verbose'] = 'Lottery Referral';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Sequence',
                'blank' => false,
                'is_null' => false,
                'editable' => false,
                'readable' => true
            ),
            'code' => array(
                'type' => 'Varchar',
                'blank' => false,
                'is_null' => false,
                'unique' => true,
                'size' => 256,
                'editable' => false,
                'readable' => true
            ),
            /*
             * Relations
             */
            'account_id' => array(
                // TODO: hadi, we should decide to unique this field or not
                'type' => 'Foreignkey',
                'model' => 'Lottery_Account',
                'blank' => false,
                'is_null' => false,
                'name' => 'account',
                'graphql_name' => 'account',
                'relate_name' => 'referall_codes',
                'editable' => false,
                'readable' => true
            ),
            'referral_id' => array(
                'type' => 'Foreignkey',
                'model' => 'Lottery_Referral',
                'blank' => false,
                'is_null' => false,
                'name' => 'referral',
                'graphql_name' => 'referral',
                'relate_name' => 'referreds',
                'editable' => false,
                'readable' => true
            )
        );
    }

}