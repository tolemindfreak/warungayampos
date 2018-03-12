<?php
class login extends msDB {
	public $messsage;
	public $radiochecked;
	public $dir = UPLOAD_DIR;
    
	function __construct($connection) {
		session_start();
		$this->messsage = "initialize class";
		if ($connection ==true) {
			$this->radiochecked = $this->connect();
		}
		
	}

    function __destruct() {
			unset($this->radiochecked);
	}
    
    function getListUser(){
    	$sql = "select* from user";
    	$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		$content = Array();
		if($raws > 0){
			while($data = $this->fetch_array($rs)){
				$content[] = array(
					'username' => $data['username'],
					'nama'=> $data['nama'],
					'level'=>$data['level']
				);
			}
			$theContent = json_encode($content);
			echo '{"user":'.$theContent.'}';
		}else{
			echo "null";
		}
    }

	function login($post){
		$username = $post['username'];
		$password = $post['password'];

		$sql = "select * from user where username = '".$username."'";
		$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		$content = Array();
		if($raws > 0){
			while($data = $this->fetch_array($rs)){
				if($data['username'] == $username){
					if($data['password'] == $password){
						$content[] = array(
							'username' => $data['username'],
							'nama'=> $data['nama'],
							'level'=>$data['level']
						);
						$theContent = json_encode($content[0]);
						$_SESSION['UserID'] = $data['username'];
						echo $theContent;
					}else{
						echo "password salah";
					}
				}
			}
		}else{
			echo "username salah";
		}
	}

	function logout(){
		unset($_SESSION['UserID']);
		echo '{"state" : "berhasil"}';
	}
}
?>