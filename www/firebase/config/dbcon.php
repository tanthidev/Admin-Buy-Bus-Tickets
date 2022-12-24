<?php 
    require './firebase/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Auth;
    use Google\Cloud\Storage\StorageClient;

    $factory = (new Factory())
        ->withServiceAccount('./firebase/config/fir-f802f-firebase-adminsdk-mcrfo-932b514f23.json')
        ->withDatabaseUri('https://fir-f802f-default-rtdb.asia-southeast1.firebasedatabase.app/');

    $storage = new StorageClient([
        'keyFilePath' => './firebase/config/fir-f802f-firebase-adminsdk-mcrfo-932b514f23.json',
    ]);

    $database = $factory -> createDatabase();
    $auth = $factory -> createAuth();

?>