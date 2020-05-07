<?php
/* Read input from STDIN. Print your output to STDOUT*/
$handle = fopen("php://stdin", "r");
while( $line = fgets( $handle ) ) {
      $input[] = $line;
}

$invalid = 0;
$test_case = $input[0];
if ( ($test_case < 1) || ($test_case > 100000) ) {
    fwrite(STDOUT, $invalid."\n");
    exit();
}

$line_num = 0;
for ($x = 0; $x < $test_case; $x++) {
    $numPlayers = $input[$line_num+1];
    $gTeam = explode(' ', trim($input[$line_num+2]));
    sort($gTeam);
    $oTeam = explode(' ', trim($input[$line_num+3]));
    sort($oTeam); 
    $line_num = $line_num+3;

    if ((count($gTeam) != $numPlayers) || (count($oTeam) != $numPlayers)){
        fwrite(STDOUT, $invalid."\n");
        exit();
    }
    $win = 0;
    $check = (int)$numPlayers-1;

    foreach ($oTeam as $key => $value) {
        if ($value < $gTeam[$key]) {
            $win = $win+1;
        } else {
            $i=$key;
            do {
                if (isset($gTeam[$i])){
                    if($value < $gTeam[$i]) {
                        unset($gTeam[$i]);
                        $win = $win+1;
                        break;
                    }
                }
                $i++;
            } while ($i <= $check);
        }
    }
    fwrite(STDOUT, $win."\n");
}
?>