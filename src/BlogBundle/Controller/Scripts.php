<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 11.11.17
 * Time: 22:11
 */

namespace BlogBundle\Controller;


class Scripts
{
    private $scripts = [
    ];

    /**
     * @return array
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * @param array $scripts
     */
    public function setScripts(array $scripts)
    {
        $this->scripts = array_merge($this->scripts, $scripts);
    }

    /**
     * @param string $scripts
     */
    public function setScript($script)
    {
        $this->scripts[] = $script;
    }

}