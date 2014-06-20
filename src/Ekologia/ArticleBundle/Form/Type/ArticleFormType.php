<?php

namespace Ekologia\ArticleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Defines the base form for a Article type
 */
class ArticleFormType extends AbstractType {
    /**
     * @Override
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('visibility', 'collection', array(
                    'true' => false,
                    'label' => 'ekologia.article.form.article.visibility.label',
                    'choices' => array(
                        'private' => 'ekologia.article.form.article.visibility.private',
                        'protected' => 'ekologia.article.form.article.visibility.protected',
                        'public' => 'ekologia.article.form.article.visibility.public'
                    )))
                ->add('version', $this->newVersionFormType($options), array('required' => false, 'label' => 'ekologia.article.form.article.version.label'))
                ->add('tags', 'collection', array(
                    'label'        => 'ekologia.article.form.article.tags.label',
                    'type'         => 'text',
                    'options'      => array('required' => false),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ))
                ->add('save', 'submit', array('required' => false, 'label' => 'ekologia.article.form.article.submit.label'));
        
        if ($options['creation']) {
            $builder->add('deletable', 'checkbox', array('required' => false, 'label' => 'ekologia.article.form.article.deletable.label'));
        }
        if (isset($options['parentList'])) {
            $builder->add('parent', 'collection', array(
                'choices' => $options['parentList'],
                'required' => false,
                'label' => 'ekologia.article.form.article.parent.label'
            ));
        }
    }

    /**
     * @Override
     */
    public function getName()
    {
        return 'ekologia_article_article';
    }
    
    /**
     * @Override
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'creation' => false,
            'parentList' => null
        ));
    }
    
    /**
     * Return a new version form type corresponding of the version for current module.
     * This method should be overrided
     * 
     * @return \Ekologia\ArticleBundle\Form\Type\VersionFormType The version form type
     */
    protected function newVersionFormType() {
        return new VersionFormType();
    }
}