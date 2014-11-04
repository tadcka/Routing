<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Routing\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tadcka\Component\Routing\Form\DataTransformer\RouteChoiceTransformer;
use Tadcka\Component\Routing\Model\Manager\RouteManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 11/4/14 10:51 PM
 */
class RouteChoiceType extends AbstractType
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
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new RouteChoiceTransformer($this->routeManager));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'choices' => $this->getRoutes(),
                'empty_value' => 'form.route_choice.empty_value',
                'label' => 'form.route_choice.route_target',
                'translation_domain' => 'TadckaRouting',
            )
        );
    }

    /**
     * @return array
     */
    private function getRoutes()
    {
        $data = array();

        foreach ($this->routeManager->findAllNameAndPattern() as $row) {
            $data[$row['name']] = $row['route_pattern'];
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tadcka_route_choice';
    }
}
