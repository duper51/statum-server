<?php

namespace Me\Models\Me\Models\Base;

use \Exception;
use \PDO;
use Me\Models\Me\Models\Appliances as ChildAppliances;
use Me\Models\Me\Models\AppliancesQuery as ChildAppliancesQuery;
use Me\Models\Me\Models\Map\AppliancesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'appliances' table.
 *
 *
 *
 * @method     ChildAppliancesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAppliancesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildAppliancesQuery orderByMemberof($order = Criteria::ASC) Order by the memberOf column
 * @method     ChildAppliancesQuery orderByLastping($order = Criteria::ASC) Order by the lastPing column
 *
 * @method     ChildAppliancesQuery groupById() Group by the id column
 * @method     ChildAppliancesQuery groupByName() Group by the name column
 * @method     ChildAppliancesQuery groupByMemberof() Group by the memberOf column
 * @method     ChildAppliancesQuery groupByLastping() Group by the lastPing column
 *
 * @method     ChildAppliancesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAppliancesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAppliancesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAppliancesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAppliancesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAppliancesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAppliances findOne(ConnectionInterface $con = null) Return the first ChildAppliances matching the query
 * @method     ChildAppliances findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAppliances matching the query, or a new ChildAppliances object populated from the query conditions when no match is found
 *
 * @method     ChildAppliances findOneById(int $id) Return the first ChildAppliances filtered by the id column
 * @method     ChildAppliances findOneByName(string $name) Return the first ChildAppliances filtered by the name column
 * @method     ChildAppliances findOneByMemberof(int $memberOf) Return the first ChildAppliances filtered by the memberOf column
 * @method     ChildAppliances findOneByLastping(string $lastPing) Return the first ChildAppliances filtered by the lastPing column *

 * @method     ChildAppliances requirePk($key, ConnectionInterface $con = null) Return the ChildAppliances by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAppliances requireOne(ConnectionInterface $con = null) Return the first ChildAppliances matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAppliances requireOneById(int $id) Return the first ChildAppliances filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAppliances requireOneByName(string $name) Return the first ChildAppliances filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAppliances requireOneByMemberof(int $memberOf) Return the first ChildAppliances filtered by the memberOf column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAppliances requireOneByLastping(string $lastPing) Return the first ChildAppliances filtered by the lastPing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAppliances[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAppliances objects based on current ModelCriteria
 * @method     ChildAppliances[]|ObjectCollection findById(int $id) Return ChildAppliances objects filtered by the id column
 * @method     ChildAppliances[]|ObjectCollection findByName(string $name) Return ChildAppliances objects filtered by the name column
 * @method     ChildAppliances[]|ObjectCollection findByMemberof(int $memberOf) Return ChildAppliances objects filtered by the memberOf column
 * @method     ChildAppliances[]|ObjectCollection findByLastping(string $lastPing) Return ChildAppliances objects filtered by the lastPing column
 * @method     ChildAppliances[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AppliancesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Me\Models\Me\Models\Base\AppliancesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Me\\Models\\Me\\Models\\Appliances', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAppliancesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAppliancesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAppliancesQuery) {
            return $criteria;
        }
        $query = new ChildAppliancesQuery();
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
     * @return ChildAppliances|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AppliancesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AppliancesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAppliances A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, memberOf, lastPing FROM appliances WHERE id = :p0';
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
            /** @var ChildAppliances $obj */
            $obj = new ChildAppliances();
            $obj->hydrate($row);
            AppliancesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAppliances|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAppliancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AppliancesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAppliancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AppliancesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAppliancesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AppliancesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AppliancesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AppliancesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAppliancesQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AppliancesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the memberOf column
     *
     * Example usage:
     * <code>
     * $query->filterByMemberof(1234); // WHERE memberOf = 1234
     * $query->filterByMemberof(array(12, 34)); // WHERE memberOf IN (12, 34)
     * $query->filterByMemberof(array('min' => 12)); // WHERE memberOf > 12
     * </code>
     *
     * @param     mixed $memberof The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAppliancesQuery The current query, for fluid interface
     */
    public function filterByMemberof($memberof = null, $comparison = null)
    {
        if (is_array($memberof)) {
            $useMinMax = false;
            if (isset($memberof['min'])) {
                $this->addUsingAlias(AppliancesTableMap::COL_MEMBEROF, $memberof['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($memberof['max'])) {
                $this->addUsingAlias(AppliancesTableMap::COL_MEMBEROF, $memberof['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AppliancesTableMap::COL_MEMBEROF, $memberof, $comparison);
    }

    /**
     * Filter the query on the lastPing column
     *
     * Example usage:
     * <code>
     * $query->filterByLastping('2011-03-14'); // WHERE lastPing = '2011-03-14'
     * $query->filterByLastping('now'); // WHERE lastPing = '2011-03-14'
     * $query->filterByLastping(array('max' => 'yesterday')); // WHERE lastPing > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastping The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAppliancesQuery The current query, for fluid interface
     */
    public function filterByLastping($lastping = null, $comparison = null)
    {
        if (is_array($lastping)) {
            $useMinMax = false;
            if (isset($lastping['min'])) {
                $this->addUsingAlias(AppliancesTableMap::COL_LASTPING, $lastping['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastping['max'])) {
                $this->addUsingAlias(AppliancesTableMap::COL_LASTPING, $lastping['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AppliancesTableMap::COL_LASTPING, $lastping, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAppliances $appliances Object to remove from the list of results
     *
     * @return $this|ChildAppliancesQuery The current query, for fluid interface
     */
    public function prune($appliances = null)
    {
        if ($appliances) {
            $this->addUsingAlias(AppliancesTableMap::COL_ID, $appliances->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the appliances table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AppliancesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AppliancesTableMap::clearInstancePool();
            AppliancesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AppliancesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AppliancesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AppliancesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AppliancesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AppliancesQuery
