<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Consumer extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:take';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $callback = function ($msg) {

         $data = json_decode($msg->body,true);

         dd($data) ;

        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        try {

            $channel->consume();

        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
