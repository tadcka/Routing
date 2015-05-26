<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing\Generator;

use Ferrandini\Urlizer;
use Tadcka\Component\Routing\Exception\RoutingRuntimeException;
use Tadcka\Component\Routing\Model\Manager\RouteManagerInterface;
use Tadcka\Component\Routing\Model\RouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/1/14 10:57 AM
 */
class RouteGenerator
{
    /**
     * @var RouteManagerInterface
     */
    private $routeManager;

    /**
     * Constructor.
     *
     * @param RouteManagerInterface $routeManager
     */
    public function __construct(RouteManagerInterface $routeManager)
    {
        $this->routeManager = $routeManager;
    }

    /**
     * Generate route from text.
     *
     * @param string $text
     * @param bool $withSlash
     *
     * @return string
     */
    public function generateRouteFromText($text, $withSlash = false)
    {
        if ($withSlash) {
            $result = '';
            foreach (explode('/', $text) as $value) {
                if ('' !== $value = trim($value)) {
                    $result .= '/' . Urlizer::urlize($value);
                }
            }

            return $result ?: '/';
        }

        return $this->normalizeRoute(Urlizer::urlize($text));
    }

    /**
     * Generate unique route.
     *
     * @param RouteInterface $route
     * @param bool $withSlash
     *
     * @return null|RouteInterface
     */
    public function generateUniqueRoute(RouteInterface $route, $withSlash = false)
    {
        $originalRoutePattern = $this->generateRouteFromText($route->getRoutePattern(), $withSlash);

        if ($originalRoutePattern) {
            $key = 0;
            $routePattern = $this->normalizeRoute($originalRoutePattern);

            while ($this->hasRoute($routePattern, $route->getName())) {
                $key++;
                $routePattern = $originalRoutePattern . '-' . $key;
            }

            $route->setRoutePattern($routePattern);

            return $route;
        }

        return null;
    }

    /**
     * Has route.
     *
     * @param string $routePattern
     * @param string $routeName
     *
     * @return bool
     *
     * @throws RoutingRuntimeException
     */
    private function hasRoute($routePattern, $routeName)
    {
        if (!$routeName) {
            throw new RoutingRuntimeException('Route name is empty!');
        }

        $route = $this->routeManager->findByRoutePattern($routePattern);

        return ((null !== $route) && ($routeName !== $route->getName()));
    }

    /**
     * Normalize route.
     *
     * @param string $route
     *
     * @return string
     */
    private function normalizeRoute($route)
    {
        return '/' . ltrim(trim($route), '/');
    }
}
