<?php

namespace RestApiBundle\Resource\Filtering\Movie;

use RestApiBundle\Resource\Filtering\AbstractFilterDefinition;
use RestApiBundle\Resource\Filtering\FilterDefinitionInterface;
use RestApiBundle\Resource\Filtering\SortableFilterDefinitionInterface;

class MovieFilterDefinition
    extends AbstractFilterDefinition
    implements FilterDefinitionInterface, SortableFilterDefinitionInterface
{
    /**
     * @var null|string
     */
    private $title;
    /**
     * @var int|null
     */
    private $yearFrom;
    /**
     * @var int|null
     */
    private $yearTo;
    /**
     * @var int|null
     */
    private $timeFrom;
    /**
     * @var int|null
     */
    private $timeTo;
    /**
     * @var null|string
     */
    private $sortBy;
    /**
     * @var array|null
     */
    private $sortByArray;

    public function __construct(
         $title,
         $yearFrom,
         $yearTo,
         $timeFrom,
         $timeTo,
         $sortByQuery,
         $sortByArray
    )
    {
        $this->title = $title;
        $this->yearFrom = $yearFrom;
        $this->yearTo = $yearTo;
        $this->timeFrom = $timeFrom;
        $this->timeTo = $timeTo;
        $this->sortBy = $sortByQuery;
        $this->sortByArray = $sortByArray;
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getYearFrom()
    {
        return $this->yearFrom;
    }

    /**
     * @return int|null
     */
    public function getYearTo()
    {
        return $this->yearTo;
    }

    /**
     * @return int|null
     */
    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    /**
     * @return int|null
     */
    public function getTimeTo()
    {
        return $this->timeTo;
    }

    /**
     * @return null|string
     */
    public function getSortByQuery()
    {
        return $this->sortBy;
    }

    /**
     * @return array|null
     */
    public function getSortByArray()
    {
        return $this->sortByArray;
    }

    public function getParameters()
    {
        return get_object_vars($this);
    }
}