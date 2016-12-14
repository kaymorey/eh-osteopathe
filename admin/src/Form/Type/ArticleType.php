<?php

namespace Admin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('image_url');
        $builder->add('description', 'textarea');
        $builder->add('url');
    }

    public function getName()
    {
        return 'article';
    }
}
