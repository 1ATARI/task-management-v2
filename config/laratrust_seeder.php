<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'departments' => 'c,r,u,d',
            'tasks' =>  'c,r,u,d',
            'profile' =>  'r,u'

        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'departments' => 'c,r,u,d',
            'tasks' =>  'c,r,u,d',
            'profile' => 'r,u'
        ],
        'manager' => [
            'users' => 'r',
            'tasks' =>  'c,r,u,d',
        ],

        'user' => [
            'profile' => 'r,u',
            'tasks'=>'r,u'
        ],

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
