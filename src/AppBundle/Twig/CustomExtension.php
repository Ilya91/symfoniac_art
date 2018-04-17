<?php

namespace AppBundle\Twig;

use AppBundle\Service\CacheTransformer;

class CustomExtension extends \Twig_Extension
{
    private $cacheTransformer;

    public function __construct(CacheTransformer $cacheTransformer)
    {
        $this->cacheTransformer = $cacheTransformer;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('markdownify', array($this, 'parseMarkdown'), [
                'is_safe' => ['html']
            ])
        ];
    }

    public function parseMarkdown($str)
    {
        return $this->cacheTransformer->parse($str);
    }

    public function getName()
    {
        return 'app_cache';
    }
}
