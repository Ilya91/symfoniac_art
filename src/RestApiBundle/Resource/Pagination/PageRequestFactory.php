<?php

namespace RestApiBundle\Resource\Pagination;

use Symfony\Component\HttpFoundation\Request;

class PageRequestFactory
{
     const KEY_LIMIT = 'limit';
     const KEY_PAGE = 'page';
     const DEFAULT_LIMIT = 5;
     const DEFAULT_PAGE = 1;

    public function fromRequest(Request $request)
    {
        $page = $request->get(
            self::KEY_PAGE,
            self::DEFAULT_PAGE
        );
        $limit = $request->get(
            self::KEY_LIMIT,
            self::DEFAULT_LIMIT
        );

        return new Page($page, $limit);
    }
}