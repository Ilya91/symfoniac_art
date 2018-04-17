<?php

namespace AppBundle\Service;

use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class CacheTransformer
{
    private $markdownParser;
    private $cache;

    /**
     * CacheTransformer constructor.
     * @param MarkdownParserInterface $markdownParser
     * @param Cache $cache
     */
    public function __construct(MarkdownParserInterface $markdownParser, Cache $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    /**
     * @param $str
     * @return mixed|string
     */
    public function parse($str)
    {
        $cache = $this->cache;
        $key = md5($str);
        if ($cache->contains($key)) {
            return $cache->fetch($key);
        }

        sleep(1);
        $str = $this->markdownParser
            ->transformMarkdown($str);
        $cache->save($key, $str);

        return $str;
    }
}
