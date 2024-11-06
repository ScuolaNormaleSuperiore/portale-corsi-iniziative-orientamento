<?php

return array(
    /*
      |--------------------------------------------------------------------------
      | Cupparis Queue
      |--------------------------------------------------------------------------
      |
      |
     */


    'controller-namespace' => "Gecche\\Cupparis\\Queue\\Http\\Controllers",
    'routes-prefix' => 'queue',
    'model' => "Gecche\\Cupparis\\Queue\\Models\\ActivityQueue",
    'storage-folder' => 'files/queues',

    'queues' => [
        'test' => \Gecche\Cupparis\Queue\TestQueue::class,
        'datafile' => \Gecche\Cupparis\Datafile\DatafileQueue::class,
    ],
);

