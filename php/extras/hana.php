<?php

/*
	HANA System Tables
		http://sapbw.optimieren.de/hana/hana/html/monitor_views.html

		Sequences:
		--select * from sequences where sequence_oid like '%1157363%'
		--select * from sequences where sequence_name like '%1157363%'
		--select table_name,column_name, column_id from table_columns where table_name ='SAP_FLASH_CARDS' and column_name='ID'
		SELECT BICOMMON."_SYS_SEQUENCE_1157363_#0_#".CURRVAL FROM DUMMY;

*/

//---------- begin function hanaAddDBRecordsFromCSV ----------
/**
* @describe imports data from csv into a HANA table
* @param $table string - table to import into
* @param $csv - csvfile to import (path visible by the HANA server)
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* 	[-localfile] - path to localfile if different than csvfile that DB can see.
* 	[-delim] - delimiter. Default is ,
* 	[-enclose] - enclosed by. Default is "
* 	[-eol] - end of line char.  Default is \n
* 	[-threads] - number of threads. Default is 10
* 	[-batch] - number of records to commit in batch. Default is 10,000
* 	[-skip] - number of top rows to skip if any
* 	[-columns] - comma separated list of column name list. Defaults to use first row as column name list
* 	[-date] - format of date columns in csv file. Y=year, MM=month, MON=name of month, DD=day
* 	[-time] - format of time columns in csv file. HH24=hour, MI=minute, SS=second
* 	[-timestamp] format of timestamp columns in csv file. Y=year, MM=month, MON=name of month, DD=day, HH24=hour, MI=minute, SS=second
* 	[-nofail] - continue instead of failing on errors. Defaults to failing on errors.
* 	[-checktype] - check data types on insert. Defaults to not check.
* @return $errors array
* @usage $ok=hanaAddDBRecordsFromCSV('stgschema.testtable','/mnt/dtxhana/test.csv');
*/
function hanaAddDBRecordsFromCSV($table,$csvfile,$params=array()){
	//error log with same name as csvfile in same path so HANA can write to it.
	$error_log= preg_replace('/\.csv$/i', '.errors', $csvfile);
	if(!isset($params['-localfile'])){$params['-localfile']=$csvfile;}
	$local_error_log= preg_replace('/\.csv$/i', '.errors', $params['-localfile']);
	/*
	 * References
	 * 	https://help.sap.com/viewer/4fe29514fd584807ac9f2a04f6754767/2.0.00/en-US/20f712e175191014907393741fadcb97.html
	 * 	https://blogs.sap.com/2013/04/08/best-practices-for-sap-hana-data-loads/
	 * 	https://blogs.sap.com/2014/02/12/8-tips-on-pre-processing-flat-files-with-sap-hana/
	 *
	 * THREADS and BATCH provide high loading performance by enabling parallel loading and also by committing many records at once.
	 * In general, for column tables, a good setting to use is 10 parallel loading threads, with a commit frequency of 10,000 records or greater
	 *
	THREADS <number_of_threads>
	* 	Specifies the number of threads that can be used for concurrent import. The default value is 1 and maximum allowed is 256
	BATCH <number_of_records_of_each_commit>
	* 	Specifies the number of records to be inserted in each commit
	TABLE LOCK
	* 	Provides faster data loading for column store tables. Use this option carefully as it incurs table locks in exclusive mode as well as explicit hard merges and save points after data loading is finished.
	NO TYPE CHECK
	* 	Specifies that the records are inserted without checking the type of each field.
	SKIP FIRST <number_of_rows_to_skip>
	* 	Skips the specified number of rows in the import file.
	COLUMN LIST IN FIRST ROW [<with_schema_flexibility>]
	* 	Indicates that the column list is stored in the first row of the CSV import file.
	* 	WITH SCHEMA FLEXIBILITY creates missing columns in flexible tables during CSV imports, as specified in the header (first row) of the CSV file or column list.
	* 	By default, missing columns in flexible tables are not created automatically during data imports.
	COLUMN LIST ( <column_name_list> ) [<with_schema_flexibility>]
	* 	Specifies the column list for the data being imported.
	* 	WITH SCHEMA FLEXIBILITY creates missing columns in flexible tables during CSV imports, as specified in the header (first row) of the CSV file or column list.
	RECORD DELIMITED BY <string_for_record_delimiter>
	* 	Specifies the record delimiter used in the CSV file being imported.
	FIELD DELIMITED BY <string_for_field_delimiter>
	* 	Specifies the field delimiter of the CSV file.
	OPTIONALLY ENCLOSED BY <character_for_optional_enclosure>
	* 	Specifies the optional enclosure character used to delimit field data.
	DATE FORMAT <string_for_date_format>
	* 	Specifies the format that date strings are encoded with in the import data.
	* 	Y : year, MM : month, MON : name of month, DD : day
	TIME FORMAT <string_for_time_format>
	* 	Specifies the format that time strings are encoded with in the import data.
	* 	HH24 : hour, MI : minute, SS : second
	TIMESTAMP FORMAT <string_for_timestamp_format>
	* 	Specifies the format that timestamp strings are encoded with in the import data.  (YYYY-MM-DD HH24:MI:SS)
	ERROR LOG <file_path_of_error_log>
	* 	Specifies that a log file of errors generated is stored in this file. Ensure the file path you use is writable by the database.
	FAIL ON INVALID DATA
	* 	Specifies that the IMPORT FROM command fails unless all the entries import successfully.
	 * */
	if(!isset($params['-delim'])){$params['-delim']=',';}
	if(!isset($params['-enclose'])){$params['-enclose']='"';}
	if(!isset($params['-eol'])){$params['-eol']='\\n';}
	if(!isset($params['-threads'])){$params['-threads']=10;}
	if(!isset($params['-batch'])){$params['-batch']=10000;}
	$with='';
	if(isset($params['-skip'])){
		$with.= "SKIP FIRST ({$params['-skip']}) ".PHP_EOL;
	}
	if(isset($params['-columns'])){
		$with.= "COLUMN LIST '{$params['-columns']}' WITH SCHEMA FLEXIBILITY ".PHP_EOL;
	}
	else{
		$with.= "COLUMN LIST IN FIRST ROW WITH SCHEMA FLEXIBILITY ". PHP_EOL;
	}
	if(isset($params['-date'])){
		$with.= "DATE FORMAT ({$params['-date']}) ".PHP_EOL;
	}
	if(isset($params['-time'])){
		$with.= "TIME FORMAT '{$params['-time']}' ".PHP_EOL;
	}
	if(isset($params['-timestamp'])){
		$with.= "TIMESTAMP FORMAT '{$params['-timestamp']}' ".PHP_EOL;
	}
	if(!isset($params['-nofail'])){
		$with.= "FAIL ON INVALID DATA ".PHP_EOL;
	}
	if(!isset($params['-checktype'])){
		$with.= "NO TYPE CHECK ".PHP_EOL;
	}
	$query=<<<ENDOFQUERY
	IMPORT FROM CSV FILE '{$csvfile}'
	INTO {$table}
	WITH
		RECORD DELIMITED BY '{$params['-eol']}'
		FIELD DELIMITED BY '{$params['-delim']}'
		OPTIONALLY ENCLOSED BY '{$params['-enclose']}'
		{$with}
	THREADS {$params['-threads']}
	BATCH {$params['-batch']}
	ERROR LOG '{$error_log}'
ENDOFQUERY;
	setFileContents($error_log,'');
	//set to a single so we can turn off autocommit
	$params['-single']=1;
	$conn=hanaDBConnect($params);
	odbc_autocommit($conn, FALSE);

	odbc_exec($conn, $query);

	if (!odbc_error()){
		odbc_commit($conn);
	}
	else{
		odbc_rollback($conn);
	}
	odbc_close($conn);
	return file($local_error_log);

}
//---------- begin function hanaParseConnectParams ----------
/**
* @describe parses the params array and checks in the CONFIG if missing
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return $params array
* @usage $params=hanaParseConnectParams($params);
*/
function hanaParseConnectParams($params=array()){
	global $CONFIG;
	if(!isset($params['-dbname'])){
		if(isset($CONFIG['dbname_hana'])){
			$params['-dbname']=$CONFIG['dbname_hana'];
			$params['-dbname_source']="CONFIG dbname_hana";
		}
		elseif(isset($CONFIG['hana_dbname'])){
			$params['-dbname']=$CONFIG['hana_dbname'];
			$params['-dbname_source']="CONFIG hana_dbname";
		}
		else{return 'hanaParseConnectParams Error: No dbname set';}
	}
	else{
		$params['-dbname_source']="passed in";
	}
	if(!isset($params['-dbuser'])){
		if(isset($CONFIG['dbuser_hana'])){
			$params['-dbuser']=$CONFIG['dbuser_hana'];
			$params['-dbuser_source']="CONFIG dbuser_hana";
		}
		elseif(isset($CONFIG['hana_dbuser'])){
			$params['-dbuser']=$CONFIG['hana_dbuser'];
			$params['-dbuser_source']="CONFIG hana_dbuser";
		}
		else{return 'hanaParseConnectParams Error: No dbuser set';}
	}
	else{
		$params['-dbuser_source']="passed in";
	}
	if(!isset($params['-dbpass'])){
		if(isset($CONFIG['dbpass_hana'])){
			$params['-dbpass']=$CONFIG['dbpass_hana'];
			$params['-dbpass_source']="CONFIG dbpass_hana";
		}
		elseif(isset($CONFIG['hana_dbpass'])){
			$params['-dbpass']=$CONFIG['hana_dbpass'];
			$params['-dbpass_source']="CONFIG hana_dbpass";
		}
		else{return 'hanaParseConnectParams Error: No dbpass set';}
	}
	else{
		$params['-dbpass_source']="passed in";
	}
	return $params;
}
//---------- begin function hanaDBConnect ----------
/**
* @describe connects to a HANA database via odbc and returns the odbc resource
* @param $param array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
*   [-single] - if you pass in -single it will connect using odbc_connect instead of odbc_pconnect and return the connection
* @return $dbh_hana resource - returns the odbc connection resource
* @usage $dbh_hana=hanaDBConnect($params);
* @usage  example of using -single
*
	$conn=hanaDBConnect(array('-single'=>1));
	odbc_autocommit($conn, FALSE);

	odbc_exec($conn, $query1);
	odbc_exec($conn, $query2);

	if (!odbc_error()){
		odbc_commit($conn);
	}
	else{
		odbc_rollback($conn);
	}
	odbc_close($conn);
*
*/
function hanaDBConnect($params=array()){
	if(!is_array($params) && $params=='single'){$params=array('-single'=>1);}
	$params=hanaParseConnectParams($params);
	if(!isset($params['-dbname'])){return $params;}
	if(isset($params['-single'])){
		$dbh_hana_single = odbc_connect($params['-dbname'],$params['-dbuser'],$params['-dbpass'],SQL_CUR_USE_ODBC );
		if(!is_resource($dbh_hana_single)){
			$err=odbc_errormsg();
			echo "hanaDBConnect single connect error:{$err}".printValue($params);
			exit;
		}
		return $dbh_hana_single;
	}
	global $dbh_hana;
	if(is_resource($dbh_hana)){return $dbh_hana;}

	try{
		$dbh_hana = odbc_pconnect($params['-dbname'],$params['-dbuser'],$params['-dbpass'],SQL_CUR_USE_ODBC );
		if(!is_resource($dbh_hana)){
			$err=odbc_errormsg();
			echo "hanaDBConnect error:{$err}".printValue($params);
			exit;

		}
		return $dbh_hana;
	}
	catch (Exception $e) {
		echo "hanaDBConnect exception" . printValue($e);
		exit;

	}
}
//---------- begin function hanaIsDBTable ----------
/**
* @describe returns true if table exists
* @param $tablename string - table name
* @param $schema string - schema name
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return boolean returns true if table exists
* @usage if(hanaIsDBTable('abc','abcschema')){...}
*/
function hanaIsDBTable($table,$params=array()){
	if(!strlen($table)){
		echo "hanaIsDBTable error: No table";
		exit;
	}
	//split out table and schema
	$parts=preg_split('/\./',$table);
	switch(count($parts)){
		case 1:
			echo "hanaIsDBTable error: no schema defined in tablename";
			exit;
		break;
		case 2:
			$schema=$parts[0];
			$table=$parts[1];
		break;
		default:
			echo "hanaIsDBTable error: to many parts";
		break;
	}
	$dbh_hana=hanaDBConnect($params);
	if(!is_resource($dbh_hana)){
		echo "hanaDBConnect error".printValue($params);
		exit;
	}
	try{
		$result=odbc_tables($dbh_hana);
		if(!$result){
        	$err=array(
        		'error'	=> odbc_errormsg($dbh_hana)
			);
			echo "hanaIsDBTable error: No result".printValue($err);
			exit;
		}
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		echo "hanaIsDBTable error: exception".printValue($err);
		exit;
	}
	while(odbc_fetch_row($result)){
		if(odbc_result($result,"TABLE_TYPE")!="TABLE"){continue;}
		if(strlen($schema) && odbc_result($result,"TABLE_SCHEM") != strtoupper($schema)){continue;}
		$schem=odbc_result($result,"TABLE_SCHEM");
		$name=odbc_result($result,"TABLE_NAME");
		if(strtolower($table) == strtolower($name)){
			odbc_free_result($result);
			return true;
		}
	}
	odbc_free_result($result);
    return false;
}
//---------- begin function hanaClearConnection ----------
/**
* @describe clears the hana database connection
* @return boolean returns true if query succeeded
* @usage $ok=hanaClearConnection();
*/
function hanaClearConnection(){
	global $dbh_hana;
	$dbh_hana='';
	return true;
}
//---------- begin function hanaExecuteSQL ----------
/**
* @describe executes a query and returns without parsing the results
* @param $query string - query to execute
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return boolean returns true if query succeeded
* @usage $ok=hanaExecuteSQL("truncate table abc");
*/
function hanaExecuteSQL($query,$params=array()){
	$dbh_hana=hanaDBConnect($params);
	if(!is_resource($dbh_hana)){
		echo "hanaDBConnect error".printValue($params);
		exit;
	}
	try{
		$result=odbc_exec($dbh_hana,$query);
		if(!$result){
			$err=odbc_errormsg($dbh_hana);
			debugValue($err);
			return false;
		}
		odbc_free_result($result);
		return true;
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		debugValue($err);
		return false;
	}
	return true;
}
//---------- begin function hanaAddDBRecord ----------
/**
* @describe adds a records from params passed in.
*  if cdate, and cuser exists as fields then they are populated with the create date and create username
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
*   -table - name of the table to add to
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* 	other field=>value pairs to add to the record
* @return integer returns the autoincriment key
* @usage $id=hanaAddDBRecord(array('-table'=>'abc','name'=>'bob','age'=>25));
*/
function hanaAddDBRecord($params){
	global $USER;
	if(!isset($params['-table'])){return 'hanaAddRecord error: No table specified.';}
	$fields=hanaGetDBFieldInfo($params['-table'],$params);
	$opts=array();
	if(isset($fields['cdate'])){
		$params['cdate']=strtoupper(date('d-M-Y  H:i:s'));
	}
	elseif(isset($fields['_cdate'])){
		$params['_cdate']=strtoupper(date('d-M-Y  H:i:s'));
	}
	if(isset($fields['cuser'])){
		$params['cuser']=$USER['username'];
	}
	elseif(isset($fields['_cuser'])){
		$params['_cuser']=$USER['username'];
	}
	$valstr='';
	foreach($params as $k=>$v){
		$k=strtolower($k);
		if(!strlen(trim($v))){continue;}
		if(!isset($fields[$k])){continue;}
		//fix array values
		if(is_array($v)){$v=implode(':',$v);}
		//take care of single quotes in value
		$v=str_replace("'","''",$v);
		switch(strtolower($fields[$k]['type'])){
        	case 'integer':
        	case 'number':
        		$opts['values'][]=$v;
        	break;
        	case 'date':
				if($k=='cdate' || $k=='_cdate'){
					$v=date('Y-m-d',strtotime($v));
				}
				$opts['values'][]="'{$v}'";
        	break;
        	default:
        		$opts['values'][]="'{$v}'";
        	break;
		}
        $opts['fields'][]=trim(strtoupper($k));
	}
	$fieldstr=implode('","',$opts['fields']);
	$valstr=implode(',',$opts['values']);
    $query=<<<ENDOFQUERY
		INSERT INTO {$params['-table']}
			("{$fieldstr}")
		VALUES
			({$valstr})
ENDOFQUERY;
	$dbh_hana=hanaDBConnect($params);
	if(!$dbh_hana){
    	$e=odbc_errormsg();
    	debugValue(array("hanaAddDBRecord Connect Error",$e));
    	return;
	}
	try{
		$result=odbc_exec($dbh_hana,$query);
		if(!$result){
        	$err=array(
        		'error'	=> odbc_errormsg($dbh_hana),
				'query'	=> $query
			);
			debugValue($err);
			return "hanaAddDBRecord Error".printValue($err);
		}
		$result2=odbc_exec($dbh_hana,"SELECT top 1 CURRENT_IDENTITY_VALUE() as cval from {$params['-table']};");
		$row=odbc_fetch_array($result2,0);
		$row=array_change_key_case($row);
		odbc_free_result($result);
		if(isNum($row['cval'])){return $row['cval'];}
		return "hanaAddDBRecord Error".printValue($row).$query;
		//echo "result2:".printValue($row);
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		$err['query']=$query;
		$recs=array($err);
		//return $recs;
		odbc_free_result($result);
		debugValue(array("hanaAddDBRecord Connect Error",$e));
		return "hanaAddDBRecord Error".printValue($err);
	}
	odbc_free_result($result);
	return 0;
}
//---------- begin function hanaEditDBRecord ----------
/**
* @describe edits a record from params passed in based on where.
*  if edate, and euser exists as fields then they are populated with the edit date and edit username
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
*   -table - name of the table to add to
*   -where - filter criteria
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* 	other field=>value pairs to edit
* @return boolean returns true on success
* @usage $id=hanaEditDBRecord(array('-table'=>'abc','-where'=>"id=3",'name'=>'bob','age'=>25));
*/
function hanaEditDBRecord($params){
	if(!isset($params['-table'])){return 'hanaEditDBRecord error: No table specified.';}
	if(!isset($params['-where'])){return 'hanaEditDBRecord error: No where specified.';}
	global $USER;
	$fields=hanaGetDBFieldInfo($params['-table'],$params);
	$opts=array();
	if(isset($fields['edate'])){
		$params['edate']=strtoupper(date('Y-M-d H:i:s'));
	}
	elseif(isset($fields['_edate'])){
		$params['_edate']=strtoupper(date('Y-M-d H:i:s'));
	}
	if(isset($fields['euser'])){
		$params['euser']=$USER['username'];
	}
	elseif(isset($fields['_euser'])){
		$params['_euser']=$USER['username'];
	}
	foreach($params as $k=>$v){
		$k=strtolower($k);
		if(!isset($fields[$k])){continue;}
		//fix array values
		if(is_array($v)){$v=implode(':',$v);}
		//take care of single quotes in value
		$v=str_replace("'","''",$v);
		switch(strtolower($fields[$k]['type'])){
        	case 'date':
				if($k=='edate' || $k=='_edate'){
					$v=date('Y-m-d',strtotime($v));
				}
        	break;
		}
		
        $updates[]="{$k}='{$v}'";
	}
	$updatestr=implode(', ',$updates);
    $query=<<<ENDOFQUERY
		UPDATE {$params['-table']}
		SET {$updatestr}
		WHERE {$params['-where']}
ENDOFQUERY;
	return hanaExecuteSQL($query,$params);
}
//---------- begin function hanaReplaceDBRecord ----------
/**
* @describe updates or adds a record from params passed in.
*  if cdate, and cuser exists as fields then they are populated with the create date and create username
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
*   -table - name of the table to add to
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* 	other field=>value pairs to add/edit to the record
* @return integer returns the autoincriment key
* @usage $id=hanaReplaceDBRecord(array('-table'=>'abc','name'=>'bob','age'=>25));
*/
function hanaReplaceDBRecord($params){
	global $USER;
	if(!isset($params['-table'])){return 'hanaAddRecord error: No table specified.';}
	$fields=hanaGetDBFieldInfo($params['-table'],$params);
	$opts=array();
	if(isset($fields['cdate'])){
		$opts['fields'][]='CDATE';
		$opts['values'][]=strtoupper(date('d-M-Y  H:i:s'));
	}
	if(isset($fields['cuser'])){
		$opts['fields'][]='CUSER';
		$opts['values'][]=$USER['username'];
	}
	$valstr='';
	foreach($params as $k=>$v){
		$k=strtolower($k);
		if(!strlen(trim($v))){continue;}
		if(!isset($fields[$k])){continue;}
		//skip cuser and cdate - already set
		if($k=='cuser' || $k=='cdate'){continue;}
		//fix array values
		if(is_array($v)){$v=implode(':',$v);}
		//take care of single quotes in value
		$v=str_replace("'","''",$v);
		switch(strtolower($fields[$k]['type'])){
        	case 'integer':
        	case 'number':
        		$opts['values'][]=$v;
        	break;
        	default:
        		$opts['values'][]="'{$v}'";
        	break;
		}
        $opts['fields'][]=trim(strtoupper($k));
	}
	$fieldstr=implode('","',$opts['fields']);
	$valstr=implode(',',$opts['values']);
    $query=<<<ENDOFQUERY
		REPLACE {$params['-table']}
		("{$fieldstr}")
		values({$valstr})
		WITH PRIMARY KEY
ENDOFQUERY;
	$dbh_hana=hanaDBConnect($params);
	if(!$dbh_hana){
    	$e=odbc_errormsg();
    	debugValue(array("hanaReplaceDBRecord Connect Error",$e));
    	return;
	}
	try{
		$result=odbc_exec($dbh_hana,$query);
		if(!$result){
        	$err=array(
        		'error'	=> odbc_errormsg($dbh_hana),
				'query'	=> $query
			);
			debugValue($err);
			return "hanaReplaceDBRecord Error".printValue($err).$query;
		}
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		$err['query']=$query;
		odbc_free_result($result);
		debugValue(array("hanaReplaceDBRecord Connect Error",$e));
		return "hanaReplaceDBRecord Error".printValue($err);
	}
	odbc_free_result($result);
	return true;
}
//---------- begin function hanaManageDBSessions ----------
/**
* @describe cleans up idle sessions since HANA does not clean up for you.
* @param $user string - defaults to current username.  Set to "all" to clean up all users (requires session admin privileges)
* @param $idle integer - number of milliseconds session has to be idle for
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return boolean returns true on success
* @usage $cnt=hanaManageDBSessions('all');
*/
function hanaManageDBSessions($username='',$idle=1800000,$params=array()){
	global $USER;
	if(!strlen($username)){$username=$USER['username'];}
	if(strtolower($username)=='all'){$username='user_name';}
	else{$username="'{$username}'";}
	//ALTER SYSTEM DISCONNECT SESSION '<connection_id>'
	$query=<<<ENDOFQUERY
SELECT connection_id
FROM M_CONNECTIONS
WHERE
	user_name={$username}
	and connection_status = 'IDLE'
	AND connection_type = 'Remote'
	AND idle_time > {$idle}
ORDER BY idle_time DESC
ENDOFQUERY;
	$recs=hanaQueryResults($query,$params);
	foreach($recs as $rec){
    	$query="ALTER SYSTEM DISCONNECT SESSION '{$rec['connection_id']}'";
    	$ok=hanaQueryResults($query,$params);
	}
	return count($recs);
}
//---------- begin function hanaGetDBSystemTables ----------
/**
* @describe returns an array of system tables
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return boolean returns true on success
* @usage $systemtables=hanaGetDBSystemTables();
*/
function hanaGetDBSystemTables($params=array()){
	$params['-table_schema']='S';
	return hanaGetDBTables($params);
}
//---------- begin function hanaGetDBSchemas ----------
/**
* @describe returns an array of system tables
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return boolean returns true on success
* @usage $schemas=hanaGetDBSchemas();
*/
function hanaGetDBSchemas($params=array()){
	$dbh_hana=hanaDBConnect($params);
	if(!$dbh_hana){
    	$e=odbc_errormsg();
    	debugValue(array("hanaGetDBSchemas Connect Error",$e));
    	return;
	}
	try{
		$result=odbc_tables($dbh_hana);
		if(!$result){
        	$err=array(
        		'error'	=> odbc_errormsg($dbh_hana)
			);
			echo "hanaIsDBTable error: No result".printValue($err);
			exit;
		}
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		echo "hanaIsDBTable error: exception".printValue($err);
		exit;
	}
	$recs=array();
	while(odbc_fetch_row($result)){
		if(odbc_result($result,"TABLE_TYPE")!="TABLE"){continue;}
		$schem=odbc_result($result,"TABLE_SCHEM");
		if(in_array($schem,$recs)){continue;}
		$recs[]=$schem;
	}
	odbc_free_result($result);
    return $recs;
}
//---------- begin function hanaGetDBTables ----------
/**
* @describe returns an array of tables
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return boolean returns true on success
* @usage $tables=hanaGetDBTables();
*/
function hanaGetDBTables($params=array()){
	$dbh_hana=hanaDBConnect($params);
	if(!$dbh_hana){
    	$e=odbc_errormsg();
    	debugValue(array("hanaGetDBSchemas Connect Error",$e));
    	return;
	}
	try{
		$result=odbc_tables($dbh_hana);
		if(!$result){
        	$err=array(
        		'error'	=> odbc_errormsg($dbh_hana)
			);
			echo "hanaIsDBTable error: No result".printValue($err);
			exit;
		}
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		echo "hanaIsDBTable error: exception".printValue($err);
		exit;
	}
	$tables=array();
	while(odbc_fetch_row($result)){
		if(odbc_result($result,"TABLE_TYPE")!="TABLE"){continue;}
		if(strlen($schema) && odbc_result($result,"TABLE_SCHEM") != strtoupper($schema)){continue;}
		$schem=odbc_result($result,"TABLE_SCHEM");
		$name=odbc_result($result,"TABLE_NAME");
		$tables[]="{$schem}.{$name}";
	}
	odbc_free_result($result);
    return $tables;
}
//---------- begin function hanaGetDBFieldInfo ----------
/**
* @describe returns an array of field info. fieldname is the key, Each field returns name,type,scale, precision, length, num are
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return boolean returns true on success
* @usage $fieldinfo=hanaGetDBFieldInfo('abcschema.abc');
*/
function hanaGetDBFieldInfo($table,$params=array()){
	$dbh_hana=hanaDBConnect($params);
	if(!$dbh_hana){
    	$e=odbc_errormsg();
    	debugValue(array("hanaGetDBSchemas Connect Error",$e));
    	return;
	}
	$query="select * from {$table} where 1=0";
	try{
		$result=odbc_exec($dbh_hana,$query);
		if(!$result){
        	$err=array(
        		'error'	=> odbc_errormsg($dbh_hana),
        		'query'	=> $query
			);
			echo "hanaGetDBFieldInfo error: No result".printValue($err);
			exit;
		}
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		echo "hanaGetDBFieldInfo error: exception".printValue($err);
		exit;
	}
	$recs=array();
	for($i=1;$i<=odbc_num_fields($result);$i++){
		$field=strtolower(odbc_field_name($result,$i));
        $recs[$field]=array(
			'name'		=> $field,
			'type'		=> strtolower(odbc_field_type($result,$i)),
			'scale'		=> strtolower(odbc_field_scale($result,$i)),
			'precision'	=> strtolower(odbc_field_precision($result,$i)),
			'length'	=> strtolower(odbc_field_len($result,$i)),
			'num'		=> strtolower(odbc_field_num($result,$i))
		);
    }
    odbc_free_result($result);
	return $recs;
}
//---------- begin function hanaGetDBCount ----------
/**
* @describe returns the count of any query without actually getting the data
* @param $query string - the query to run
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* @return $count integer
* @usage $cnt=hanaGetDBCount('select * from abcschema.abc');
*/
function hanaGetDBCount($query,$params){
	$params['-count']=1;
	return hanaQueryResults($query,$params);
}
//---------- begin function hanaQueryResults ----------
/**
* @describe returns the records of a query
* @param $params array - These can also be set in the CONFIG file with dbname_hana,dbuser_hana, and dbpass_hana
* 	[-dbname] - name of ODBC connection
* 	[-dbuser] - username
* 	[-dbpass] - password
* 	[-filename] - if you pass in a filename then it will write the results to the csv filename you passed in
* @return $recs array
* @usage $recs=hanaQueryResults('select top 50 * from abcschema.abc');
*/
function hanaQueryResults($query,$params=array()){
	global $dbh_hana;
	if(!is_resource($dbh_hana)){
		$dbh_hana=hanaDBConnect($params);
	}
	if(!$dbh_hana){
    	$e=odbc_errormsg();
    	debugValue(array("hanaQueryResults Connect Error",$e));
    	return;
	}
	try{
		$result=odbc_exec($dbh_hana,$query);
		if(!$result){
			$errstr=odbc_errormsg($dbh_hana);
			if(!strlen($errstr)){return array();}
        	$err=array(
        		'error'	=> $errstr,
        		'query' => $query
			);
			if(stringContains($errstr,'session not connected')){
				$dbh_hana='';
				sleep(1);
				$dbh_hana=hanaDBConnect($params);
				$result=odbc_exec($dbh_hana,$query);
				if(!$result){
					$errstr=odbc_errormsg($dbh_hana);
					if(!strlen($errstr)){return array();}
					$err=array(
						'error'	=> $errstr,
						'query' => $query,
						'retry'	=> 1
					);
					echo "hanaQueryResults error: No result".printValue($err);
					exit;
				}
			}
			else{
				echo "hanaQueryResults error: No result".printValue($err);
				exit;
			}
		}
	}
	catch (Exception $e) {
		$err=$e->errorInfo;
		echo "hanaQueryResults error: exception".printValue($err);
		exit;
	}
	if(isset($params['-count'])){
    	return odbc_num_rows($result);
	}
	$header=0;
	unset($fh);
	if(isset($params['-filename'])){
		if(file_exists($params['-filename'])){unlink($params['-filename']);}
    	$fh = fopen($params['-filename'],"wb");
    	if(!$fh){echo 'hanaQueryResults error: Failed to open '.$params['-filename'];exit;}
	}
	else{$recs=array();}
	while(odbc_fetch_row($result)){
		$rec=array();
	    for($i=1;$i<=odbc_num_fields($result);$i++){
			$field=strtolower(odbc_field_name($result,$i));
	        $rec[$field]=odbc_result($result,$i);
	    }
	    if($fh){
        	if($header==0){
            	$csv=arrays2CSV(array($rec));
            	$header=1;
            	//add UTF-8 byte order mark to the beginning of the csv
				$csv="\xEF\xBB\xBF".$csv;
			}
			else{
            	$csv=arrays2CSV(array($rec),array('-noheader'=>1));
			}
			$csv=preg_replace('/[\r\n]+$/','',$csv);
			fwrite($fh,$csv."\r\n");
			continue;
		}
		else{
			$recs[]=$rec;
		}
	}
	odbc_free_result($result);
	if($fh){
		@fclose($fh);
		return 1;
	}
	return $recs;
}
//---------- begin function hanaBuildPreparedInsertStatement ----------
/**
* @describe creates the query needed for a prepared Insert Statement
* @param $table string - tablename
* @param $fieldinfo array - field info obtained from hanaGetDBFieldInfo function
* @return $query string
* @usage $query=hanaBuildPreparedInsertStatement($table,$fieldinfo,$primary_keys);
*/
function hanaBuildPreparedInsertStatement($table,$fieldinfo=array(),$params=array()){
	if(!is_array($fieldinfo)){
		$fieldinfo=hanaGetDBFieldInfo($table,$params);
	}
	$fields=array();
	$binds=array();
	foreach($fieldinfo as $field=>$info){
		//handle special fields
		switch(strtolower($field)){
			case 'limit':$field='"'.strtoupper($field).'"';break;
		}
		$fields[]=$field;
		$binds[]='?';
	}
	$fieldstr=implode(', ',$fields);
	$bindstr=implode(', ',$binds);
	$query="INSERT INTO {$table} ({$fieldstr}) VALUES ({$bindstr})";
	return $query;
}
//---------- begin function hanaBuildPreparedReplaceStatement ----------
/**
* @describe creates the query needed for a prepared Upsert Statement
* @param $table string - tablename
* @param $fieldinfo array - field info obtained from hanaGetDBFieldInfo function
* @param $primary_keys array - array of primary keys
* @return $query string
* @usage $query=hanaBuildPreparedReplaceStatement($table,$fieldinfo,$primary_keys);
*/
function hanaBuildPreparedReplaceStatement($table,$fieldinfo=array(),$keys=array(),$params=array()){
	if(!is_array($keys) || !count($keys)){
		echo "hanaBuildPreparedReplaceStatement error - missing keys.  Table: {$table}";
		exit;
	}
	if(!is_array($fieldinfo)){
		$fieldinfo=hanaGetDBFieldInfo($table,$params);
	}
	$sets=array();
	$wheres=array();
	foreach($fieldinfo as $field=>$info){
		$bind='?';
		//handle special fields
		switch(strtolower($field)){
			case 'limit':$field='"'.strtoupper($field).'"';break;
		}
		if(in_array($field,$keys)){
			$wheres[]="{$field}={$bind}";
		}
		$fields[]=$field;
		$binds[]='?';
	}
	$fieldstr=implode(', ',$fields);
	$bindstr=implode(', ',$binds);
	$wherestr=implode(' and ',$wheres);
	$query="REPLACE {$table} ({$fieldstr}) VALUES ({$bindstr}) WHERE {$wherestr}";
	return $query;
}
//---------- begin function hanaBuildPreparedUpdateStatement ----------
/**
* @describe creates the query needed for a prepared Update Statement
* @param $table string - tablename
* @param $fieldinfo array - field info obtained from hanaGetDBFieldInfo function
* @param $primary_keys array - array of primary keys
* @return $query string
* @usage $query=hanaBuildPreparedUpdateStatement($table,$fieldinfo,$primary_keys);
*/
function hanaBuildPreparedUpdateStatement($table,$fieldinfo=array(),$keys=array(),$params=array()){
	if(!is_array($keys) || !count($keys)){
		echo "hanaBuildPreparedUpdateStatement error - missing keys.  Table: {$table}";
		exit;
	}
	if(!is_array($fieldinfo)){
		$fieldinfo=hanaGetDBFieldInfo($table,$params);
	}
	$sets=array();
	$wheres=array();
	foreach($fieldinfo as $field=>$info){
		$bind='?';
		//handle special fields
		switch(strtolower($field)){
			case 'limit':$field='"'.strtoupper($field).'"';break;
		}
		if(in_array($field,$keys)){
			$wheres[]="{$field}={$bind}";
		}
		else{
			$sets[]="{$field}={$bind}";
		}
	}
	$setstr=implode(', ',$sets);
	$wherestr=implode(' and ',$wheres);
	$query="UPDATE {$table} SET {$setstr} WHERE {$wherestr}";
	return $query;
}
//---------- begin function hanaBuildPreparedDeleteStatement ----------
/**
* @describe creates the query needed for a prepared Delete Statement
* @param $table string - tablename
* @param $fieldinfo array - field info obtained from hanaGetDBFieldInfo function
* @param $primary_keys array - array of primary keys
* @return $query string
* @usage $query=hanaBuildPreparedDeleteStatement($table,$fieldinfo,$primary_keys);
*/
function hanaBuildPreparedDeleteStatement($table,$fieldinfo=array(),$keys=array(),$params=array()){
	if(!is_array($keys) || !count($keys)){
		echo "hanaBuildPreparedDeleteStatement error - missing keys.  Table: {$table}";
		exit;
	}
	if(!is_array($fieldinfo)){
		$fieldinfo=hanaGetDBFieldInfo($table,$params);
	}
	$wheres=array();
	foreach($fieldinfo as $field=>$info){
		$bind='?';
		//handle special fields
		switch(strtolower($field)){
			case 'limit':$field='"'.strtoupper($field).'"';break;
		}
		if(in_array($field,$keys)){
			$wheres[]="{$field}={$bind}";
		}
	}
	$wherestr=implode(' and ',$wheres);
	$query="DELETE FROM {$table} WHERE {$wherestr}";
	return $query;
}
