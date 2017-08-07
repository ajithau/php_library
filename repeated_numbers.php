<?php
/** 
  *
  * Display the count of the repeated digit in file.
  * It will take input string from the given files. 
  * @author Ajith ajitharakkal@gmail.com
  * @date   07-08-2017.
  *
*/

// Read values from the text file.
// Split the string with white spaces.
$myfile = explode(" ", file_get_contents('input.txt')) or die("Unable to open file!");

$myfile = array_filter($myfile);
$number_of_digits = 10;
for ($i=1; $i < $number_of_digits; $i++) { 
   foreach ($myfile as $key => $number) {
      if (!is_numeric($number)) {
         continue;
      }
      $lst = strlen($number)-$i;
      if ($i > strlen($number)) {
         continue;
      }
      $array[$i][] = substr($number,$lst);
   }

   if(!empty($array[$i])){
      $vals = array_count_values($array[$i]);
      asort($vals);
      print_r($vals);
   }

}

?>