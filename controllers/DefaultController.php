<?php

use Website\Controller\Action;
use Pimcore\Tool;
use Pimcore\File;
use Pimcore\Model\Translation;

class DefaultController extends Action {

	public function tradAction () {
		$this->disableLayout();
		$this->disableViewAutoRender();
//		Pimcore\Model\Translation\AbstractTranslation::clearDependentCache();
		
		if ($admin) {
			$list = new Pimcore\Model\Translation\Admin\Listing();
		} else {
			$list = new Pimcore\Model\Translation\Website\Listing();
		}
		
		$list->setOrder("asc");
		$list->setOrderKey("key");
		
		$condition = false; //	$this->getGridFilterCondition();
		if($condition) {
			$list->setCondition($condition);
		}
		
		$list->load();
		
		$translations = array();
		$translationObjects = $list->getTranslations();
		$lang=($this->language=="fr")?"fr_FR":$this->language;
		foreach($translationObjects as $t):
	 	if ( $t->getTranslation($lang) and $t->getKey() ) 
 	 		$tab[$this->language]["translation"][$t->getKey()]=$t->getTranslation($lang);//getTranslations();
		endforeach;
/*		$tab=array();
		$tab["fr"]["translation"]=array(
				"name"=>"nom",
				"send"=>"envoyer",
				"tabConfig"=>array(
						"name"=>"nom"
				)
				
		);
		if($this->language!= "fr"):
		endif;
*/
		$this->getResponse()
			->setHeader('Content-Type', 'text/javascript')
			->appendBody( \Zend_Json::encode( $tab ) );

	}

    public function layout() {
        $this->enableLayout();
    }
}
