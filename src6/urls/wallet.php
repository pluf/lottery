<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/wallets/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_Wallet'
        )
    ),
    // ************************************************************* Wallet
    array( // Create
        'regex' => '#^/wallets$#',
        'model' => 'Lottery_Views_Wallet',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/wallets$#',
        'model' => 'Lottery_Views_Wallet',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/wallets/(?P<modelId>\d+)$#',
        'model' => 'Lottery_Views_Wallet',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
);


