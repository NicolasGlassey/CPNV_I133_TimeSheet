<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : TimeSheet
 * Created  : 11.01.2019 - 21:44
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */


//read file
require 'IOFile.php';
$fileFullPath = setFullPath("data.csv");
$fileContent = readCSVFile($fileFullPath);

//declare and set variables
$GuiTable = createGuiTableFromCSV($fileContent);

//functions
function createGuiTableFromCSV($fileContent)
{
    $header = true;
    $tableHeader = "";
    $tableRecords = "";

    foreach ($fileContent as $csvRecord)
    {
        if ($header == true)
        {
            $tableHeader = createGuiTableHeader($fileContent);
        }

        if ($header != true)
        {
            $tableRecords = $tableRecords . '<tr>';
            $record = str_getcsv($csvRecord[0], ";");

            foreach ($record as $field)
            {
                $tableRecords = $tableRecords . '<td>' . $field;
            }
            $tableRecords = $tableRecords . '<td><button type="Submit">Submit</button></td><td><button type=""button">Reset</button></td></tr></td></tr>';
        }
        $header = false;
    }
    return '<table style = "100%">' . $tableHeader . $tableRecords . '</table>';
}

function createGuiTableHeader($fileContent)
{
    //get header (first line)
    $csvHeader = str_getcsv($fileContent[0][0], ";");

    $GuiTableHeaderTemp = '<tr>';

    foreach ($csvHeader as $header)
    {
        $GuiTableHeaderTemp = $GuiTableHeaderTemp . '<th>' . $header . '</th>';
    }

    $GuiTableHeaderTemp = $GuiTableHeaderTemp . '<th colspan = 2>Decision</th></tr>';

    return $GuiTableHeaderTemp;
}

//call gabarit
require 'gabarit.php';