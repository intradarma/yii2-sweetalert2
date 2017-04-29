<?php

namespace intradarma\sweetalert2;

use yii\web\AssetBundle;

/**
 * Class SweetAlert2Asset
 * @package intradarma\sweetalert2
 */
class SweetAlert2Asset extends AssetBundle
{
    /**
     * @var string the directory that contains the source asset files for this asset bundle.
     */
    public $sourcePath = '@bower/sweetalert2';

    /**
     * @var array list of JavaScript files that this bundle contains.
     */
    public $js = [
        YII_DEBUG ? 'dist/sweetalert2.js' : 'dist/sweetalert2.min.js',
    ];

    /**
     * @var array list of CSS files that this bundle contains.
     */
    public $css = [
        YII_DEBUG ? 'dist/sweetalert2.css' : 'dist/sweetalert2.min.css',
    ];
}