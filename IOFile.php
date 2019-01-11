<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : TimeSheet
 * Created  : 11.01.2019 - 21:45
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */


/**
 * This function is designed to append a path with the fileName received as parameter
 * -The path will be found by the function
 * @param $fName : The file name to be append to the path
 * @return [String] full path to the log file expressed as a string
 * @example File Name : testFile.log / after function : [pathToFile]\testFile.log
 */
function setFullPath($fName)
{
    /* Help
        get current directory -> http://php.net/manual/en/function.getcwd.php
    */

    $currentPath = getcwd();
    $fullPathToFile = $currentPath . "\\" . $fName;
    return $fullPathToFile;
}

function readCSVFile($fileFullPath)
{
    /*Help
		http://php.net/manual/en/function.fgetcsv.php
        http://php.net/manual/en/function.file-exists.php
    */

    $csvFileContent = array();

    if (file_exists($fileFullPath))
    {
            $streamReader = fOpen($fileFullPath, 'r');
            while (($csvLine = fgetcsv($streamReader,";")) !== FALSE)
            {
                array_push($csvFileContent, $csvLine);
            }
            fClose($streamReader);

    }
    return $csvFileContent;
}