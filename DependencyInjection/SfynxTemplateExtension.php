<?php
/**
 * This file is part of the <Template> project.
 *
 * @category   Template
 * @package    DependencyInjection
 * @subpackage Extension
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

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader,
    Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @category   Template
 * @package    DependencyInjection
 * @subpackage Extension
 * @author     Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright  2015 PI-GROUPE
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    2.3
 * @link       http://opensource.org/licenses/gpl-license.php
 * @since      2015-02-16
 */
class SfynxTemplateExtension extends Extension{

    public function load(array $config, ContainerBuilder $container)
    {
        // we load all services
        $loaderYaml = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/service'));
        $loaderYaml->load("services_form_extension.yml");
        // we load config
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $config);
        
        /**
         * Form config parameter
         */
        if (isset($config['form'])) {
            if (isset($config['form'])) {
                foreach ($config['form'] as $key => $value) {
                    if (is_array($value)) {
                        foreach ($config['form'][$key] as $subkey => $subvalue) {
                            $container->setParameter(
                                    'sfynx.template.form.extension.'.$key.'.'.$subkey,
                                    $subvalue
                            );
                        }
                    } else {
                        $container->setParameter(
                            'sfynx.template.form.extension.'.$key,
                            $value
                        );
                    }
                }
            }                
        }

        /**
         * Theme config parameter
         */
        if (isset($config['theme'])){
            if (isset($config['theme']['name'])) {
                $container->setParameter('sfynx.template.theme.name', strtolower($config['theme']['name']));
            }
            if (isset($config['theme']['login'])) {
                $container->setParameter('sfynx.template.theme.login', $config['theme']['login']);  // "SfynxSmoothnessBundle::Login\\"
            }
            if (isset($config['theme']['layout'])) {
                $container->setParameter('sfynx.template.theme.layout', $config['theme']['layout']); // "SfynxSmoothnessBundle::Layout\\"
            }



            if (isset($config['theme']['email']['registration']['from_email']['address'])) {
                $container->setParameter('sfynx.template.theme.email.registration.from_email.address', $config['theme']['email']['registration']['from_email']['address']);
            }
            if (isset($config['theme']['email']['registration']['template'])) {
                $container->setParameter('sfynx.template.theme.email.registration.template', $config['theme']['email']['registration']['template']);
            }
            if (isset($config['theme']['email']['resetting']['from_email']['address'])) {
                $container->setParameter('sfynx.template.theme.email.resetting.from_email.address', $config['theme']['email']['resetting']['from_email']['address']);
            }
            if (isset($config['theme']['email']['resetting']['template'])) {
                $container->setParameter('sfynx.template.theme.email.resetting.template', $config['theme']['email']['resetting']['template']);
            }



            if (isset($config['theme']['global']['layout'])) {
                $container->setParameter('sfynx.template.theme.layout.global', $config['theme']['global']['layout']); // "SfynxSmoothnessBundle::Layout\\layout-global-cmf.html.twig"
            }
            if (isset($config['theme']['global']['css'])) {
                $container->setParameter('sfynx.template.theme.layout.global.css', $config['theme']['global']['css']); // "SfynxSmoothnessBundle::Layout\\layout-global-cmf.html.twig"
            }
            if (isset($config['theme']['ajax']['layout'])) {
                $container->setParameter('sfynx.template.theme.layout.ajax', $config['theme']['ajax']['layout']); // "SfynxSmoothnessBundle::Layout\\layout-ajax.html.twig"
            }
            if (isset($config['theme']['ajax']['css'])) {
                $container->setParameter('sfynx.template.theme.layout.ajax.css', $config['theme']['ajax']['css']); // "SfynxSmoothnessBundle::Layout\\layout-ajax.html.twig"
            }

            $container->setParameter('sfynx.template.theme.layout.error.route_name', $config['theme']['error']['route_name']);  // "error_404"
            $container->setParameter('sfynx.template.theme.layout.error.html', $config['theme']['error']['html']); // "@SfynxSmoothnessBundle/Resources/views/Error/error.html.twig"
            $container->setParameter('sfynx.template.theme.layout.error.uri_for_path', $config['theme']['error']['uri_for_path']); // "http://localhost"

            if (isset($config['theme']['admin']['pc'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.pc', $config['theme']['admin']['pc']); // "SfynxSmoothnessBundle::Layout\\Pc\\"
            }
            if (isset($config['theme']['admin']['mobile'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.mobile', $config['theme']['admin']['mobile']); // "SfynxSmoothnessBundle::Layout\\Mobile\\Admin\\"
            }
            if (isset($config['theme']['admin']['grid']['img'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.img', $config['theme']['admin']['grid']['img']); // "/bundles/sfynxsmoothness/admin/grid/"
            }
            if (isset($config['theme']['admin']['grid']['css'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.css', $config['theme']['admin']['grid']['css']); // "/bundles/sfynxsmoothness/admin/grid/"
            }
            if (isset($config['theme']['admin']['grid']['type'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.type', $config['theme']['admin']['grid']['type']);
            }
            if (isset($config['theme']['admin']['grid']['state_save'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.state.save', $config['theme']['admin']['grid']['state_save']);
            }
            if (isset($config['theme']['admin']['grid']['row_select'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.row.select', $config['theme']['admin']['grid']['row_select']);
            }
            if (isset($config['theme']['admin']['grid']['pagination'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.pagination', $config['theme']['admin']['grid']['pagination']);
            }
            if (isset($config['theme']['admin']['grid']['pagination_type'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.pagination.type', $config['theme']['admin']['grid']['pagination_type']);
            }
            if (isset($config['theme']['admin']['grid']['pagination_top'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.pagination.top', $config['theme']['admin']['grid']['pagination_top']);
            }
            if (isset($config['theme']['admin']['grid']['lengthmenu'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.lengthmenu', $config['theme']['admin']['grid']['lengthmenu']);
            }
            if (isset($config['theme']['admin']['grid']['filters_tfoot_up'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.filters.tfoot.up', $config['theme']['admin']['grid']['filters_tfoot_up']);
            }
            if (isset($config['theme']['admin']['grid']['filters_active'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.grid.filters.active', $config['theme']['admin']['grid']['filters_active']);
            }
            if (isset($config['theme']['admin']['form']['builder'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.form.builder', $config['theme']['admin']['form']['builder']);
            }
            if (isset($config['theme']['admin']['form']['template'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.form.template', $config['theme']['admin']['form']['template']);
            }
            if (isset($config['theme']['admin']['form']['css'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.form.css', $config['theme']['admin']['form']['css']);
            }
            if (isset($config['theme']['admin']['flash'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.flash', $config['theme']['admin']['flash']);
            }
            if (isset($config['theme']['admin']['css'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.css', $config['theme']['admin']['css']); // 'bundles/sfynxsmoothness/admin/screen.css'
            }
            if (isset($config['theme']['admin']['home'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.home', $config['theme']['admin']['home']);  // 'SfynxSmoothnessBundle:Home:admin.html.twig'
            }
            if (isset($config['theme']['admin']['dashboard'])) {
                $container->setParameter('sfynx.template.theme.layout.admin.dashboard', $config['theme']['admin']['dashboard']); // 'dashboard.default.html.twig'
            }
            if (isset($config['theme']['front']['pc'])) {
                $container->setParameter('sfynx.template.theme.layout.front.pc', $config['theme']['front']['pc']); // "SfynxSmoothnessBundle::Layout\\Pc\\"
            }
            if (isset($config['theme']['front']['mobile'])) {
                $container->setParameter('sfynx.template.theme.layout.front.mobile', $config['theme']['front']['mobile']);  // "SfynxSmoothnessBundle::Layout\\Mobile\\"
            }
            if (isset($config['theme']['front']['css'])) {
                $container->setParameter('sfynx.template.theme.layout.front.css', $config['theme']['front']['css']);  // 'bundles/sfynxsmoothness/front/screen.css'
            }
            if (isset($config['theme']['connexion']['login'])) {
                $container->setParameter('sfynx.template.theme.layout.connexion.login', $config['theme']['connexion']['login']);  // "SfynxSmoothnessBundle::Login\\Security\\login-layout.html.twig"
            }
            if (isset($config['theme']['connexion']['dashboard'])) {
                $container->setParameter('sfynx.template.theme.layout.connexion.dashboard', $config['theme']['connexion']['dashboard']);  // "SfynxSmoothnessBundle::Login\\Security\\connexion-dashboard.html.twig"
            }
            if (isset($config['theme']['connexion']['widget'])) {
                $container->setParameter('sfynx.template.theme.layout.connexion.widget', $config['theme']['connexion']['widget']);  // "SfynxSmoothnessBundle::Login\\Security\\connexion-widget.html.twig"
            }
        }
    }
    
    public function getAlias()
    {
    	return 'sfynx_template';
    }
        
}