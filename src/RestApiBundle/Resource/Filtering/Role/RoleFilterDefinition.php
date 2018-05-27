<?php

namespace RestApiBundle\Resource\Filtering\Role;

use RestApiBundle\Resource\Filtering\AbstractFilterDefinition;
use RestApiBundle\Resource\Filtering\FilterDefinitionInterface;
use RestApiBundle\Resource\Filtering\SortableFilterDefinitionInterface;

class RoleFilterDefinition
    extends AbstractFilterDefinition
    implements FilterDefinitionInterface, SortableFilterDefinitionInterface
{
    /**
     * @var null|string
     */
    private $playedName;
    /**
     * @var int|null
     */
    private $movie;
    /**
     * @var null|string
     */
    private $sortBy;
    /**
     * @var array|null
     */
    private $sortByArray;

    public function __construct(
         $playedName,
         $movie,
         $sortByQuery,
         $sortByArray
    )
    {
        $this->playedName = $playedName;
        $this->movie = $movie;
        $this->sortBy = $sortByQuery;
        $this->sortByArray = $sortByArray;
    }

    /**
     * @return null|string
     */
    public function getPlayedName()
    {
        return $this->playedName;
    }

    /**
     * @return int|null
     */
    public function getMovie()
    {
        return $this->movie;
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