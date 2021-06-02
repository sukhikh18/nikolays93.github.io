<?php

namespace Boilerplate;

use Bitrix\Main\Entity;

/**
 * Class Boilerplate\DataTable
 *
 * Fields:
 * <ul>
 * <li> ID int
 * <li> TITLE string
 * <li> SORT int optional default 500
 * <li> CREATED datetime default 'CURRENT_TIMESTAMP'
 * </ul>
 **/

class DataTable extends Entity\DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'boilerplate_module';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
				'title' => 'ID',
			),
			'TITLE' => array(
				'data_type' => 'text',
				'required' => true,
				'title' => 'Заголовок',
			),
			'SORT' => array(
				'data_type' => 'integer',
				'title' => 'Сортировка',
			),
			'CREATED' => array(
				'data_type' => 'datetime',
				'title' => 'Дата создания',
			),
		);
	}
}