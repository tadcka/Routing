<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing\Tests\Generator;

use Tadcka\Component\Routing\Generator\RouteGenerator;
use Tadcka\Component\Routing\Tests\Mock\Model\Manager\MockRouteManager;
use Tadcka\Component\Routing\Tests\Mock\Model\MockRoute;

class RouteGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateRouteFromText()
    {
        $generator = new RouteGenerator(new MockRouteManager());

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska',
            $generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką')
        );

        $this->assertEquals(
            '/aceeisuuz',
            $generator->generateRouteFromText('  ĄčĘėĮšŲūŽ  ')
        );

        $this->assertEquals(
            '/aceei-suuz',
            $generator->generateRouteFromText('  ĄčĘėĮ                                               šŲūŽ  ')
        );

        $this->assertEquals(
            '/a-ceei-su-uz',
            $generator->generateRouteFromText('  Ą..čĘėĮ/šŲ..ūŽ/  ')
        );

        $this->assertEquals(
            '/',
            $generator->generateRouteFromText('')
        );
    }

    public function testGenerateRouteFromTextWithSlash()
    {
        $generator = new RouteGenerator(new MockRouteManager());

        $this->assertEquals(
            '/tadcka/route',
            $generator->generateRouteFromText('/ tadcka / route', true)
        );

        $this->assertEquals(
            '/0',
            $generator->generateRouteFromText('0', true)
        );

        $this->assertEquals(
            '/',
            $generator->generateRouteFromText('', true)
        );

        $this->assertEquals(
            '/tadcka-route',
            $generator->generateRouteFromText('\tadcka\route', true)
        );
    }

    /**
     * @expectedException \Tadcka\Component\Routing\Exception\RoutingRuntimeException
     */
    public function testGenerateUniqueRouteException()
    {
        $routeManager = new MockRouteManager();
        $generator = new RouteGenerator($routeManager);

        $mockRoute = new MockRoute();
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką'));
        $generator->generateUniqueRoute($mockRoute);
    }

    public function testGenerateUniqueRoute()
    {
        $routeManager = new MockRouteManager();
        $generator = new RouteGenerator($routeManager);

        $mockRoute = new MockRoute();
        $mockRoute->setName('test');
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką'));
        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska',
            $generator->generateUniqueRoute($mockRoute)->getRoutePattern()
        );

        $route = $routeManager->create();
        $route->setRoutePattern('kiskis-ejo-takeliu-ir-sutiko-meska');
        $routeManager->add($route);
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką/.'));

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska-1',
            $generator->generateUniqueRoute($mockRoute)->getRoutePattern()
        );

        $route = $routeManager->create();
        $route->setRoutePattern('kiskis-ejo-takeliu-ir-sutiko-meska-1');
        $routeManager->add($route);
        $mockRoute->setRoutePattern($generator->generateRouteFromText('Kiškis ėjo takeliu ir sutiko mešką/.'));

        $this->assertEquals(
            '/kiskis-ejo-takeliu-ir-sutiko-meska-2',
            $generator->generateUniqueRoute($mockRoute)->getRoutePattern()
        );
    }
}
