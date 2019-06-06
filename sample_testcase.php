<?php
/* Read input from STDIN. Print your output to STDOUT*/
    $fp = fopen("php://stdin", "r");

	while( $line = fgets( $fp ) ) {
  		$input[] = $line;
	}
	fclose( $fp );
  	//Write code here
  	 $test_case = $input[0];
  	if ($test_case < 1 || $test_case > 11) {
  		exit("please enter a valid test case \n");
  	}
  	$line_num = 0;
	for ($x = 0; $x < $test_case; $x++) {
		$house_num = $input[$line_num+1];
	  	$houses = explode(' ', trim($input[$line_num+2]));
	  	$line_num = $line_num+2;
	  	$houses = array_map('trim',$houses);
	  	// check for the valid integer
        if (count($houses) < 1 || count($houses) > 10000) {
  		    exit("please enter a valid house number \n");
  	    }
	  	if (count($houses) != $house_num) {
	  		exit("invalid number of houses \n");
	  	}
		$original = $houses;
		$svalue=array_values($houses);
		rsort($svalue);
	  	$sorted=array();
	  	foreach ($svalue as $key => $value) {
	  		if($value < 1){
	  			continue;
	  		}
	   		$kk=array_search($value,$houses);
	  		$sorted[$kk]=$value;
	  		unset($houses[$kk]);
	    }
		$svalues=array_values($original);
	  	$sorted1=array();
	  	foreach ($svalues as $value) {
	  		if (-1000 < $value  && $value > 1000) {
				exit("please enter a valid houses number");
	  		}
	  		if($value < 1){
	  			continue;
	  		}
	   		$kk=array_search($value,$original);
	  		$sorted1[$kk]=$value;
	  		unset($original[$kk]);
	    }
	    if (!empty($sorted)) {
		    foreach ($sorted as $key => $value) {
		    	$final = 0;
		    	$pvalue = $value;
				$pkey[] = $key;
		    	foreach ($sorted1 as $skey => $svalue) {
		    		if ($key==$skey) {
		    			if ($final==0) {
		    				$final = array();
				    		$final[$skey]['value'] = $svalue;
			    		} else {
			    			$final[$skey]['value'] = $svalue;
			    		}
		    			continue;
		    		}
		    		foreach ($pkey as $prev_key_value) {
			    		if((($prev_key_value+1) == $skey) || (($prev_key_value-1) == $skey)){
							$key_exit = 1;
						}
		    		}
		    		if(isset($key_exit)) {
		    			unset($key_exit);
		    			continue;
		    		}
					$pkey[] = $skey;
		    		$pvalue = $svalue+$pvalue;
		    		if ($final==0) {
						$final = array();
			    		$final[$skey]['value'] = $svalue;
		    		} else {
		    			$final[$skey]['value'] = $svalue;
		    		}
		    	}
			  	$total[$key]['value'] = $pvalue;
			  	$total[$key]['result'] = $final;
		    	unset($skey);
		    	unset($pkey);
		    	unset($final);
		    	unset($pvalue);
		    }
		    $final_check = 0;
		    $result = array();
		    foreach ($total as $key => $value) {
		    	if($final_check == 0) {
		    		$final_check = $value['value'];
		    		$result = array_reverse($value['result']);
		    	} else {
		    		if($final_check < $value['value']){
		    			$final_check = $value['value'];
		    			unset($result);
		    			$result = array();
		    			$result = array_reverse($value['result']);
		    		} elseif($final_check == $value['value']) {
						$arr = array_reverse($value['result']);
						$parr = array_reverse($result);
						foreach ($parr as $prev_value) {
		    				foreach ($arr as $cur_value) {
		    					if($prev_value['value'] > $cur_value['value']) {
		    						$prevarray = true;
		    						break;
		    					}
		    					if($prev_value['value'] < $cur_value['value']) {
		    						$currarray = true;
		    						break;
		    					}
		    				}
		    				if (isset($prevarray)) {
		    					unset($end);
		    					$end = $arr;
		    					break;
		    				}
		    				if (isset($currarray)) {
		    					unset($end);
		    					$end = $parr;
		    					break;
		    				}
		    			}
						$result = array_reverse($value['result']);
		    		}
		    	}
		    }
		    $ans = implode("", array_column($result, 'value'));
			fwrite(STDOUT, (int)$ans."\n");
			unset($ans);
			unset($result);
			unset($total);
			unset($sorted);
			unset($sorted1);
	    } else {
	    	rsort($houses);
	    	fwrite(STDOUT, (int)$houses[0]."\n");
	    	unset($houses);
	    }
	}
?>