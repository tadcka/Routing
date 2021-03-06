<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing\Model\Manager;

use Tadcka\Component\Routing\Model\RedirectRouteInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/28/14 2:27 PM
 */
interface RedirectRouteManagerInterface
{
    /**
     * Find redirect route by name.
     *
     * @param string $name
     *
     * @return null|RedirectRouteInterface
     */
    public function findByName($name);

    /**
     * Create new redirect route.
     *
     * @return RedirectRouteInterface
     */
    public function create();

    /**
     * Add redirect route to persistent layer.
     *
     * @param RedirectRouteInterface $redirectRoute
     * @param bool $save
     */
    public function add(RedirectRouteInterface $redirectRoute, $save = false);

    /**
     * Remove redirect route from persistent layer.
     *
     * @param RedirectRouteInterface $redirectRoute
     * @param bool $save
     */
    public function remove(RedirectRouteInterface $redirectRoute, $save = false);

    /**
     * Save persistent layer.
     */
    public function save();

    /**
     * Clear redirect route objects from persistent layer.
     */
    public function clear();

    /**
     * Get redirect route class name.
     *
     * @return string
     */
    public function getClass();
}
