<?php

namespace App\Console\Commands;

use App\Address;
use App\Company;
use Illuminate\Console\Command;
use App\Customer;

class ImportCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers';

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
        //  Initiate curl
        $ch = curl_init();
        $url = "https://www.milletech.se/invoicing/export/customers";
        $this->info("Importera dina kunder".$url);
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = json_decode (curl_exec($ch), true);
        // Closing
        curl_close($ch);

        foreach ($result as $customer) {
            $this->info("Uppdatera en kund eller lägg till en ny via id:".$customer['id']);
            $dbCustomer = Customer::findOrNew($customer['id']);
            $dbCustomer->fill($customer)->save();

            if (isset($customer['address']) && is_array($customer['address'])) {
                $this->info("Uppdatera en adress eller lägg till en ny via id:" . $customer['address']['id']);
                $address = Address::findOrNew($customer['address']['id']);
                $address->fill($customer['address'])->save();
            }

            if ($dbCustomer->customer_company != null) {
                $company = Company::firstOrNew(['company_name' => $dbCustomer->customer_company]);
                $company->save();

                // UPDATE customers SET company_id = $company->id WHERE customer_company = $company->company_name
                \DB::table('customers')
                    ->where("customer_company", "=", $company->company_name)
                    ->update(["company_id" => $company->id]);
            }
        }


    }
}



    /*
    $users = User::all();
    $post =Post::find(1);
    $post->comments()->where("user_id", "=", 1);
    $post->comments;
    foreach ($users as $user) {
        $user->phone->phone_number;
        $user->comments;
    }*/
