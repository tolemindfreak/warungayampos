<?php
class msDB {

    public  $messsage;
    private $dir = "log/";
    private $link;
    private $error;
    private $errno;
    private $query,$result;

    function __construct($conn = 1) {    
        $this->messsage = "initialize class";
    }

    function __destruct() {
        @mysql_close($this->link);
    }

    public function connect() {
        if ($this -> link = mysql_connect(HOST, USER, PASS)) {
            if (DB) {
                if (!mysql_select_db(DB)) $this -> exception("Could not connect to the database!");
            }
        } else {
            $this -> exception("Could not create database connection!");
        }
    }

    public function close() {
        @mysql_close($this->link);
    }

    public function query($sql) {
        if ($this->query = @mysql_query($sql)) {
            return $this->query;
        } else {
            $this->exception("Could not query database!");
            return false;
        }
    }
   
  
    
           
	public function insert( $table , $data)//fungsi insert
    {
    	$hasil = array();
        $row = array();
        $nilai = array();
        foreach ( $data as $kolom =>$value )
               {
            $row[] = $kolom;
            $nilai[] = "'".$value."'";
        }
 
        $this->result = $this->query("INSERT INTO ". $table ."(". implode(',' ,$row) .") VALUES (". implode(',' , $nilai) .")");
        
     }
	 
 
    public function update($table , $data , $where)//fungsi update
    {
        foreach ( $data as $kolom => $row )
        {
            $set[]= $kolom."='".$row."'" ;
        }
        $set = implode(',',$set);
        $query = "UPDATE ".$table." SET ".$set." WHERE ".$where ;
        $this->query($query);
    }
 
    public function delete($table , $where)//fungsi delete
    {
        $this->query("DELETE FROM ".$table." WHERE ".$where);
    }

	
    public function num_rows($qid) {
        if (empty($qid)) {          
            $this->exception("Could not get number of rows because no query id was supplied!");
            return false;
        } else {
            return mysql_numrows($qid);
        }
    }

    public function fetch_array($qid) {
        if (empty($qid)) {
            $this->exception("Could not fetch array because no query id was supplied!");
            return false;
        } else {
            $data = mysql_fetch_array($qid);
        }
        return $data;
    }

    public function fetch_array_assoc($qid) {
        if (empty($qid)) {
            $this->exception("Could not fetch array assoc because no query id was supplied!");
            return false;
        } else {
            $data = mysql_fetch_array($qid, MYSQL_ASSOC);
        }
        return $data;
    }

    public function fetch_all_array($sql, $assoc = true) {
        $data = array();
        if ($qid = $this->query($sql)) {
            if ($assoc) {
                while ($row = $this->fetch_array_assoc($qid)) {
                    $data[] = $row;
                }
            } else {
                while ($row = $this->fetch_array($qid)) {
                    $data[] = $row;
                }
            }
        } else {
            return false;
        }
        return $data;
    }

    	
    private function exception($message) {
        if ($this->link) {
            $this->error = mysql_error($this->link);
            $this->errno = mysql_errno($this->link);
        } else {
            $this->error = mysql_error();
            $this->errno = mysql_errno();
        }
        
        $result = array(); 
        $result['success'] =false;
        $result['message'] = $message."  =>  ".$this->error;
        
        $this->Log($result['message']);

        echo json_encode($result);
  
    }
    
    public function Log($message,$app = "",$module ="",$action="")
	{	
		$dir = $this->dir;
		if(empty($app) && empty($module) && empty($action))
		{
			$request = "Query Db";
		}
		else
		{
			$request = "app=".$app."&module=".$module."&action=".$action;
		}
		$log  = "User	: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i:s a").PHP_EOL.
		        "Request: ".$request.PHP_EOL.
				"Message: ".$message.PHP_EOL.
		        "-------------------------------------------------------------------".PHP_EOL;
		
		if(is_dir($dir))
		{
			file_put_contents($dir.'log_'.date("j.n.Y").'.bwi', $log, FILE_APPEND);
		}
		else
		{
			$folder = mkdir($dir, 0777, true); 
			file_put_contents($dir.'log_'.date("j.n.Y").'.bwi', $log, FILE_APPEND);
		}
		
		
		        
		
	}
	
	function curPageURL() {
		 
		 $url = $_SERVER['REQUEST_URI']; //returns the current URL
		 $parts = explode('/',$url);
		 
		 for ($i = 0; $i < count($parts) - 1; $i++) {
			$dir = $parts[$i] . "/";
		 }
		 
		 $pageURL = 'http';
		 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
			    $pageURL .= "s";
		 }
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		 	 $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
		 } else {
		  	 $pageURL .= $_SERVER["SERVER_NAME"];
		 }
		 return $pageURL."/".$dir;
	}
	
	
	}
?>
