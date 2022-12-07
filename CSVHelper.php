<?php
class CSVHelper{

    private static $obfuscator='<?php die() ?>';
	
    //Writes to a file
    //if overwrite can be set as true or false depending if you want to overwrite the file.
	static function write($filename,$data,$overwrite=false){
        if (!isset($data)){
            return false;
        } 
        if (!$overwrite){
            // open csv file for writing
            $fh = fopen($filename, 'a');
            if ($fh === false) {
                die('Error opening the file ' . $filename);     
           }
        }
        else{
            // open csv file for writing
            $fh = fopen($filename, 'w');
            if ($fh === false) {
                die('Error opening the file ' . $filename);     
           }
        }
        // write each row at a time to a file
        foreach ($data as $row) {
            fputcsv($fh, $row);
        }
        // close the file
        fclose($fh);
        echo "completed";
        return true;
    }

    // reads every line of a csv file and outputs an array
    static function read($filename){
        if (file_exists($filename)) {
            $fh = fopen($filename, 'r');
        
            $line_array = array();
            while ($line = fgets($fh)) {
              array_push($line_array, (trim($line)));
            }
            fclose($fh);
            return $line_array;
          } else {
            echo '404: File not found!';
          }
          return null;
    }

    //Modifies a selected row on a csv file
    static function modify($filename,$index,$data){
        if (!isset($data)){
            return false;
        } 
        $line_counter = 0;
        $new_file_content = '';
        $line_array = CSVHelper::read($filename);
        $fh = fopen($filename, 'r');
        while ($line = fgets($fh)) {
            if ($line_counter == $index) {
                if ($line_array[$line_counter] != $data) {
                    $data_together = implode(", ", $data);
                    $new_file_content .= $data_together . PHP_EOL;
                }
            } else {
                $new_file_content .= $line;
                }
            $line_counter++;
        }
        fclose($fh);

        file_put_contents($filename, $new_file_content);
        return true;
    }

    //delete the row or the information in the row depending on what wipe is set as.
    static function delete($filename,$index,$wipe=false){
        if ($wipe){
            $line_counter = 0;
            $new_file_content = '';
            $fh = fopen($filename, 'r');
        while ($line = fgets($fh)) {
            if ($line_counter == $index) {
            $new_file_content .= PHP_EOL;
            } else {
                $new_file_content .= $line;
            }
            $line_counter++;
        }
        fclose($fh);

        file_put_contents($filename, $new_file_content);
        }else {
            $line_counter = 0;
            $new_file_content = '';
            $fh = fopen($filename, 'r');
            while ($line = fgets($fh)) {
              if ($line_counter == $index) {
                $new_file_content .= '';
              } else {
                $new_file_content .= $line;
              }
              $line_counter++;
            }
            fclose($fh);
          
            file_put_contents($filename, $new_file_content);
            echo 'You\'ve successfully deleted the quote';
        }
    }

    //find tells us if the file contains a cell with the data
    static function find($filename,$data){
        if (file_exists($filename)) {
            $fh = fopen($filename, 'r');
        
            while ($line = fgets($fh)) {
                $line = explode(",",$line);
                if (trim($line[0])==$data){
                    return TRUE;
                }
            }
            return FALSE;
            fclose($fh);
            
          } else {
            echo '404: File not found!';
          }
          return null;
    }
    


}