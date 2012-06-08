<?php

class AutoModeler_Gateway_Groups extends AutoModeler_Gateway_Database
{
	protected $_model_name = 'Model_Group';
	protected $_table_name = 'groups';

	public function find_groups(Database_Query_Builder_Select $select)
	{
		return $this->_load_set($select);
	}

	public function find_group($id, Database_Query_Builder_Select $select)
	{
		$select->where('id', '=', $id);
		return $this->_load_object($select);
	}

	// TODO: convert to proper DI
	public function assign_groups_to_user($user_id, array $groups, Database_Query_Builder_Insert $insert = NULL)
	{
		if ( ! empty($groups))
		{
			if ($insert === NULL)
			{
				$insert = db::insert('users_groups', ['user_id', 'group_id']);
			}

			$insert->values($groups);
			$insert->execute($this->_db);
		}
	}
}
