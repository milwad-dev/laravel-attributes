<?php

return [
    /*
     * Table config
     *
     * Here it's a config of migrations.
     */
    'tables' => [
        /*
         * Get table name of migration.
         */
        'name' => 'attributes',

        /*
         * Use uuid as primary key.
         */
        'uuids' => false, // Also in beta !!!
    ],

    /*
     * Model class name for attributes table.
     */
    'attributes_model' => \Milwad\LaravelAttributes\Attribute::class,
];
