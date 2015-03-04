<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing\Helper;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 9/1/14 8:30 PM
 */
class LocaleHelper
{
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var array
     */
    private $locales;

    /**
     * Constructor.
     *
     * @param string $defaultLocale
     * @param array $locales
     */
    public function __construct($defaultLocale, array $locales)
    {
        $this->defaultLocale = $defaultLocale;
        $this->locales = $locales;
    }

    /**
     * Get default locale.
     *
     * @return string
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * Get locales.
     *
     * @return array
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * Get locale prefix.
     *
     * @return string
     */
    public function getLocalePrefix()
    {
        return '/{_locale}';
    }
}
