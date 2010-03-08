<?php
/**
 * Item DataMapper Model
 *
 *
 * @license		MIT License
 * @category	Models
 * @author		James Broad
 * @link		http://www.kulor.com
 */

class Item extends DataMapper {
	
	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------
	
	var $validation = array(
		array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => array('required')
        ),
		array(
	        'field' => 'datetime',
	        'label' => 'Date',
	        'rules' => array('required', 'date_format')
	    ),
	);
	
	
	// --------------------------------------------------------------------
	// Default Ordering
	// --------------------------------------------------------------------
	
	var $default_order_by = array('title', 'id' => 'desc');
	
	// --------------------------------------------------------------------

	/**
	 * Constructor: calls parent constructor
	 */
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
	
	// --------------------------------------------------------------------
	// Custom Validation Rules
	//   Add custom validation rules for this model here.
	// --------------------------------------------------------------------
	
	function _date_format($field)
	{
		if (!empty($this->{$field}))
		{
			$mysqltime = date ("Y-m-d H:i:s", strtotime($this->{$field}));
			$this->{$field} = $mysqltime;
		}
	}
	
	
	// --------------------------------------------------------------------
	// Create the database that this model requires
	// --------------------------------------------------------------------

	function create_database()
	{
		if ($this->database_exists($this->db->database))
		{
			return 'Database: ' . $this->db->database . ' exists';
		}
		
		else
		{
			$this->load->dbforge();
			if ($this->dbforge->create_database($this->db->database))
			{
			    return 'Database: ' . $this->db->database . ' created!';
			}
		}
		return false;
	}

	
	// --------------------------------------------------------------------
	// Not present in the database driver class? Needs to be ported
	// --------------------------------------------------------------------
	
	function database_exists($database_name = '')
	{
		if(isset($database_name) && !empty($database_name))
		{
			$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $database_name . "' LIMIT 0 , 30";
			$query = $this->db->query($sql);
			$result = $query->num_rows();
			return $result;
		}
		return;
	}

	// --------------------------------------------------------------------
	// Create the database table that this model requires
	// --------------------------------------------------------------------
	
	function create_table()
	{
		$this->load->dbforge();
		print_r($this);
		$fields = array(
						'title' => array(
							'type' => 'VARCHAR',
							'constraint' => '100'
						),
						'datetime' => array(
							'type' => 'TEXT',
							'null' => TRUE
						)
					);
							
		$this->dbforge->add_field('id'); // gives id INT(9) NOT NULL AUTO_INCREMENT
		$this->dbforge->add_field($fields);
		$res = $this->dbforge->create_table($this->table_name, TRUE); // gives CREATE TABLE IF NOT EXISTS table_name
		return $res;
	}
}
/* End of file item.php */
/* Location: ./application/models/item.php */