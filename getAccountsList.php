<?php
$clientId = "";// client Id
$endpoint = "https://cloud.gravityzone.bitdefender.com/api/v1.0/jsonrpc/accounts";
$response = sendRequest($clientId, $endpoint);
echo "Response from API: " . $response . "\r\n";
function sendRequest($clientId, $endpoint)
{
    $api_key = ":";// API key followed by :
    $auth_key = base64_encode($api_key);
    $curl = curl_init($endpoint);
    curl_setopt($curl, CURLOPT_URL, $endpoint);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        "Content-Type:application/json",
        "Authorization: Basic ".$auth_key
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = array(
        "id" => $clientId,
        "jsonrpc" => "2.0",
        "method" => "getAccountsList",
        "params" => array(
            "page"=>1,  "perPage"=>20
        ));
    $testdata = json_encode($data);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $testdata);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;

}
