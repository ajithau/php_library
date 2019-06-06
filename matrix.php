<?php
// $variable = array(3,2,4);
// for ($i=0; $i < 2 ; $i++) { 
// 	foreach ($variable as $key => $value) {
// 		echo "$value \n";
// 		break 2;
// 	}
// 	echo($i)."\n \n";
// }
// die;

	/* Read input from STDIN. Print your output to STDOUT*/
    /*$fp = fopen("php://stdin", "r");

	while( $line = fgets( $fp ) ) {
  		$input[] = $line;
	}
	fclose( $fp );
  	//Write code here
  	 $test_case = $input[0];
  	if ($test_case < 1 || $test_case > 5) {
	  	fwrite(STDOUT, "NO\n");
		exit();
  	}
  	$line_num = 0;
	for ($x = 0; $x < $test_case; $x++) {
	  	$phase_state = explode(' ', trim($input[$line_num+1]));
	  	$row_win = explode(' ', trim($input[$line_num+2]));
	  	$col_win = explode(' ', trim($input[$line_num+3]));*/
	  	$phase_state = array(10,8);
	  	$row_win = array(1,2,2,3,5,4,7,2,0,1);
	  	$col_win = array(2,1,2,2,4,5,7,0);
      	// $line_num = $line_num+3;
	  	$phase = $phase_state[0];
	  	$state = $phase_state[1];
	  	if ((count($phase_state) > 2) || (count($row_win) > $phase) || (count($col_win) > $state)) {
          	fwrite(STDOUT, "NO\n");
          	exit();
	  	}
	  	$matrix = array();
	  	$phase_val = array();
	  	$state_val = array();
		foreach ($row_win as $key => $value) {
  			for ($k=1; $k <= $state; $k++) {
	  			if ($state < $value) {
					echo "NO\n";
					break 2;
				}
				if ($k <= $value) {
					$matrix[] = 1;
				} else {
					$matrix[] = 0;
				}
	  		}
	  		$state_val[$key] = $matrix;
			unset($matrix);
		}
  		foreach ($col_win as $ckey => $cvalue) {
  			// if column value is greater than phase then exit
  			if ($phase < $cvalue) {
	          fwrite(STDOUT, "NO\n");
	          break;
	        }
    		$rest = $cvalue;
	        foreach ($state_val as $skey => $svalue) {
	        	if ($rest==0) {
	        		foreach ($svalue as $ekey => $evalue) {
	        			if ($ekey==$ckey) {
	        				continue;
	        			} elseif ($evalue==0 && ($ekey>$ckey)) {
	        				array_swap($state_val[$skey],$ekey,$ckey);
	        			} else {
	          				continue ;
	        			}
	        		}
	        	} else {
		        	if ($svalue[$ckey] < $cvalue) {
		        		if ($svalue[$ckey]!=0) {
		        			$rest--;
		        		}
		        		continue;
	        		} elseif ($svalue[$ckey] == $cvalue) {
		        		if ($svalue[$ckey]!=0) {
		        			$rest--;
		        		}
	        			continue;
	        		} 
        		} 
	        }
	        unset($svalue);
	        unset($rest);
	        unset($evalue);
	        $check = 0;
	        foreach ($state_val as $fvalue) {
	        	$check = $check+$fvalue[$ckey];
	        }
	        // echo "$check \n";
	        // echo "$cvalue \n \n";
	        if ($check != $cvalue) {
	        	fwrite(STDOUT, "NO\n");
				unset($check);
				break;        
	        }
			unset($fvalue);
			unset($check);
 		}
 		print_r($state_val);
 		fwrite(STDOUT, "Yes\n");
		unset($phase_state);
		unset($row_win);
		unset($col_win);
		unset($state_val);

	// }
  	function array_swap(&$array,$swap_a,$swap_b){
	   list($array[$swap_a],$array[$swap_b]) = array($array[$swap_b],$array[$swap_a]);
	}
?>