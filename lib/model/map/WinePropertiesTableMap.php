<?php


/**
 * This class defines the structure of the 'wine_properties' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class WinePropertiesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.WinePropertiesTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('wine_properties');
		$this->setPhpName('WineProperties');
		$this->setClassname('WineProperties');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addForeignKey('WINE_ID', 'WineId', 'INTEGER', 'wines', 'ID', true, null, null);
		$this->addForeignKey('WINE_PROPERTY_VALUE_ID', 'WinePropertyValueId', 'INTEGER', 'wine_property_value', 'ID', true, null, null);
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Wines', 'Wines', RelationMap::MANY_TO_ONE, array('wine_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('WinePropertyValue', 'WinePropertyValue', RelationMap::MANY_TO_ONE, array('wine_property_value_id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // WinePropertiesTableMap
