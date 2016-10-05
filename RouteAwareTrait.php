<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing;

use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Component\HttpFoundation\Request;
use Tadcka\Component\Routing\Model\RouteInterface;

/**
 * Class RouteAwareTrait.
 *
 * @package Tadcka\Component\Routing
 */
trait RouteAwareTrait
{
    /**
     * Get route from request.
     *
     * @param Request $request
     *
     * @return null|RouteInterface
     */
    protected function getRouteFromRequest(Request $request)
    {
        $attributes = $request->attributes->get('_route_params');

        if (isset($attributes[RouteObjectInterface::ROUTE_OBJECT])
            && ($attributes[RouteObjectInterface::ROUTE_OBJECT] instanceof RouteInterface)
        ) {
            return $attributes[RouteObjectInterface::ROUTE_OBJECT];
        }

        return null;
    }
}
