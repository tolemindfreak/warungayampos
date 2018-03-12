<?php
class menu extends msDB {
	public $messsage;
	public $radiochecked;
	public $dir = UPLOAD_DIR;
    
	function __construct($connection) {
		$this->messsage = "initialize class";
		if ($connection ==true) {
			$this->radiochecked = $this->connect();
		}
		
	}

    function __destruct() {
			unset($this->radiochecked);
	}
    
    /*
	function getDungeonDataByUserID($request,$post){
		$userID = $post['id'];
		$sql = "select 
				user.id,
				user.name,
				published.dungeonData,
				user.keySlotLvl,
				user.keyDigitLvl,
				user.gold
				from published left join user on published.userID = user.id 
				where published.userID = '".$userID."'";
		$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		if($raws > 0 )
		 { 
			$data = $this->fetch_array($rs);
			echo json_encode($data);
		}else{
			echo "null";
		}
	}
    
    
	function getBattleLog($request,$post){
		$userID = $post['id'];

		$sql = "select 
				battlelog.id,
				battlelog.attackerId, 
				battlelog.keypickSpent, 
				battlelog.star, 
				battlelog.die,
				battlelog.moneyStolen, 
				battlelog.moneyReduced,
				battlelog.revenged,
				battlelog.tanggal,
				battlelog.jam,
				user.level,
				user.name 
				from battlelog left join user on battlelog.attackerId = user.id where battlelog.defenderId = '".$userID."'  and battlelog.revenged = 0";
		$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		$content = Array();	
		if ($raws > 0) {
			while($data = $this->fetch_array($rs))
			{
				$content[] = array(
					'blId'=>$data['id'],
					'attackerId'=>$data['attackerId'],
					'attackerName'=>$data['name'],
					'attackerLevel'=>$data['level'],
					'keypickSpent'=>$data['keypickSpent'],
					'star'=>$data['star'],
					'die'=>$data['die'],
					'moneyStolen' => $data['moneyStolen'],
					'moneyReduced'=> $data['moneyReduced'],
					'revenged'=>$data['revenged'],
					'tanggal'=>$data['tanggal'],
					'jam'=>$data['jam']
				);
			}
			echo json_encode($content);
		}else{
			echo "null";
		}
	} 
    

	function getKategori($request){
		$sql = "select * from kategori";
		$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		$content = Array();
		if($raws > 0){
			while($data = $this->fetch_array($rs)){
				$content[] = array(
					'id' => $data['id'],
					'nama'=> $data['nama']
				);
			}
			$theContent = json_encode($content);
			echo '{"kategori":'.$theContent.'}';
		}else{
			echo "null";
		}
	}
    */

	function getMenu($request){
		$sql = "select * from menu";
		$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		$content = Array();
		if($raws > 0){
			while($data = $this->fetch_array($rs)){
				$content[] = array(
					'id' => $data['id'],
					'nama'=> $data['nama'],
					'harga'=>$data['harga'],
                    'image'=>$data['image']
				);
			}
			$theContent = json_encode($content);
			echo '{"menu":'.$theContent.'}';
		}else{
			echo "null";
		}
	}

	function getNextTransactionID(){
		$sql = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'transaksi'";
		$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		if($raws > 0 )
		 { 
			$data = $this->fetch_array($rs);
			echo json_encode($data);
		}else{
			echo "null";
		}
	}

	function addNewTransaction($post){

		$noTransaksi = $post['noTransaksi'];
		$jumlah = $post['jumlah'];
		$kembali = $post['kembali'];
		$userId = $post['userId'];

		$sql = "insert into transaksi (notransaksi,jumlah,kembali,userid,waktu) values ('".$noTransaksi."','".$jumlah."','".$kembali."','".$userId."',CURRENT_TIMESTAMP())";
		$rs = $this->query($sql);
	}

	function addNewTransactionDetails($post){
		$noTransaksi = $post['noTransaksi'];
		$idMenu = $post['idMenu'];
		$jumlah = $post['jumlah'];

		$sql = "insert into detailtransaksi (notransaksi,idmenu,jumlah) values ('".$noTransaksi."','".$idMenu."','".$jumlah."')";
		$rs = $this->query($sql);

	}

	function getTransactionList(){
		$sql = "select * from transaksi";
		$rs = $this->query($sql);
		$raws = $this->num_rows($rs);
		$content = Array();
		if($raws > 0){
			while($data = $this->fetch_array($rs)){
				$content[] = array(
					'notransaksi' => $data['notransaksi'],
					'jumlah'=> $data['jumlah'],
					'kembali'=>$data['kembali'],
                    'userid'=>$data['userid'],
                    'waktu'=>$data['waktu']
				);
			}
			$theContent = json_encode($content);
			echo '{"transaksi":'.$theContent.'}';
		}else{
			echo "null";
		}
	}
}
?>