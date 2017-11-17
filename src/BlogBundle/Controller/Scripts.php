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
        "/assets/js/jquery.min.js",
        "/assets/js/bootstrap.min.js",
        "/assets/js/scripts.js",
        "/assets/js/jquery.isotope.js",
        "/assets/js/jquery.slicknav.js",
        "/assets/js/jquery.visible.js",
        "/assets/js/jquery.sticky.js",
        "/assets/js/slimbox2.js",
        "/assets/js/modernizr.custom.js",
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