<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produit::truncate();
  
        $json = File::get("database/data_json/electronic-catalog.json");
        $produits_users_json = json_decode($json);


        foreach ($produits_users_json as $key => $valueglb) {
            if($key=='products')
                {
                foreach ($valueglb as $key1 => $value) {
                Produit::create([
                "name" => $value->name,
                "category" => $value->category,
                "sku" => $value->sku,
                "price" => $value->price,
                "quantity" => $value->quantity
                                 ]);
                                                        }
                }else if($key=='users')
                {   
                    foreach ($valueglb as $key2 => $value) {
                        User::create([
                            "name" => $value->name,
                            "email" => $value->email,
                            
                        ]);  
                                    }
                                                    }

             
        }
    }
}
