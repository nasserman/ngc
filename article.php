<?php
/*
DROP TABLE IF EXISTS `#__rtgkonfranse_articles`;
 
CREATE TABLE `#__rtgkonfranse_articles` (
  `aid` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(200) NULL,
  `kholase` VARCHAR(500) NULL,
  `name_nevisandegan` VARCHAR(500) NULL,
  `liste_kalemate_klidi` VARCHAR(500) NULL,
  `name_file` VARCHAR(300) NULL,
  `id_user` INT(11) NULL,
  `id_davar` INT(11) NULL,
  `vaziate_taiide` INT(11) NULL, 
  `vaziate_moshahede` INT(11) NULL, 
   PRIMARY KEY  (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8; 

 */

class rtgkonfranse_artcle
{
	public $ID;
	public $onvan;
	public $kholase;
	public $vazheganekilidi;
	public $iduser;
	public $vaziatetaiid;
	public $vaziatemoshahede;
	public $nevisandeye1;
	public $nevisandeye2;
	public $nevisandeye3;
	public $nevisandeye4;
	public $mehvaremagale;
	public $file1;
	public $file2;
	public $iddavar;
	public $nazaredavar;
	public $eslahat;
	
	public $tarikhesabt;
	public $tarikhevirayesh;
	public $tarikheersalbedavar;
	public $tarikhemoshahedeyedavar;
	public $tarikheerjaazdavar;
	public $tarikhedavari;
	public $erjashodebemodir;


	
	
	public function __construct()
	{
		$this->ID=-1;
		$this->onvan='';
		$this->kholase='';
		$this->vazheganekilidi='';
		$this->iduser=-1;
		$this->vaziatetaiid=Vaziate_taiid::na_moshakhas;
		$this->vaziatemoshahede=Vaziate_moshahede::erjanashode_be_davar;
		$this->nevisandeye1=-1;
		$this->nevisandeye2=-1;
		$this->nevisandeye3=-1;
		$this->nevisandeye4=-1;
		$this->mehvaremagale=-1;
		$this->file1='';
		$this->file2='';
		$this->iddavar;
		$this->nazaredavar='';
		$this->eslahat='';
		
		
		$defaultdatetime =& JFactory::getDate();
		$defaultdatetime->setDate(1000,01,01);
		$this->tarikhedavari=$defaultdatetime;
		$this->tarikheerjaazdavar=$defaultdatetime;
		$this->tarikheersalbedavar=$defaultdatetime;
		$this->tarikhemoshahedeyedavar=$defaultdatetime;
		$this->tarikhesabt=$defaultdatetime;
		$this->tarikhevirayesh=$defaultdatetime;
		$this->erjashodebemodir=0;
	} 
	
	public function new1($_onvan ,$_kholase ,$_name_nevisandeye1, $_name_nevisandeye2 , $_name_nevisandeye3 , $_name_nevisandeye4 ,
			 $_vazhegane_kilidi , $_file1 , $_file2 , $_ID_user , $_mehvaremagale,
			$_tarikhedavari,$_tarikheerjaazdavar,$_tarikheersalbedavar, $_tarikhemoshahedeyedavar ,$_tarikhesabt,$_tarikhevirayesh,$_erjashodebemodir)
	{
		$this->onvan = $_onvan;
		$this->kholase = $_kholase;
		$this->nevisandeye1 = $_name_nevisandeye1;
		$this->nevisandeye2 = $_name_nevisandeye2;
		$this->nevisandeye3 = $_name_nevisandeye3;
		$this->nevisandeye4 = $_name_nevisandeye4;
		$this->vazheganekilidi = $_vazhegane_kilidi;
		$this->file1 = $_file1;
		$this->file2 = $_file2;
		$this->iduser = $_ID_user;
		$this->mehvaremagale = $_mehvaremagale;
		
		$this->tarikhedavari=$_tarikhedavari;
		$this->tarikheerjaazdavar=$_tarikheerjaazdavar;
		$this->tarikheersalbedavar=$_tarikheersalbedavar;
		$this->tarikhemoshahedeyedavar=$_tarikhemoshahedeyedavar;
		$this->tarikhesabt=$_tarikhesabt;
		$this->tarikhevirayesh=$_tarikhevirayesh;
		$this->erjashodebemodir=$_erjashodebemodir;
	}
	
	public function new2($_id)
	{
		$db = JFactory::getDBO();
		$sql = 'select * from '.DBLayer::articlesv1_table_name.' where aid = '.(int)$_id;
		$db->setQuery((string)$sql);
		$results = $db->loadObjectList();
		
		if(count($results)<1)
			$this->ID = -1;
		else
		{
			$result = $results[0];
			$this->ID =$result->aid;
		
			$this->onvan=$result->onvan;
			$this->iddavar=$result->iddavar;
			$this->iduser = $result->iduser;
			$this->kholase = $result->kholase;
			$this->vazheganekilidi = $result->vazheganekilidi;
			$this->file1 = $result->file1;
			$this->file2 = $result->file2;
			$this->nevisandeye1 = $result->nevisandeye1;
			$this->nevisandeye2 = $result->nevisandeye2;
			$this->nevisandeye3 = $result->nevisandeye3;
			$this->nevisandeye4 = $result->nevisandeye4;
			$this->vaziatetaiid = $result->vaziatetaiid;
			$this->vaziatemoshahede=$result->vaziatemoshahede;
			$this->mehvaremagale = $result->mehvaremagale;
			$this->nazaredavar = $result->nazaredavar;
			$this->eslahat=$result->eslahat;
			
			$this->tarikhedavari=JFactory::getDate($result->tarikhedavari);
			$this->tarikheerjaazdavar=JFactory::getDate($result->tarikheerjaazdavar);
			$this->tarikheersalbedavar=JFactory::getDate($result->tarikheersalbedavar);
			$this->tarikhemoshahedeyedavar=JFactory::getDate($result->tarikhemoshahedeyedavar);
			$this->tarikhesabt=JFactory::getDate($result->tarikhesabt);
			$this->tarikhevirayesh=JFactory::getDate($result->tarikhevirayesh);
			$this->erjashodebemodir=$result->erjashodebemodir;			
		}
	}
	
	public function save()
	{
		
		$db = JFactory::getDBO();
		$sql = '';
		if($this->ID >0)//update
		{
			$sql = "update ".DBLayer::articlesv1_table_name." set onvan ='".$this->onvan
					."', iddavar=".$this->iddavar.", iduser=".$this->iduser.", kholase='".$this->kholase."' , vazheganekilidi = '".$this->vazheganekilidi."', file1 ='".$this->file1."', file2 = '".$this->file2."', nevisandeye1= '".$this->nevisandeye1."', nevisandeye2= '".$this->nevisandeye2."', nevisandeye3= '".$this->nevisandeye3."', nevisandeye4= '".$this->nevisandeye4."' , vaziatetaiid=".$this->vaziatetaiid." , vaziatemoshahede = ".$this->vaziatemoshahede.", mehvaremagale = ".$this->mehvaremagale." , nazaredavar = '".$this->nazaredavar."', eslahat='".$this->eslahat."' ".
					
					", tarikhedavari='".$this->tarikhedavari->toMySQL()."', tarikheerjaazdavar='".$this->tarikheerjaazdavar->toMySQL()."', tarikheersalbedavar='".$this->tarikheersalbedavar->toMySQL()."',".
					"tarikhemoshahedeyedavar='".$this->tarikhemoshahedeyedavar->toMySQL()."', tarikhesabt='".$this->tarikhesabt->toMySQL()."' , tarikhevirayesh='".$this->tarikhevirayesh->toMySQL()."' ,erjashodebemodir=".$this->erjashodebemodir." where aid = ".(int)$this->ID;
			$db->setQuery((string)$sql);
			//$db->query();
			if(!$db->query())
			{
				throw new exception($db->getErrorMsg());
			}
			return $this->ID;
		}
		else // insert new record
		{
			$sql = "insert into ".DBLayer::articlesv1_table_name.
			" (onvan,kholase,vazheganekilidi,iduser,vaziatetaiid,vaziatemoshahede,nevisandeye1,".
			"nevisandeye2,nevisandeye3,nevisandeye4,mehvaremagale,file1,file2,iddavar,nazaredavar,".
			"eslahat,tarikhedavari,tarikheerjaazdavar,tarikheersalbedavar,tarikhemoshahedeyedavar,tarikhesabt,".
			"tarikhevirayesh,erjashodebemodir) ".
			"values ('".$this->onvan."','".$this->kholase."','".$this->vazheganekilidi."',".
			(int)$this->iduser.",".(int)$this->vaziatetaiid.",".(int)$this->vaziatemoshahede.",".
			(int)$this->nevisandeye1.",".(int)$this->nevisandeye2.",".(int)$this->nevisandeye3.",".
			(int)$this->nevisandeye4.",".(int)$this->mehvaremagale.",'".$this->file1."','".$this->file2.
			"',".(int)$this->iddavar.",'".$this->nazaredavar."','".$this->eslahat."'".
			",'".$this->tarikhedavari->toMySQL()."','".$this->tarikheerjaazdavar->toMySQL()."','".$this->tarikheersalbedavar->toMySQL()."','".
			$this->tarikhemoshahedeyedavar->toMySQL()."','".$this->tarikhesabt->toMySQL()."','".$this->tarikhevirayesh->toMySQL()."',".$this->erjashodebemodir.")";
			//echo "<br/>".$sql."<br/>";
			//"',".(int)$this->ID_davar.",".(int)$this->ID_user.",'".$this->kholase."' , '".$this->liste_kalemate_klidi."' , '".$this->name_file."' , '".$this->name_nevisandegan."' , ".(int)$this->vaziate_taiide.", ".(int)$this->vaziate_moshahede.")";
			$db->setQuery((string)$sql);
			$db->query();
			
			/*
			if(!$db->query())
			{
				throw new exception($db->getErrorMsg());
			}
			*/
			
			$__id =$db->insertid();
			$this->ID = $__id;
			return $__id;
		}
	}
	
	public static function getArticles()
	{
		$db = JFactory::getDBO();
		$sql = 'select * from '.DBLayer::articlesv1_table_name;
		$db->setQuery((string)$sql);
		$results = $db->loadObjectList();
		return $results;		
	}
	
	public static function getDavarArticles($davarid)
	{
		$db = JFactory::getDBO();
		$sql = 'select * from '.DBLayer::articlesv1_table_name.' where iddavar = '.(int)$davarid;
		$db->setQuery((string)$sql);
		$results = $db->loadObjectList();
		return $results;
	}	
	
	public static function getUserArticles($user_id)
	{
		$db = JFactory::getDBO();
		$sql = 'select * from '.DBLayer::articlesv1_table_name.' where iduser = '.(int)$user_id;
		$db->setQuery((string)$sql);
		$results = $db->loadObjectList();
		return $results;
	}
	
	
}


