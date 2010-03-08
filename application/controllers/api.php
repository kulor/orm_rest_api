<?php
/**
 * Api Controller
 *
 *
 * @license		MIT License
 * @category	Models
 * @author		James Broad
 * @link		http://www.kulor.com
 */

require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller
{
	function item_get()
    {
        if(!$this->get('id')){
        	$this->response(NULL, 400);
        }

		$items = new Item();
		$items->where('id', $this->get('id'));
		$items->get();
		
		$results = $this->object_to_array($items);
		
        if($results)
		{
            $this->response($results, 200); // 200 being the HTTP response code
        }
		
		else
		{
            $this->response(array('error' => 'item could not be found'), 404);
        }
    }
    
    function item_post()
    {
        $message = array(
						'id' => $this->get('id'),
						'title' => $this->post('title')
						);
        $item = new Item();
		$item->title = $this->post('title');
		$item->datetime = $this->post('datetime');
		$item->save();
        $this->response($message, 200); // 200 being the HTTP response code
    }
    

    function item_delete()
    {
		$item = new Item();
		$item->where('id', $this->post('id'));
		$item->get();
		$item->delete();

        $message = array('id' => $this->post('id'), 'message' => 'DELETED!');
        $this->response($message, 200); // 200 being the HTTP response code
    }


	/**
		Turn an object result into an accociative array
	*/
	
	protected function object_to_array($object)
	{
		if(is_object($object) && !empty($object->all))
		{
			// Turn the object values into an array for output
			$results = array();
			$resultMap = array();
			$objectFields = $object->all[0]->fields;
		
			foreach($object->all as $row)
			{
				foreach($objectFields as $field)
				{
					$resultMap[$field] = $row->$field;
				}
				$results[] = $resultMap;
			}
			return $results;
		}
		return false;
	}
	
    
    function items_get()
    {
		$items = new Item();
		$items->get();
		
		$results = $this->object_to_array($items);
        
        if($results)
		{
            $this->response($results, 200); // 200 being the HTTP response code
        }

        else
		{
            $this->response(array('error' => 'Couldn\'t find any items!'), 404);
        }
    }   
}

?>