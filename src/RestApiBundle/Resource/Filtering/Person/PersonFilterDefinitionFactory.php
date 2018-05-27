<?php

namespace RestApiBundle\Resource\Filtering\Person;

use RestApiBundle\Resource\Filtering\AbstractFilterDefinitionFactory;
use RestApiBundle\Resource\Filtering\FilterDefinitionFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class PersonFilterDefinitionFactory
    extends AbstractFilterDefinitionFactory
    implements FilterDefinitionFactoryInterface
{
    const ACCEPTED_SORT_FIELDS = ['id', 'firstName', 'lastName', 'dateOfBirth'];

    public function factory(Request $request)
    {
        return new PersonFilterDefinition(
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('birthFrom'),
            $request->get('birthTo'),
            $request->get('sortBy'),
            $this->sortQueryToArray($request->get('sortBy'))
        );
    }

    public function getAcceptedSortFields()
    {
        return self::ACCEPTED_SORT_FIELDS;
    }
}