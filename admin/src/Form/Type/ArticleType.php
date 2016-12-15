<?php

namespace Admin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'label' => 'Titre'
        ));
        $builder->add('description', 'textarea', array(
            'label' => 'Description'
        ));
        $builder->add('image_url', 'text', array(
            'label' => 'Image'
        ));
        $builder->add('url', 'text', array(
            'label' => 'Lien'
        ));
    }

    public function getName()
    {
        return 'article';
    }
}
