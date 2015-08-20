<?php

/**
 * This file is part of Herbie.
 *
 * (c) Thomas Breuss <www.tebe.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace herbie\plugin\imagine;

use Herbie;
use herbie\plugin\imagine\classes\ImagineExtension;
use Imagine\Gmagick\Image;

class ImaginePlugin extends Herbie\Plugin
{
    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        $events = [];
        if ((bool)$this->config('plugins.config.imagine.twig', false)) {
            $events[] = 'onTwigInitialized';
        }
        if ((bool)$this->config('plugins.config.imagine.shortcode', true)) {
            $events[] = 'onShortcodeInitialized';
        }
        return $events;
    }

    public function onTwigInitialized($twig)
    {
        // Add custom namespace path to Imagine lib
        $vendorDir = $this->getService('Config')->get('site.path') . '/../vendor';
        $autoload = require($vendorDir . '/autoload.php');
        $autoload->add('Imagine', __DIR__ . '/vendor/lib');

        $config = $this->getService('Config');
        $basePath = $this->getService('Request')->getBasePath();
        $twig->addExtension(new ImagineExtension($config, $basePath));
    }

    public function onShortcodeInitialized($shortcode)
    {
        $shortcode->add('imagine', [$this, 'imagineShortcode']);
    }

    public function imagineShortcode($options)
    {
        try {

            $options = $this->initOptions([
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

            $config = $this->getService('Config');
            $basePath = $this->getService('Request')->getBasePath();
            $extension = new ImagineExtension($config, $basePath);

            return call_user_func_array([$extension, 'imagineFunction'], $options);

        } catch (\Exception $e) {
            // @todo return a default (fallback) image
            return '';
        }
    }

}
