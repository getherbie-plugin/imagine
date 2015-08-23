<?php

use Herbie\DI;
use Herbie\Hook;
use herbie\plugin\imagine\classes\ImagineExtension;

class ImaginePlugin
{

    public static function install()
    {
        $config = DI::get('Config');

        if ((bool)$config->get('plugins.config.imagine.twig', false)) {
            Hook::attach('twigInitialized', ['ImaginePlugin', 'addTwigExtension']);
        }
        if ((bool)$config->get('plugins.config.imagine.shortcode', true)) {
            Hook::attach('shortcodeInitialized', ['ImaginePlugin', 'addShortcode']);
        }

        // Add custom namespace path to Imagine lib
        $vendorDir = $config->get('site.path') . '/../vendor';
        $autoload = require($vendorDir . '/autoload.php');
        $autoload->add('Imagine', __DIR__ . '/vendor/lib');
    }

    public static function addTwigExtension($twig)
    {
        $config = DI::get('Config');
        $basePath = DI::get('Request')->getBasePath();
        $twig->addExtension(new ImagineExtension($config, $basePath));
    }

    public static function addShortcode($shortcode)
    {
        $shortcode->add('imagine', ['ImaginePlugin', 'imagineShortcode']);
    }

    public static function imagineShortcode($options)
    {
        try {

            $options = array_merge([
                'path' => empty($options[0]) ? '' : $options[0],
                'filter' => '',
                'attributes' => [],
                'alt' => '',
                'class' => '',
                'id' => '',
                'style' => '',
                'title' => '',
                'width' => 0,
                'height' => 0,
                'media' => 1
            ], $options);

            $config = DI::get('Config');
            $basePath = DI::get('Request')->getBasePath();
            $extension = new ImagineExtension($config, $basePath);

            return call_user_func_array([$extension, 'imagineFunction'], $options);

        } catch (\Exception $e) {
            // @todo return a default (fallback) image
            return '';
        }
    }

}

ImaginePlugin::install();
