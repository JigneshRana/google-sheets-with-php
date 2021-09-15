<?php
require ('settings.php');
require $setting['vendor_location']. '/vendor/autoload.php';
class Gsheet{
    public $settings;
    public $client;
    function __construct($settings) {
        $this->settings = $settings;
        $this->client = new Google_Client();
        $this->client->setApplicationName('Google Sheets API PHP Quickstart');
        $this->client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $this->client->setAuthConfig($this->settings['intsec'].'credentials.json');
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
    }
    function readSheet(){
        // Get the API client and construct the service object.
        $service = new Google_Service_Sheets($this->client);
    
        // Prints the names and majors of students in a sample spreadsheet:
        // https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
        $spreadsheetId = '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms';
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
    }
    function updateSheet(){

        $service = new Google_Service_Sheets($this->client);
        $spreadsheetId = '1pg8X8X8bWfQ8Eu_fmOFacyGC-CEqcVpDEotrVGx_OXE';
        $range = "Class Data!A2:B2";
        $values = [
                ["jignesh1","Male"],
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
    }
    function appendRow(){
        $service = new Google_Service_Sheets($this->client);
        $spreadsheetId = '1pg8X8X8bWfQ8Eu_fmOFacyGC-CEqcVpDEotrVGx_OXE';
        $range = "Class Data";
        $values = [
                ["This","is","a","new","Row","a","b","c"],
        ];
        $body = new Google_Service_Sheets_ValueRange([
        'values'=> $values
        ]);
        $params = [
            'valueInputOption' => "RAW"
        ];
        $insert = [
    
            "insertDataOption" => "Insert_Rows"
        ];
        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
    }


}

$gs = New Gsheet($setting);
$gs->updateSheet();
exit;

/*if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}*/