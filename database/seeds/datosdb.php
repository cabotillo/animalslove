<?php

use Illuminate\Database\Seeder;

class datosdb extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Provincias

        DB::table('provincias')->insert([

            ['idProvincia'=> 'ES-C', 'Provincia'=> 'A Coruña'],
            ['idProvincia'=> 'ES-VI', 'Provincia'=> 'Álava'],
            ['idProvincia'=> 'ES-AB', 'Provincia'=> 'Albacete'],
            ['idProvincia'=> 'ES-A', 'Provincia'=> 'Alicante'],
            ['idProvincia'=> 'ES-AL', 'Provincia'=> 'Almería'],
            ['idProvincia'=> 'ES-O', 'Provincia'=> 'Asturias'],
            ['idProvincia'=> 'ES-AV', 'Provincia'=> 'Ávila'],
            ['idProvincia'=> 'ES-BA', 'Provincia'=> 'Badajoz'],
            ['idProvincia'=> 'ES-PM', 'Provincia'=> 'Islas Baleares'],
            ['idProvincia'=> 'ES-B', 'Provincia'=> 'Barcelona'],
            ['idProvincia'=> 'ES-BI', 'Provincia'=> 'País Vasco'],
            ['idProvincia'=> 'ES-BU', 'Provincia'=> 'Burgos'],
            ['idProvincia'=> 'ES-CC', 'Provincia'=> 'Cáceres'],
            ['idProvincia'=> 'ES-CA', 'Provincia'=> 'Cádiz'],
            ['idProvincia'=> 'ES-S', 'Provincia'=> 'Cantabria'],
            ['idProvincia'=> 'ES-CS', 'Provincia'=> 'Castelló'],
            ['idProvincia'=> 'ES-CR', 'Provincia'=> 'Ciudad Real'],
            ['idProvincia'=> 'ES-CO', 'Provincia'=> 'Córdoba'],
            ['idProvincia'=> 'ES-CU', 'Provincia'=> 'Cuenca'],
            ['idProvincia'=> 'ES-SS', 'Provincia'=> 'Gipuzkoa'],
            ['idProvincia'=> 'ES-GI', 'Provincia'=> 'Gerona'],
            ['idProvincia'=> 'ES-GR', 'Provincia'=> 'Granada'],
            ['idProvincia'=> 'ES-GU', 'Provincia'=> 'Guadalajara'],
            ['idProvincia'=> 'ES-H', 'Provincia'=> 'Huelva'],
            ['idProvincia'=> 'ES-HU', 'Provincia'=> 'Huesca'],
            ['idProvincia'=> 'ES-J', 'Provincia'=> 'Jaén'],
            ['idProvincia'=> 'ES-LO', 'Provincia'=> 'La Rioja'],
            ['idProvincia'=> 'ES-GC', 'Provincia'=> 'Las Palmas'],
            ['idProvincia'=> 'ES-LE', 'Provincia'=> 'León'],
            ['idProvincia'=> 'ES-L', 'Provincia'=> 'Lérida'],
            ['idProvincia'=> 'ES-LU', 'Provincia'=> 'Lugo'],
            ['idProvincia'=> 'ES-M', 'Provincia'=> 'Madrid'],
            ['idProvincia'=> 'ES-MA', 'Provincia'=> 'Málaga'],
            ['idProvincia'=> 'ES-MU', 'Provincia'=> 'Murcia'],
            ['idProvincia'=> 'ES-NA', 'Provincia'=> 'Navarra'],
            ['idProvincia'=> 'ES-OR', 'Provincia'=> 'Ourense'],
            ['idProvincia'=> 'ES-P', 'Provincia'=> 'Palencia'],
            ['idProvincia'=> 'ES-PO', 'Provincia'=> 'Ponatevedra'],
            ['idProvincia'=> 'ES-SA', 'Provincia'=> 'Salamanca'],
            ['idProvincia'=> 'ES-TF', 'Provincia'=> 'Santa Cruz de Tenerife'],
            ['idProvincia'=> 'ES-SG', 'Provincia'=> 'Segovia'],
            ['idProvincia'=> 'ES-SE', 'Provincia'=> 'Sevilla'],
            ['idProvincia'=> 'ES-SO', 'Provincia'=> 'Soria'],
            ['idProvincia'=> 'ES-T', 'Provincia'=> 'Tarragona'],
            ['idProvincia'=> 'ES-TE', 'Provincia'=> 'Teruel'],
            ['idProvincia'=> 'ES-TO', 'Provincia'=> 'Toledo'],
            ['idProvincia'=> 'ES-V', 'Provincia'=> 'Valencia'],
            ['idProvincia'=> 'ES-VA', 'Provincia'=> 'Valladolid'],
            ['idProvincia'=> 'ES-ZA', 'Provincia'=> 'Zamora'],
            ['idProvincia'=> 'ES-Z', 'Provincia'=> 'Zaragoza'],
            ['idProvincia'=> 'ES-CE', 'Provincia'=> 'Ceuta'],
            ['idProvincia'=> 'ES-ML', 'Provincia'=> 'Melilla']

        ]);

        DB::table('users')->insert([

            ['Nombre' => 'Jose', 'Apellidos' => 'Santacruz Maza', 'Login' => 'josesm', 'Password' => '$2y$10$KKG0.5kym5cGM.XhtHzAP.Alrr8EnY9vmupTXeFbcYHO2mT3VOv12', 'Email' => 'josesm@gmail.com', 'Telefono' => 648915945, 'Provincia' => 'Barcelona' , 'Avatar' => 'a.jpg', 'Tipo' =>1],

            ['Nombre' => 'Maria', 'Apellidos' => 'Pelegrin Teijeiro', 'Login' => 'mariapt', 'Password' => '$2y$10$KKG0.5kym5cGM.XhtHzAP.Alrr8EnY9vmupTXeFbcYHO2mT3VOv12', 'Email' => 'mariapt@gmail.com', 'Telefono' => 654321987, 'Provincia' => 'Salamanca' , 'Avatar' => 'a.jpg', 'Tipo' =>1],

            ['Nombre' => 'Aurora', 'Apellidos' => 'Valero Nogales', 'Login' => 'auroravn', 'Password' => '$2y$10$KKG0.5kym5cGM.XhtHzAP.Alrr8EnY9vmupTXeFbcYHO2mT3VOv12', 'Email' => 'auroravn@gmail.com', 'Telefono' => 6987654321, 'Provincia' => 'Islas Baleares' , 'Avatar' => 'a.jpg', 'Tipo' =>1],

            ['Nombre' => 'Mario', 'Apellidos' => 'Segui Barber', 'Login' => 'mariosb', 'Password' => '$2y$10$KKG0.5kym5cGM.XhtHzAP.Alrr8EnY9vmupTXeFbcYHO2mT3VOv12', 'Email' => 'mariosb@gmail.com', 'Telefono' => 652547863, 'Provincia' => 'Islas Baleares' , 'Avatar' => 'a.jpg', 'Tipo' =>1],

            ['Nombre' => 'Nerea', 'Apellidos' => 'Lemos Carpio', 'Login' => 'nerealm', 'Password' => '$2y$10$KKG0.5kym5cGM.XhtHzAP.Alrr8EnY9vmupTXeFbcYHO2mT3VOv12', 'Email' => 'nerealm@gmail.com', 'Telefono' => 625478550, 'Provincia' => 'Murcia' , 'Avatar' => 'a.jpg', 'Tipo' =>1],
        ]);


    }
}
