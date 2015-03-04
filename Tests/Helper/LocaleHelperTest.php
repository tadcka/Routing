<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing\Tests\Helper;

use Tadcka\Component\Routing\Helper\LocaleHelper;

class LocaleHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LocaleHelper
     */
    private $localeHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->localeHelper = new LocaleHelper('en', array('en', 'lt'));
    }

    public function testGetDefaultLocale()
    {
        $this->assertEquals('en', $this->localeHelper->getDefaultLocale());
    }

    public function testGetLocales()
    {
        $this->assertEquals(array('en', 'lt'), $this->localeHelper->getLocales());
    }

    public function testGetLocalePrefix()
    {
        $this->assertEquals('/{_locale}', $this->localeHelper->getLocalePrefix());
    }
}
