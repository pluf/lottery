<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/accounts/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_Account'
        )
    ),
    // ************************************************************* Account
    array( // Read (list)
        'regex' => '#^/accounts$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_Account',
            'sql' => 'is_deleted=false'
        )
    ),
    array( // Read
        'regex' => '#^/accounts/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Lottery_Account',
            'sql' => 'is_deleted=false'
        )
    ),
);