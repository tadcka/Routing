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

use Symfony\Cmf\Component\Routing\RedirectRouteInterface as BaseRedirectRouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/28/14 2:17 PM
 */
interface RedirectRouteInterface extends BaseRedirectRouteInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Get name.
     *
     * @param string $name
     *
     * @return RouteInterface
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set absolute uri to redirect to.
     *
     * @param string $uri
     *
     * @return RedirectRouteInterface
     */
    public function setUri($uri);

    /**
     * Set target route.
     *
     * @param null|RouteInterface $routeTarget
     *
     * @return RedirectRouteInterface
     */
    public function setRouteTarget(RouteInterface $routeTarget = null);

    /**
     * Get target route.
     *
     * @return RouteInterface
     */
    public function getRouteTarget();

    /**
     * Set route name.
     *
     * @param string $routeName
     *
     * @return RedirectRouteInterface
     */
    public function setRouteName($routeName);

    /**
     * Set route parameters.
     *
     * @param array $parameters
     *
     * @return RedirectRouteInterface
     */
    public function setParameters(array $parameters);

    /**
     * Set permanent.
     *
     * @param bool $permanent
     *
     * @return RedirectRouteInterface
     */
    public function setPermanent($permanent);
}
