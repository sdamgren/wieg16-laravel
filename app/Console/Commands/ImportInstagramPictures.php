<?php

namespace App\Console\Commands;

use App\InstagramPicture;
use Illuminate\Console\Command;

class ImportInstagramPictures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:instagrampictures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importera instagrambilder';

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
            CURLOPT_URL => "https://api.instagram.com/v1/users/self/media/recent?access_token=654720922.f63ae03.76b74073873940f08dc115323a5adbcc",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 2f970be5-f48b-7d82-88a6-e9c255ae7770"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $result = json_decode($response, true);

        foreach ($result['data'] as $instagramId) {
            $this->info("Importing/update instagrampictures with id: " . $instagramId['id']);


            $dbInstagramId = InstagramPicture::findOrNew($instagramId['id']);
            $dbInstagramId->fill([
                'id' => $instagramId['id'],
                'url' => $instagramId['images']['standard_resolution']['url']
            ])->save();
        }
    }
}
