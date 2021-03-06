<?php
	//get global settings
	global $ALLCONFIG;
	$recs=settingsGetValues();
	switch(strtolower($_REQUEST['func'])){
		case 'process':
			//add any new
			$dirty=false;
			foreach($_REQUEST as $key=>$value){
				if(!isset($recs[$key])){
					$dirty=true;
					$ok=addDBRecord(array(
						'-table'=>'_settings',
						'user_id'=>0,
						'key_name'=>$key,
						'key_value'=>$value,
					));
				}
			}
			if($dirty){
				$recs=settingsGetValues();
			}
			//update any others
			foreach($recs as $key=>$rec){
				if(!isset($_REQUEST[$key])){$v='';}
				else{$v=$_REQUEST[$key];}
				$ok=editDBRecord(array('-table'=>'_settings','-where'=>"_id={$rec['_id']}",'key_value'=>$v));
			}
			setView('processed',1);
			return;
		break;
		default:
			setView('default',1);
		break;
	}
?>
