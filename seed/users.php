<?php

require("../vendor/autoload.php");
require('../config/database.php');

$faker = Faker\Factory::create();

for ($i=1; $i <=50; $i++) {
    
    $q = $db->prepare("INSERT INTO users(name, pseudo, email, password, active, created_at, 
                       city, country, sex, available_for_hire, bio)
                       VALUES(:name, :pseudo, :email, :password, :active, :created_at,
                       :city, :country, :sex, :available_for_hire, :bio)
                        ");
    $q->execute([
        'name' => $faker->unique()->name, 
        'pseudo' => $faker->unique()->userName, 
        'email' => $faker->unique()->email, 
        'password' => password_hash('123456', PASSWORD_BCRYPT), 
        'active' => 1,
        'created_at' => $faker->date().' '.$faker->time(),
        'city' => $faker->unique()->city, 
        'country' => $faker->unique()->country,         
        'sex' => $faker->randomElement(['H', 'F']), 
        'available_for_hire' => $faker->randomElement([0, 1]), 
        'bio' => $faker->paragraph()
    ]);
}

echo 'Users added !';
