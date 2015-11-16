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
	 		$tab2[$t->getKey()]=$t->getTranslation($lang);
		endforeach;
		$tab['lng'] = $this->language;
		$this->file_force_contents( \Zend_Json::encode( $tab2 ) );
		$this->getResponse()
			->setHeader('Content-Type', 'text/javascript')
			->appendBody( \Zend_Json::encode( $tab ) );

	}
	public function file_force_contents( $data, $flags = 0){
		$filename= PIMCORE_TMP_DIRECTORY.'/traduction/'.$this->language.'/trad.json';
		if ( !file_exists($filename) ) :
		
		if(!is_dir(dirname($filename)))
			mkdir(dirname($filename).'/', 0777, TRUE);
		return file_put_contents($filename, $data, $flags);
		else:
		return $filename;
		endif;
	}
	
	public function defaultAction () {
	}
	
    public function layout() {
        $this->enableLayout();
    }
}
