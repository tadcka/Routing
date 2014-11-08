<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing\Model;

use Symfony\Component\Routing\Route as SymfonyRoute;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 7/1/14 10:54 PM
 */
abstract class Route extends SymfonyRoute implements RouteInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $routePattern;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var bool
     */
    protected $recompile = false;

    /**
     * @var bool
     */
    protected $visible = false;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct($this->routePattern);

        $this->setDefaults(array());
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        // TODO: Implement getContent() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteKey()
    {
        return $this->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function addLocale($defaultLocale, array $requirements)
    {
        $this->prefix = '/{_locale}';

        $this->setDefault('_locale', $defaultLocale);
        $this->addRequirements(array('_locale' => implode('|', $requirements)));
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoutePattern($routePattern)
    {
        $this->routePattern = '/' . ltrim(trim($routePattern), '/');
        $this->setPath($this->routePattern);
        $this->recompile = true;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoutePattern()
    {
        return $this->routePattern;
    }

    /**
     * {@inheritDoc}
     */
    public function getPath()
    {
        return $this->prefix . $this->getRoutePattern();
    }

    /**
     * {@inheritdoc}
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * {@inheritdoc}
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * {@inheritDoc}
     */
    public function compile()
    {
        if ($this->recompile) {
            parent::setPath($this->getPath());
        }

        return parent::compile();
    }

    /**
     * @deprecated
     */
    public function getPattern()
    {
        return $this->getPath();
    }
}
