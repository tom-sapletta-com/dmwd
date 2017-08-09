<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2017-08-01
 * Time: 16:20
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Medoo\Medoo;
use versandstatistik\Db;
use versandstatistik\Invoice;
use versandstatistik\Invoice\ShipDateRange;
use versandstatistik\Invoice\Status;
use versandstatistik\Invoice\ShippingProvider;
use versandstatistik\Invoice\TrackingID;

$db = new Db(
    new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'versandstatistik',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ])
);

// get Invoices from DB Table
$invoices = new Invoice($db);
$invoices->addFilter(new ShipDateRange('2017-01-05 00:00:00', '2017-01-05 23:59:59'));
//$invoices->addFilter( new Status('AUS') );
$invoices->addFilter(new Status('EIN'));
$data_today = $invoices->getFiltered();

// show Filtered Data
print_r($data_today);

// Show Provider Name By Number
foreach($data_today as $row){
    $trackingID = new TrackingID($row['TrackingID']);
    $ProviderNameArray = [
        '441' => 'DHL',
        '442' => 'HERMES',
    ];
    $shippingProvider = new ShippingProvider($trackingID, $ProviderNameArray);
    echo $shippingProvider->getProviderName() . "\n" . "<br/>";
}

