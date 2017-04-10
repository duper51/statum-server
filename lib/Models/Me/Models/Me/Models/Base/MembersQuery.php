<?php

namespace Me\Models\Me\Models\Base;

use \Exception;
use \PDO;
use Me\Models\Me\Models\Members as ChildMembers;
use Me\Models\Me\Models\MembersQuery as ChildMembersQuery;
use Me\Models\Me\Models\Map\MembersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'members' table.
 *
 *
 *
 * @method     ChildMembersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMembersQuery orderByApplianceid($order = Criteria::ASC) Order by the applianceId column
 * @method     ChildMembersQuery orderByServiceid($order = Criteria::ASC) Order by the serviceId column
 *
 * @method     ChildMembersQuery groupById() Group by the id column
 * @method     ChildMembersQuery groupByApplianceid() Group by the applianceId column
 * @method     ChildMembersQuery groupByServiceid() Group by the serviceId column
 *
 * @method     ChildMembersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMembersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMembersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMembersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMembersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMembersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMembers findOne(ConnectionInterface $con = null) Return the first ChildMembers matching the query
 * @method     ChildMembers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMembers matching the query, or a new ChildMembers object populated from the query conditions when no match is found
 *
 * @method     ChildMembers findOneById(int $id) Return the first ChildMembers filtered by the id column
 * @method     ChildMembers findOneByApplianceid(int $applianceId) Return the first ChildMembers filtered by the applianceId column
 * @method     ChildMembers findOneByServiceid(int $serviceId) Return the first ChildMembers filtered by the serviceId column *

 * @method     ChildMembers requirePk($key, ConnectionInterface $con = null) Return the ChildMembers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMembers requireOne(ConnectionInterface $con = null) Return the first ChildMembers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMembers requireOneById(int $id) Return the first ChildMembers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMembers requireOneByApplianceid(int $applianceId) Return the first ChildMembers filtered by the applianceId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMembers requireOneByServiceid(int $serviceId) Return the first ChildMembers filtered by the serviceId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMembers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMembers objects based on current ModelCriteria
 * @method     ChildMembers[]|ObjectCollection findById(int $id) Return ChildMembers objects filtered by the id column
 * @method     ChildMembers[]|ObjectCollection findByApplianceid(int $applianceId) Return ChildMembers objects filtered by the applianceId column
 * @method     ChildMembers[]|ObjectCollection findByServiceid(int $serviceId) Return ChildMembers objects filtered by the serviceId column
 * @method     ChildMembers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MembersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Me\Models\Me\Models\Base\MembersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Me\\Models\\Me\\Models\\Members', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMembersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMembersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMembersQuery) {
            return $criteria;
        }
        $query = new ChildMembersQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildMembers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MembersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MembersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMembers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, applianceId, serviceId FROM members WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildMembers $obj */
            $obj = new ChildMembers();
            $obj->hydrate($row);
            MembersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildMembers|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildMembersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MembersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMembersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MembersTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMembersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MembersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MembersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MembersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the applianceId column
     *
     * Example usage:
     * <code>
     * $query->filterByApplianceid(1234); // WHERE applianceId = 1234
     * $query->filterByApplianceid(array(12, 34)); // WHERE applianceId IN (12, 34)
     * $query->filterByApplianceid(array('min' => 12)); // WHERE applianceId > 12
     * </code>
     *
     * @param     mixed $applianceid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMembersQuery The current query, for fluid interface
     */
    public function filterByApplianceid($applianceid = null, $comparison = null)
    {
        if (is_array($applianceid)) {
            $useMinMax = false;
            if (isset($applianceid['min'])) {
                $this->addUsingAlias(MembersTableMap::COL_APPLIANCEID, $applianceid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($applianceid['max'])) {
                $this->addUsingAlias(MembersTableMap::COL_APPLIANCEID, $applianceid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MembersTableMap::COL_APPLIANCEID, $applianceid, $comparison);
    }

    /**
     * Filter the query on the serviceId column
     *
     * Example usage:
     * <code>
     * $query->filterByServiceid(1234); // WHERE serviceId = 1234
     * $query->filterByServiceid(array(12, 34)); // WHERE serviceId IN (12, 34)
     * $query->filterByServiceid(array('min' => 12)); // WHERE serviceId > 12
     * </code>
     *
     * @param     mixed $serviceid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMembersQuery The current query, for fluid interface
     */
    public function filterByServiceid($serviceid = null, $comparison = null)
    {
        if (is_array($serviceid)) {
            $useMinMax = false;
            if (isset($serviceid['min'])) {
                $this->addUsingAlias(MembersTableMap::COL_SERVICEID, $serviceid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($serviceid['max'])) {
                $this->addUsingAlias(MembersTableMap::COL_SERVICEID, $serviceid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MembersTableMap::COL_SERVICEID, $serviceid, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMembers $members Object to remove from the list of results
     *
     * @return $this|ChildMembersQuery The current query, for fluid interface
     */
    public function prune($members = null)
    {
        if ($members) {
            $this->addUsingAlias(MembersTableMap::COL_ID, $members->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the members table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MembersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MembersTableMap::clearInstancePool();
            MembersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MembersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MembersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MembersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MembersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MembersQuery
