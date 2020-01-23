<?php

return [

    'management' => [
        'index' => [
            'empty' => [
                'title' => 'Seems like you have no versions installed yet.',
                'text' => 'If you want you can click the "'.trans('navigation.topnav.add_new').'" button.',
            ],

            'buttons' => [
                'delete' => 'Delete',
                'reinstall' => 'Re-install',
                'frontend' => 'Frontend',
                'backend' => 'Backend',
                'storefront' => 'Storefront',
                'admin' => 'Admin',
            ],

            'meta' => [
                'major' => 'Major:',
                'version' => 'Version:',
                'directory' => 'Directory:',
                'path' => 'Path:'
            ]
        ],

        'create' => [
            'headline' => 'Create new Shopware instance',
            'close' => 'Close',
            'create' => 'Create',

            'form' => [
                'version' => 'Select your Shopware Version:',
                'directory' => 'Set your directory name:',
                'placeholder' => '...'
            ],

        ],
    ],

];
