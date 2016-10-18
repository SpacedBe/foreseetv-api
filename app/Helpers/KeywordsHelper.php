<?php

if (!function_exists('keywords')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function keywords($keywords)
    {
        $keywords = array_map(function ($object) {
            return $object['word'];
        }, $keywords->toArray());

        return implode(',', $keywords);
    }
}
