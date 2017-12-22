<?php
/**
 * This file is part of the <Template> project.
 *
 * @subpackage   Extension
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-09
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sfynx\TemplateBundle\Form\Extension;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\FormType;

/**
 *  HelpFieldType Extension
 *
 * @subpackage Extension
 * @package    Form
 * @author     Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class HelpFormTypeExtension extends AbstractTypeExtension
{
    /**
     * @var array
     */
    protected $options = array();

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['help_inline'] = $options['help_inline'];
        $view->vars['help_block'] = $options['help_block'];
        $view->vars['help_label'] = $options['help_label'];

        if (!isset($options['help_label_tooltip']['icon']) && !(null === $this->options['tooltip_icon'])) {
            $options['help_label_tooltip']['icon'] = $this->options['tooltip_icon'];
        }
        if (!isset($options['help_label_tooltip']['placement']) && !(null === $this->options['tooltip_placement'])) {
            $options['help_label_tooltip']['placement'] = $this->options['tooltip_placement'];
        }
        if (!isset($view->vars['help_label_tooltip_title'])) {
            $view->vars['help_label_tooltip_title'] = $options['help_label_tooltip']['title'];
        }
        $view->vars['help_label_tooltip_icon'] = $options['help_label_tooltip']['icon'];
        $view->vars['help_label_tooltip_placement'] = $options['help_label_tooltip']['placement'];
        if (!isset($options['help_label_popover']['icon']) && array_key_exists('popover_icon', $this->options) && !(null === $this->options['popover_icon'])) {
            $options['help_label_popover']['icon'] = $this->options['popover_icon'];
        }
        if (!isset($options['help_label_popover']['placement']) && array_key_exists('popover_placement', $this->options) && !(null === $this->options['popover_placement'])) {
            $options['help_label_popover']['placement'] = $this->options['popover_placement'];
        }
        if (!isset($view->vars['help_label_popover_title'])) {
            $view->vars['help_label_popover_title'] = $options['help_label_popover']['title'];
        }
        if (!isset($view->vars['help_label_popover_content'])) {
            $view->vars['help_label_popover_content'] = $options['help_label_popover']['content'];
        }
        if (!isset($view->vars['help_label_popover_placement'])) {
            $view->vars['help_label_popover_placement'] = $options['help_label_popover']['placement'];
        }
        if (!isset($view->vars['help_label_popover_icon'])) {
            $view->vars['help_label_popover_icon'] = $options['help_label_popover']['icon'];
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'help_inline' => null,
            'help_block' => null,
            'help_label' => null,
            'help_label_tooltip' => array(
                'title' => null,
                'icon' => 'icon-info-sign',
                'placement' => 'top'
            ),
            'help_label_popover' => array(
                'title' => null,
                'content' => null,
                'icon' => 'icon-info-sign',
                'placement' => 'top'
            )
        ));
    }

    public function getExtendedType()
    {
        return FormType::class;
    }
}
