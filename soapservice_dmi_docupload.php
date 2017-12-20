<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require 'aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

/*User id:-dmi-wishfin
Password:- Dmi-wishfin
URL to access:- https://dmifinance.signin.aws.amazon.com/console/s3 
Secret access key:- NUCbctzwyYZtQvfEQdilE2gEw8un9EVTzHY4lYSu
Access key id:- AKIAI56AYH27B3IBRXXQ
*/

$DMI_S3_BUCKET="dmi-partner2";
$DMI_S3_SECRET="NUCbctzwyYZtQvfEQdilE2gEw8un9EVTzHY4lYSu";
$DMI_S3_KEY="AKIAI56AYH27B3IBRXXQ";

//$to_url = 'transaction_documents/Transaction_' . $fb_transaction_id . '/' . $document_filename; / AWS path /
$from_url = "/home/deal4loans/public_html/new-images/travel.jpg"; /*Local machine file path */
$s3 = S3Client::factory(array(
            'signature' => 'v4',
            'region' => 'ap-south-1',
            'version' => 'latest',
            'credentials' => array(
                'key' => $DMI_S3_KEY,
                'secret' => $DMI_S3_SECRET,
            ),
            //'http' => array('verify' => false),
));
$result = $s3->putObject(array(
    'Bucket' => $DMI_S3_BUCKET,
    'Key' => 'd4lfile.txt',
    'SourceFile' => $from_url,
    'ContentType' => 'image/jpeg',
        // 'ACL'    => 'public-read', 
));


print_r($result);
