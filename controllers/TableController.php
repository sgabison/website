<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;
use Website\Tool\Request;

class TableController extends Useraware
{
   public function tableListAction() {
    	$reponse = new Reponse();
    	$locationid=$this->getParam('locationid');
        $location=\Object\Location::getById( $locationid, 1);
        if( $location instanceof \Object\Location ){
        	$tables=$location->getTables();
			if( $_POST['action'] ){
				//if REMOVE
				if($_POST['action'] =="remove"){
					foreach( $_POST['id'] as $id){
						$table=\Object\Table::getById( $id, 1);
						if( $table instanceof \Object\Table){
							$table->delete();
						}
					}
					$reponse->message='TXT_TABLE_LIST';
					$reponse->success=true;
					$reponse->data ='';	
				}
				//if EDIT
				if($_POST['action'] =="edit"){
					$table=\Object\Table::getById( $_POST['id'], 1 );
					if($table instanceof \Object\Table){
						$table->setSalle($_POST['data']['salle']);
						$table->setTable($_POST['data']['table']);
						$table->setSeats($_POST['data']['seats']);
						$table->setDescription($_POST['data']['description']);
						$table->save();
					}
					$data=$_POST['data'];
					$data['DT_RowId']="row_".$_POST['data']['id'];
					$reponse->message='TXT_TABLE_LIST';
					$reponse->success=true;
					$reponse->row =$data;	
				}
				//if CREATE
				if($_POST['action'] =="create"){
					//SET DEFAULT DATA FROM LOCATION
					$row['salle']=$_POST['data']['salle'];
					$row['table']=$_POST['data']['table'];
					$row['seats']=$_POST['data']['seats'];
					$row['description']=$_POST['data']['description'];
					$current=Object\Table::getById($row['table'],1);
					if ($current instanceof \Object\Table) {
						$error['table']="table";
						$error['status']="Table already exists";
						$reponse->fieldErrors = array($error);
					}else{
						$result=$location->createTable($row);
						if ($result instanceof \Object\Table) {
							$row['DT_RowId']=$result->getId();
							$row['id']=$result->getId();
							$row['locationid']=$result->getLocation()->getId();
							$row['locationname']=$result->getLocation()->getName();
							$reponse->success = true;
							$reponse->message = "TXT_CREATE_OK" ;
							$reponse->row = $row;
							$reponse->debug = $data;
						} else {
							$reponse->success = false;
							$reponse->message = "TXT_CREATE_ERROR"  ;
							$reponse->row = $result;
							$reponse->debug = $result;
						}
					}
				}
			}else{
				$data=array();
				foreach( $tables as $key=>$table ){
					$i++;
					$array=array();
					$array=$table->toArray();
					$array['id']=$table->getId();
					$array['DT_RowId']=$table->getId();;
			        array_push($data, $array);
				}
				$reponse->message='TXT_TABLE_LIST';
				$reponse->success=true;
				$reponse->data =$data;	
			}
        } else {
			$reponse->message='TXT_TABLE_LIST';
			$reponse->success=false;
			$reponse->data =$data;	        
        }	
        $this->render($reponse);	    
    } 

	public function getDataAction () {
		// Get Request methode json decode
		$this->getAnswer();
	}

 	public function getAnswer ($tree=false) {
		$this->requete=new Request ( )	;
		$method = $this->requete->method; //$this->getParam('METHOD',$_SERVER["REQUEST_METHOD"]) ;
		$this->id = $this->requete->id;
		if($this->id>0):
		switch ($method) {
			case 'PUT':
				$reponse= $this->update();
				break;
			case 'DELETE':
				$reponse= $this->destroy();
				break;
			case 'GET':			
				$reponse= $this->view();			
				break;
			default:
				$reponse = new Reponse();
				$res->message = "Affichage des informations impossible avec id";
				$reponse->data=$this->requete->params;
		}
		else:
		switch ($method) {
			case 'GET':			
				$reponse= $this->view();			
				break;
			case 'POST':
				$reponse= $this->create();
				if ($reponse->success) :
				//   do something
				endif;
				break;
			default:
				$reponse = new Reponse();
				$reponse->data=$this->requete->params;
				$reponse->message = "Affichage des informations impossible";
		}
		endif;
		$this->render($reponse);
	}
	/**
	 * view
	 */
	public function view($keyterm ='') {
		$res = new Reponse();
		$res->isTree = false;
		$res->data = $this->getArray($this->getList());
		$res->success = true;
		$res->message = "Affichage des informations";
		return $res;
	}
	/**
	 * update
	 */
	public function update() {
		$res = new Reponse();
		$serving=\Object\Table::getById($this->id);
		if ($serving instanceof Pimcore\Model\Object\Table) {
			$serving->setValues( $this->requete->params );
			$serving->save();
			$res->data =  $serving->toArray();
			$res->success = true;
			$res->message ="TXT_UPDATE_OK";
		} else {
			$res->data =  $this->requete->params;
			$res->success = false;
			$res->message = "TXT_UPDATE_ERROR" ;
		}
		return $res;
	}
	/**
	 * destroy
	 */
	public function destroy() {
		$res = new Reponse();
		$rec= \Object\Table::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'Destroyed';
		} else {
			$res->message = "Failed to destroy";
		}
		return $res;
	}

}