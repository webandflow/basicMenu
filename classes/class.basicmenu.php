<?php
	
class BasicMenu {
	
	public $output;
	private $mainMenuItems;
	private $currentIdx;

	function __construct($parent='0',&$modx) {
		$this->modx					= $modx;		
		$this->currentIdx			= 1; // used by drop down menus
		
	} // end __constrct()
	
	private function getMenuItemsFromParent($parent=0) {
	
		$c = $this->modx->newQuery('modResource');
		$c->sortby('menuindex','ASC');
		$c->where(array('parent'	=> $parent,
					'hidemenu'	=> 0,
					'published'	=> 1,
					'deleted' => 0
					));
	
		$collection			= $this->modx->getCollection('modResource',$c);						
								
		return $collection;
												
	} // end getMenuItemsFromParent
	
	private function parseMenu() {
	
		$mainmenuitems			= $this->getMenuItemsFromParent();
		
		// init this output
		$output				= '';
        
        // get the count so we know which separator to use
        $count              = count($mainmenuitems);
        $i = 0;
        
        // collect and process each of the main menu items		
		foreach($mainmenuitems as $mainmenuitem) {
		    $i++;
		    
		  $data               = array();
			$data['menutitle']	= $mainmenuitem->get('menutitle');
			$data['longtitle']	= $mainmenuitem->get('longtitle');
			$data['id']		      = $mainmenuitem->get('id');
      $data['dropdown']   = $this->getDropdown($data['id']);
      $data['separator']  = ($i == $count) ? "&nbsp;" : "";
      $data['ddClass']    = ($data['dropdown'] != '') ? 'has_dropdown' : 'no_dropdown';
      $data['lastClass']  = ($i == $count) ? 'last_menu' : '';

      $output            .= $this->modx->getChunk('mainMenuItemTpl',$data);

		} // end foreach 
	
		return $output;
	
	} // end parseMenu
	
	private function getDropdown($parent=1) {
		
		$output				= '';
		$items              = '';
		$ddItems			= $this->getMenuItemsFromParent($parent);
		
		$itemCount			= count($ddItems);
		
		if($itemCount > 0) {
			foreach ($ddItems as $dd) {
			    $data                = array();
				$data['menutitle']	 = $dd->get('menutitle');
				$data['longtitle']	 = $dd->get('longtitle');
				$data['id']			 = $dd->get('id');
				
				$items			    .= $this->modx->getChunk('subMenuItemTpl',$data);
	
	
			} // end foreach
			
			$data = array();
			$data['items']   = $items;
			$data['idx']     = $this->currentIdx;
			
			$output          .= $this->modx->getChunk('subMenuTpl',$data);

         }

		$this->currentIdx++;


	
		return $output;

	} // end getDropdown()
	
	
	public function showMenu() {
		$menu		= $this->parseMenu();
		return $menu;
	}
	 
}
	
	
?>