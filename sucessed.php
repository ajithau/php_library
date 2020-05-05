<?php
/* Read input from STDIN. Print your output to STDOUT*/
$handle = fopen("php://stdin", "r");
$i = 0;
while( $line = fgets( $handle ) ) {
      $input[] = $line;
      $i++;
      if($i==3){
          fclose( $handle );
      }
}
print_r($input);
//Write code here
$ingradient = $input[0];
if ( ($ingradient < 1) && ($ingradient < 10000000) ){
    return 0;
}
$reqQuantity = explode(' ', trim($input[1]));
$avaQuantity = explode(' ', trim($input[2]));
if ((count($reqQuantity) != $ingradient) || (count($avaQuantity) != $ingradient)){
    return 0;
}
foreach ($avaQuantity as $key => $value) {
    $final[] = floor($value/$reqQuantity[$key]);
}
$result = min($final);
if( $result < 1){
    echo 0;
} else {
    echo $result;
}

?>
