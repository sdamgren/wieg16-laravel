<?php

namespace App\Console\Commands;

use App\Group;
use App\GroupPrice;
use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products {file_name}';

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
     * @return mixed
     */
    public function handle()
    {
        /*//  Initiate curl
        $ch = curl_init();
        $url = "http://localhost/example/storage/app/products";
        $this->info("Importerar produkter" . $url);
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = json_decode(curl_exec($ch), true);
        // Closing
        curl_close($ch); */

        $file = $this->argument('file_name');

        $storage = Storage::get($file);
        $result = json_decode($storage, true);

        foreach ($result['groups'] as $group) {
            $groups = Group::findOrNew($group['customer_group_id']);
            $groups->fill($group);
            $groups->save();
        }

        foreach ($result['products'] as $product) {
            $this->info("Importerar produkter " . $product['entity_id']);
            $products = Product::findOrNew($product['entity_id']);
            if (isset($product['stock_item']) && is_array($product['stock_item'])) {
                $product['stock_item'] = array_shift($product['stock_item']);
            }
            $products->fill($product);
            $products->save();

            foreach ($product['group_prices'] as $group_price) {
                $group_prices = GroupPrice::findOrNew($group_price['price_id']);
                $group_price['product_id'] = $product['entity_id'];
                $group_prices->fill($group_price);
                $group_prices->save();

            }
        }

    }
}