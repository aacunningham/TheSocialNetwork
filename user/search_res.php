<?php
	//Lots of ugliness here, need to clean it up
	
	header('Content-Type: application/json');
    require_once "../user/user.php";
    $user = new user ();
	
	$query_res = array ();
	$result = array();
	$inter = array();
	$count = 0;
	if (!empty($_POST['search'])) { //new search submitted
        $query_res = $user->search($_POST['search']);
	
		//Parse all the data, but only to a max of 3
		foreach ($query_res as $friend) :
			$inter[$count] = array( 'uid'=>$friend['uid'],
									'fname' => $friend['fname'], 
									'lname' => $friend['lname']);
			$count += 1;
		endforeach;
		
		if( $count >= 1){
			$result['search_result1'] = $inter[0];
		}
		if( $count >= 2){
			$result['search_result2'] = $inter[1];
		}
		if( $count >= 3){
			$result['search_result3'] = $inter[2];
		}
        $result['search_result'] = strtoupper($_POST['search']);
    }
	echo json_encode($result);
?>