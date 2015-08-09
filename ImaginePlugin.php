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

class ImaginePlugin extends Herbie\Plugin
{

    public function onTwigInitialized(Herbie\Event $event)
    {
        // Add custom namespace path to Imagine lib
        $vendorDir = $this->getService('Config')->get('site.path') . '/../vendor';
        $autoload = require($vendorDir . '/autoload.php');
        $autoload->add('Imagine', __DIR__ . '/vendor/lib');

        $config = $this->getService('Config');
        $basePath = $this->getService('Request')->getBasePath();
        $event['twig']->addExtension(new ImagineExtension($config, $basePath));
    }
}
