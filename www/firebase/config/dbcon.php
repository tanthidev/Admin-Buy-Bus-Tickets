<?php 
    require '../vendor/autoload.php';

    use Kreait\Firebase\Factory;

    $factory = (new Factory())
        ->withDatabaseUri('https://fir-f802f-default-rtdb.asia-southeast1.firebasedatabase.app/');
    $database = $factory -> createDatabase();


    // $test = [
    //     'name' => 'Thi',
    //     'mail' => 'tanthi',
    // ];

    // $database -> getReference("Users") -> push($test);
?>