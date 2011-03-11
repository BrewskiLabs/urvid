<?php

/**
 * Base class that represents a row from the 'wine_properties' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWineProperties extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        WinePropertiesPeer
	 */
	protected static $peer;

	/**
	 * The value for the wine_id field.
	 * @var        int
	 */
	protected $wine_id;

	/**
	 * The value for the wine_property_value_id field.
	 * @var        int
	 */
	protected $wine_property_value_id;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * @var        Wines
	 */
	protected $aWines;

	/**
	 * @var        WinePropertyValue
	 */
	protected $aWinePropertyValue;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'WinePropertiesPeer';

	/**
	 * Get the [wine_id] column value.
	 * 
	 * @return     int
	 */
	public function getWineId()
	{
		return $this->wine_id;
	}

	/**
	 * Get the [wine_property_value_id] column value.
	 * 
	 * @return     int
	 */
	public function getWinePropertyValueId()
	{
		return $this->wine_property_value_id;
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of [wine_id] column.
	 * 
	 * @param      int $v new value
	 * @return     WineProperties The current object (for fluent API support)
	 */
	public function setWineId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wine_id !== $v) {
			$this->wine_id = $v;
			$this->modifiedColumns[] = WinePropertiesPeer::WINE_ID;
		}

		if ($this->aWines !== null && $this->aWines->getId() !== $v) {
			$this->aWines = null;
		}

		return $this;
	} // setWineId()

	/**
	 * Set the value of [wine_property_value_id] column.
	 * 
	 * @param      int $v new value
	 * @return     WineProperties The current object (for fluent API support)
	 */
	public function setWinePropertyValueId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wine_property_value_id !== $v) {
			$this->wine_property_value_id = $v;
			$this->modifiedColumns[] = WinePropertiesPeer::WINE_PROPERTY_VALUE_ID;
		}

		if ($this->aWinePropertyValue !== null && $this->aWinePropertyValue->getId() !== $v) {
			$this->aWinePropertyValue = null;
		}

		return $this;
	} // setWinePropertyValueId()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     WineProperties The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WinePropertiesPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->wine_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->wine_property_value_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = WinePropertiesPeer::NUM_COLUMNS - WinePropertiesPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating WineProperties object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aWines !== null && $this->wine_id !== $this->aWines->getId()) {
			$this->aWines = null;
		}
		if ($this->aWinePropertyValue !== null && $this->wine_property_value_id !== $this->aWinePropertyValue->getId()) {
			$this->aWinePropertyValue = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WinePropertiesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = WinePropertiesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aWines = null;
			$this->aWinePropertyValue = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WinePropertiesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseWineProperties:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				WinePropertiesPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseWineProperties:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WinePropertiesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseWineProperties:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseWineProperties:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				WinePropertiesPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aWines !== null) {
				if ($this->aWines->isModified() || $this->aWines->isNew()) {
					$affectedRows += $this->aWines->save($con);
				}
				$this->setWines($this->aWines);
			}

			if ($this->aWinePropertyValue !== null) {
				if ($this->aWinePropertyValue->isModified() || $this->aWinePropertyValue->isNew()) {
					$affectedRows += $this->aWinePropertyValue->save($con);
				}
				$this->setWinePropertyValue($this->aWinePropertyValue);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = WinePropertiesPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WinePropertiesPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += WinePropertiesPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aWines !== null) {
				if (!$this->aWines->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWines->getValidationFailures());
				}
			}

			if ($this->aWinePropertyValue !== null) {
				if (!$this->aWinePropertyValue->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWinePropertyValue->getValidationFailures());
				}
			}


			if (($retval = WinePropertiesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(WinePropertiesPeer::DATABASE_NAME);

		if ($this->isColumnModified(WinePropertiesPeer::WINE_ID)) $criteria->add(WinePropertiesPeer::WINE_ID, $this->wine_id);
		if ($this->isColumnModified(WinePropertiesPeer::WINE_PROPERTY_VALUE_ID)) $criteria->add(WinePropertiesPeer::WINE_PROPERTY_VALUE_ID, $this->wine_property_value_id);
		if ($this->isColumnModified(WinePropertiesPeer::ID)) $criteria->add(WinePropertiesPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WinePropertiesPeer::DATABASE_NAME);

		$criteria->add(WinePropertiesPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of WineProperties (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setWineId($this->wine_id);

		$copyObj->setWinePropertyValueId($this->wine_property_value_id);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     WineProperties Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     WinePropertiesPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WinePropertiesPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Wines object.
	 *
	 * @param      Wines $v
	 * @return     WineProperties The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setWines(Wines $v = null)
	{
		if ($v === null) {
			$this->setWineId(NULL);
		} else {
			$this->setWineId($v->getId());
		}

		$this->aWines = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Wines object, it will not be re-added.
		if ($v !== null) {
			$v->addWineProperties($this);
		}

		return $this;
	}


	/**
	 * Get the associated Wines object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Wines The associated Wines object.
	 * @throws     PropelException
	 */
	public function getWines(PropelPDO $con = null)
	{
		if ($this->aWines === null && ($this->wine_id !== null)) {
			$this->aWines = WinesPeer::retrieveByPk($this->wine_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aWines->addWinePropertiess($this);
			 */
		}
		return $this->aWines;
	}

	/**
	 * Declares an association between this object and a WinePropertyValue object.
	 *
	 * @param      WinePropertyValue $v
	 * @return     WineProperties The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setWinePropertyValue(WinePropertyValue $v = null)
	{
		if ($v === null) {
			$this->setWinePropertyValueId(NULL);
		} else {
			$this->setWinePropertyValueId($v->getId());
		}

		$this->aWinePropertyValue = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the WinePropertyValue object, it will not be re-added.
		if ($v !== null) {
			$v->addWineProperties($this);
		}

		return $this;
	}


	/**
	 * Get the associated WinePropertyValue object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     WinePropertyValue The associated WinePropertyValue object.
	 * @throws     PropelException
	 */
	public function getWinePropertyValue(PropelPDO $con = null)
	{
		if ($this->aWinePropertyValue === null && ($this->wine_property_value_id !== null)) {
			$this->aWinePropertyValue = WinePropertyValuePeer::retrieveByPk($this->wine_property_value_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aWinePropertyValue->addWinePropertiess($this);
			 */
		}
		return $this->aWinePropertyValue;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aWines = null;
			$this->aWinePropertyValue = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseWineProperties:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseWineProperties::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseWineProperties
