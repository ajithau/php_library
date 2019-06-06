<?php
    /*$fp = fopen("php://stdin", "r");
    while( $line = fgets( $fp ) ) {
        $input[] = $line;
    }
    fclose( $fp );
    //Write code here
     $test_case = $input[0];
    if ($test_case < 1 || $test_case > 5) {
        fwrite(STDOUT, "0 \n");
        exit();
    }
    $line_num = 0;
    for ($x = 0; $x < $test_case; $x++) {
        $number = $input[$line_num+1];
        $numbers = explode(' ', trim($input[$line_num+2]));
        $line_num = $line_num+2;
        $numbers = array_map('trim',$numbers);
        // check for the valid integer
        if (count($numbers) < 1 || count($numbers) > 100) {
            fwrite(STDOUT, "0 \n");
            exit();
        }
        if (count($numbers) != $number) {
            fwrite(STDOUT, "0 \n");
            exit();
        }*/
        $numbers = array(
          120,343,435,211);
      $numbers = array_map('trim',$numbers);
      // check for the valid integer
        if (count($numbers) < 1 || count($numbers) > 100000) {
            fwrite(STDOUT, "0 \n");
            exit();
        }

        $original = $numbers;
        $svalue=array_values($numbers);
        rsort($svalue);
      $sorted=array();
      foreach ($svalue as $key => $value) {
            if($value < 1){
                continue;
            }
            $kk=array_search($value,$numbers);
          $sorted[$kk]=$value;
          unset($numbers[$kk]);
        }
        $svalues=array_values($original);
      $sorted1=array();
      foreach ($svalues as $value) {
          if (1 <= $value  && $value >= 1000) {
                fwrite(STDOUT, "0 \n");
                exit();
          }
          if($value < 1){
                continue;
          }
            $kk=array_search($value,$original);
            $sorted1[$kk]=$value;
            unset($original[$kk]);
        }
        print_r($sorted);
        print_r($sorted1);
        if (!empty($sorted)) {
            $first_array = 0;
            foreach ($sorted as $key => $value) {
                $final = 0;
                $array[$key] = $value;
                foreach ($sorted as $skey => $svalue) {
                    if ($skey == $key) {
                        $final = $final+$value;
                        continue;
                    }
                    $check_int = check_num($array, $svalue);
                    if ($check_int == true) {
                        $final = $final+$svalue;
                        $array[$skey] = $svalue;
                        unset($check_int);
                    } 
                }
              print_r($array);
                if ($first_array == 0) {
                    $first_array = $final;
                    $total[$key] = $array;
                } else {
                    if ($first_array <= $final) {
                        $total[$key] = $array;
                    }
                }
                unset($final);
                unset($array);
            }
            $total = array_unique($total, SORT_REGULAR);
            $ans = array_sum((array_values($total)[0]));
            fwrite(STDOUT, $ans."\n");
            unset($total);
            unset($sorted);
            unset($sorted1);
        } else {
          fwrite(STDOUT, "0 \n");
            unset($numbers);
        }
    // }
function check_num($subs, $check_value)
{
  foreach ($subs as $value) {
        $split_value = str_split($value);
        foreach ($split_value as $cvalue) {
            $pos = strpos($check_value, $cvalue);
            if ($pos !== false) {
              return false;
            }
        }
    }
return true;
}
?>