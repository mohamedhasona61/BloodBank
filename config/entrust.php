<?php

/**
 * This file is part of Laravel Entrust,
 * Handle Role-based Permissions for Laravel.
 * 
 */

return [


    'migrationSuffix' => 'laravel_entrust_setup_tables',


    'user_model' => 'App\Models\User',

 
    'user_table' => 'users',

   
    'models' => [
        'role'          => 'App\Models\Role',
        'permission'    => 'App\Models\Permission',
    ],


    'defaults' => [
        'guard'          => 'web',
    ],

    'tables' => [
        'roles'             => 'roles',
        'permissions'       => 'permissions',
        'role_user'         => 'role_user',
        'permission_role'   => 'permission_role',
    ],


    'foreign_keys' => [
        'user' => 'user_id',
        'role' => 'role_id',
        'permission' => 'permission_id',
    ],


    'middleware' => [
     
        'register' => true,

      
        'handling' => 'abort',

        'handlers' => [
          
            'abort' => [
                'code' => 403,
                'message' => 'You don\'t Have a permission to Access this page.'
            ],

       
            'redirect' => [
                'url' => '/',
                'message' => [
                    'key' => 'error',
                    'content' => 'You don\'t Have a permission to Access this page'
                ]
            ],
        ],
    ],
];