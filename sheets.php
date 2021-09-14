<?php
require __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
$client->setApplicationName('Google Sheets API PHP Quickstart');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$client->setAuthConfig('credentials.json');
$client->setAccessType('offline');
#$client->setPrompt('select_account consent');



// Get the API client and construct the service object.
#$client = getClient();
$service = new Google_Service_Sheets($client);

$spreadsheetId = '1Nquc7Hdpoh85BFdH8z5Oejp1k0rVcnFExzkuoohlvMw';
$range = "congress!E2:F2";
$values = [
        ["jignesh","rana"],
];
$body = new Google_Service_Sheets_ValueRange([
'values'=> $values
]);
$params = [
    'valueInputOption' => "RAW"
];
$result = $service->spreadsheets_values->update(
    $spreadsheetId,
    $range,
    $body,
    $params
);
/*


// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit

$spreadsheetId = '1pg8X8X8bWfQ8Eu_fmOFacyGC-CEqcVpDEotrVGx_OXE';

//Get Values
$range = 'Class Data!A2:E';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    print "Name, Major:\n";
    foreach ($values as $row) {
        // Print columns A and E, which correspond to indices 0 and 4.
        printf("%s, %s\n", $row[0], $row[4]);
    }
}

*/

?>