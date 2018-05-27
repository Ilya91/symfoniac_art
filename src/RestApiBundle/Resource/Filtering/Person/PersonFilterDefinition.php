<?php

namespace RestApiBundle\Resource\Filtering\Person;

use RestApiBundle\Resource\Filtering\AbstractFilterDefinition;
use RestApiBundle\Resource\Filtering\FilterDefinitionInterface;
use RestApiBundle\Resource\Filtering\SortableFilterDefinitionInterface;

class PersonFilterDefinition
    extends AbstractFilterDefinition
    implements FilterDefinitionInterface, SortableFilterDefinitionInterface
{
    /**
     * @var null|string
     */
    private $firstName;
    /**
     * @var null|string
     */
    private $lastName;
    /**
     * @var null|string
     */
    private $birthFrom;
    /**
     * @var null|string
     */
    private $birthTo;
    /**
     * @var null|string
     */
    private $sortBy;
    /**
     * @var array|null
     */
    private $sortByArray;

    public function __construct(
         $firstName,
         $lastName,
         $birthFrom,
         $birthTo,
         $sortByQuery,
         $sortByArray
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthFrom = $birthFrom;
        $this->birthTo = $birthTo;
        $this->sortBy = $sortByQuery;
        $this->sortByArray = $sortByArray;
    }

    public function getParameters()
    {
        return get_object_vars($this);
    }

    public function getSortByQuery()
    {
        return $this->sortBy;
    }

    public function getSortByArray()
    {
        return $this->sortByArray;
    }

    /**
     * @return null|string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return null|string
     */
    public function getBirthFrom()
    {
        return $this->birthFrom;
    }

    /**
     * @return null|string
     */
    public function getBirthTo()
    {
        return $this->birthTo;
    }
}