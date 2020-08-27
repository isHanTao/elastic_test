<?php

namespace App\Console\Commands;

use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Imagick;
use Intervention\Image\Facades\Image;

class ElasticTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hosts = config('scout.elasticsearch.host');
        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        $indexs = [
            [
                'index' => 'sentence',
                'body' => [
                    'settings' => [
                        'number_of_shards' => 2,
                        'number_of_replicas' => 0
                    ],
                    'mappings' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'title' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ],
                            'from' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ],
                            'creator' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ],
                        ]
                    ]
                ]
            ],
            [
                'index' => 'author',
                'body' => [
                    'settings' => [
                        'number_of_shards' => 2,
                        'number_of_replicas' => 0
                    ],
                    'mappings' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'name' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ],
                            'desc' => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        foreach ($indexs as $index){
            if ($client->indices()->exists(['index'=>$index['index']])){
                $client->indices()->delete(['index'=>$index['index']]);
            }
            $res = $client->indices()->create($index);
            $this->comment('生成成功'.$res['index']);
        }
    }
}
