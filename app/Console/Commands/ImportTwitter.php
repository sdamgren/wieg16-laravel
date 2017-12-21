<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;

class ImportTwitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tweets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing tweets';

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
     * @return mixed
     */
    public function handle()
    {


    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q=metoo",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer AAAAAAAAAAAAAAAAAAAAAM6r3QAAAAAA0w8ewQKY94tSXVvsZ%2FdE2W6xEGs%3Dv1m0JoJxtB8cFJ33ENVtfgv8WD33h7Y3iQs8n4Y0lJM2QBDJzY",
            "cache-control: no-cache",
            "postman-token: 4c658095-70c1-16a1-6dd3-63c2ad8b6424"
        ),
    ));


        $response = json_decode(curl_exec($curl), true);

        foreach ($response['statuses'] as $data) {
            $this->info("Importing tweets: ".$data['id']);
            $tweets = Tweet::findOrNew($data['id']);
            $tweets->fill([
                "id" => $data['id'],
                "text" => $data['text']]);
            $tweets->save();

        }
    }
}
