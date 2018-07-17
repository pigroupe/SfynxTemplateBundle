<?php
/**
 * This file is part of the <Template> project.
 *
 * @category   Template
 * @package    DependencyInjection
 * @subpackage Configuration
 * @author     Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright  2015 PI-GROUPE
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    2.3
 * @link       http://opensource.org/licenses/gpl-license.php
 * @since      2015-02-16
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sfynx\TemplateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 * 
 * @category   Template
 * @package    DependencyInjection
 * @subpackage Configuration
 * @author     Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright  2015 PI-GROUPE
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    2.3
 * @link       http://opensource.org/licenses/gpl-license.php
 * @since      2015-02-16
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sfynx_template');
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $this->addFormConfig($rootNode);
        $this->addThemeConfig($rootNode);

        return $treeBuilder;
    }

    /**
     * Form config
     *
     * @param $rootNode \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function addFormConfig(ArrayNodeDefinition $rootNode)
    {
    	$rootNode
        ->children()
            ->arrayNode('form')
                ->addDefaultsIfNotSet()                    
                ->children()
                
                    ->booleanNode('show_legend')->defaultValue(true)->end()
                    ->booleanNode('show_child_legend')->defaultValue(false)->end()
                    ->scalarNode('error_type')->defaultValue('inline')->cannotBeEmpty()->end()
                    ->booleanNode('render_fieldset')->defaultValue(true)->end()     
                    ->booleanNode('render_required_asterisk')->defaultValue(false)->end()
                    ->booleanNode('render_optional_text')->defaultValue(true)->end()
                    ->booleanNode('errors_on_forms')->defaultValue(false)->end()
                    ->scalarNode('checkbox_label')->defaultValue('both')->end()
                    ->arrayNode('tooltip')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('icon')
                                ->defaultValue('icon-info-sign')
                            ->end()
                            ->scalarNode('placement')
                                ->defaultValue('top')
                            ->end()
                        ->end()
                    ->end()                
                
                ->end()
            ->end()
    	->end();
    }

    /**
     * Browser config
     *
     * @param $rootNode \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function addThemeConfig(ArrayNodeDefinition $rootNode)
    {
        $rootNode
        ->children()
            ->arrayNode('theme')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('name')->isRequired()->defaultValue("smoothness")->cannotBeEmpty()->end()
                    ->scalarNode('login')->isRequired()->defaultValue('@SfynxTheme/Login/')->cannotBeEmpty()->end()
                    ->scalarNode('layout')->isRequired()->defaultValue('@SfynxTheme/Layout/')->cannotBeEmpty()->end()

                    ->arrayNode('email')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode('registration')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->arrayNode('from_email')
                                        ->canBeUnset()
                                        ->children()
                                            ->scalarNode('address')->isRequired()->cannotBeEmpty()->end()
                                        ->end()
                                    ->end()
                                    ->scalarNode('template')->defaultValue('@SfynxTheme/Login/Registration:email.txt.twig')->end()
                                ->end()
                            ->end()
                            ->arrayNode('resetting')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->arrayNode('from_email')
                                        ->canBeUnset()
                                        ->children()
                                            ->scalarNode('address')->isRequired()->cannotBeEmpty()->end()
                                        ->end()
                                    ->end()
                                    ->scalarNode('template')->defaultValue('@SfynxTheme/Login/Resetting:email.txt.twig')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()

                    ->arrayNode('global')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('layout')->isRequired()->defaultValue('@SfynxTheme/Layout/layout-global-cmf.html.twig')->cannotBeEmpty()->end()
                            ->scalarNode('css')->isRequired()->defaultValue('bundles/sfynxsmoothness/layout/screen-layout-global.css')->cannotBeEmpty()->end()
                        ->end()
                    ->end()

                    ->arrayNode('ajax')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('layout')->isRequired()->defaultValue('@SfynxTheme/Layout/layout-ajax.html.twig')->cannotBeEmpty()->end()
                            ->scalarNode('css')->isRequired()->defaultValue('bundles/sfynxsmoothness/layout/screen-layout-ajax.css')->cannotBeEmpty()->end()
                        ->end()
                    ->end()

                    ->arrayNode('error')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('route_name')->defaultValue('error_404')->end()
                            ->scalarNode('html')->defaultValue('@SfynxTheme/Error/error.html.twig')->end()
                            ->scalarNode('uri_for_path')->defaultValue('')->end()
                        ->end()
                    ->end()

                    ->arrayNode('admin')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('pc')->isRequired()->defaultValue('@SfynxTheme/Layout/Pc/')->cannotBeEmpty()->end()
                            ->scalarNode('mobile')->isRequired()->defaultValue('@SfynxTheme/Layout/Mobile/Admin/')->cannotBeEmpty()->end()
                            ->scalarNode('css')->defaultValue('bundles/sfynxsmoothness/admin/screen.css')->end()
                            ->scalarNode('home')->isRequired()->defaultValue('@SfynxTheme/Home/admin.html.twig')->cannotBeEmpty()->end()
                            ->scalarNode('dashboard')->isRequired()->defaultValue('@SfynxTemplate/Template/Widgetimport/dashboard.default.html.twig')->cannotBeEmpty()->end()

                            ->arrayNode('grid')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('img')->isRequired()->defaultValue('/bundles/sfynxsmoothness/admin/grid/')->cannotBeEmpty()->end()
                                    ->scalarNode('css')->defaultValue('')->end()
                                    ->scalarNode('type')->isRequired()->defaultValue('simple')->end()
                                    ->booleanNode('state_save')->isRequired()->defaultValue(false)->end()
                                    ->scalarNode('row_select')->isRequired()->defaultValue('multi')->end()
                                    ->booleanNode('pagination')->isRequired()->defaultValue(true)->end()
                                    ->scalarNode('pagination_type')->isRequired()->defaultValue("full_numbers")->end()
                                    ->booleanNode('pagination_top')->isRequired()->defaultValue(false)->end()
                                    ->scalarNode('lengthmenu')->isRequired()->defaultValue(20)->end()
                                    ->booleanNode('filters_tfoot_up')->isRequired()->defaultValue(true)->end()
                                    ->booleanNode('filters_active')->isRequired()->defaultValue(false)->end()
                                ->end()
                            ->end()

                            ->arrayNode('form')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('builder')->isRequired()->defaultValue('SfynxSmoothnessBundle:Form')->cannotBeEmpty()->end()
                                    ->scalarNode('template')->isRequired()->defaultValue('SfynxSmoothnessBundle:Form:fields.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('css')->defaultValue('')->end()
                                ->end()
                            ->end()

                            ->scalarNode('flash')->isRequired()->defaultValue("@SfynxTheme/Flash/flash.html.twig")->cannotBeEmpty()->end()
                        ->end()
                    ->end()

                    ->arrayNode('front')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('pc')->isRequired()->defaultValue('@SfynxTheme/Layout/Pc/')->cannotBeEmpty()->end()
                            ->scalarNode('mobile')->isRequired()->defaultValue('@SfynxTheme/Layout/Mobile/')->cannotBeEmpty()->end()
                            ->scalarNode('css')->defaultValue('bundles/sfynxsmoothness/front/screen.css')->end()
                        ->end()
                    ->end()

                    ->arrayNode('connexion')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('login')->isRequired()->defaultValue('@SfynxTheme/Login/Security/login-layout.html.twig')->cannotBeEmpty()->end()
                            ->scalarNode('dashboard')->isRequired()->defaultValue('@SfynxTheme/Login/Security/connexion-dashboard.html.twig')->cannotBeEmpty()->end()
                            ->scalarNode('widget')->isRequired()->defaultValue('@SfynxTheme/Login/Security/connexion-widget.html.twig')->cannotBeEmpty()->end()
                        ->end()
                    ->end()

                ->end()
            ->end()
        ->end();
    }

}