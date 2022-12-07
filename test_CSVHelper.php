<?php

require_once('CSVHelper.php');

//WRITE AND READ
// CSVHelper::write('beatles.csv.php',[['John','Lennon'],['Paul','McCartney']]);
// echo '<pre>';print_r(CSVHelper::read('beatles.csv.php'));
//CSVHelper::write('beatles.csv.php',[['Tedla','Tafari'],['Paul','McCartney']],TRUE);
echo '<pre>';print_r(CSVHelper::read('beatles.csv.php'));

//MODIFY
// CSVHelper::modify('beatles.csv.php',0,['John','Lennon','1940-10-09']);
// echo '<pre>';print_r(CSVHelper::read('beatles.csv.php'));

//DELETE
// CSVHelper::delete('beatles.csv.php',0,TRUE);
// echo '<pre>';print_r(CSVHelper::read('beatles.csv.php'));

//FIND
// if (CSVHelper::find('beatles.csv.php',"Luke")){
//     echo "True";
// }
// else echo "FALSE";
// echo '<pre>';print_r(CSVHelper::read('beatles.csv.php'));