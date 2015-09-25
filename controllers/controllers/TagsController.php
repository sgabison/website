<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;
use Website\Tool\Request;
 
class TagsController extends Useraware
{
	public function addtagsAction(){
		$this->disableLayout();
	}

	public function tagsListAction(){
		$reponse = new Reponse();
        $societe=$this->societe;
		$tags=$societe->getTags();
       	//we check if we are in the Editor
		if( $_POST['action'] ){
			//if REMOVE
			if($_POST['action'] =="remove"){
				foreach( $_POST['id'] as $id){
					$tag=Object_Tags::getById( $id, 1);
					if( $tag instanceof \Object\Tags){
						$tag->delete();
					}
				}
				$reponse->message='TXT_TAGS_LIST';
				$reponse->success=true;
				$reponse->data ='';	
			}
			//if EDIT
			if($_POST['action'] =="edit"){
				$tag=\Object\Tags::getById( $_POST['id'], 1 );
				if($tag instanceof Object\Tags){
					$tag->setCode($_POST['data']['code']);
					$tag->setTag($_POST['data']['name_en'], "en");
					$tag->setTag($_POST['data']['name_fr'], "fr_FR");
					$tag->setIcon($_POST['data']['icon']);
					$tag->save();
				}
				$data=$_POST['data'];
				$data['DT_RowId']="row_".$_POST['data']['id'];
				$reponse->message='TXT_TAGS_LIST';
				$reponse->success=true;
				$reponse->row =$data;	
			}
			//if CREATE
			if($_POST['action'] =="create"){
				$row['code']=$_POST['data']['code'];
				$row['name_fr']=$_POST['data']['name_fr'];
				$row['name_en']=$_POST['data']['name_en'];
				$row['icon']=$_POST['data']['icon'];
				$current=Object\Tags::getByCode($row['code'],1);
				if( $current instanceof Object\Tags ){
					$error['code']="code";
					$error['status']="Tag already exists";
					$reponse->fieldErrors = array($error);				
				}else{
					$result=$societe->createTag($row);
					if ($result instanceof \Object\Tags) {
						$row['DT_RowId']=$result->getId();
						$row['id']=$result->getId();
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
			foreach( $tags as $key=>$tag ){
				$i++;
				$array=array();
				$array=$tag->toArray();
				$array['id']=$tag->getId();
				$array['DT_RowId']=$tag->getId();;
		        array_push($data, $array);
			}
			$reponse->message='TXT_TAGS_LIST';
			$reponse->success=true;
			$reponse->data =$data;	
		}
        $this->render($reponse);
	}
}