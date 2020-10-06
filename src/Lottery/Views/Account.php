<?php

class Lottery_Views_Account extends Pluf_Views
{

    public function createAccount($request, $match, $param)
    {
        // Create account
        if (! isset($param)) {
            $param = [];
        }
        $param['model'] = 'Lottery_Account';
        $account = parent::createObject($request, $match, $param);
        // Create Profile
        $profile = new Lottery_Profile();
        $profile->account_id = $account;
        $profile->is_active = true;
        $profile->create();
        // Create Wallet
        $wallet = new Lottery_Wallet();
        $wallet->title = 'CoinCodile Wallet';
        $wallet->account_id = $account;
        $wallet->create();
        
        $account->profile = $profile;
        $account->wallet = $wallet;
        return $account;
    }
    
}
