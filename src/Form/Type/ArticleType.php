<?php

namespace EmineHakan\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'label' => 'Titre',
            'constraints' => array(
                new Assert\NotBlank(array(
                    'message' => 'Ce champ est obligatoire.'
                ))
            )
        ));
        $builder->add('description', 'textarea', array(
            'label' => 'Description',
            'required' => false
        ));
        $builder->add('image_url', 'text', array(
            'label' => 'Image',
            'required' => false,
            'constraints' => array(
                new Assert\Url(array(
                    'message' => 'L\'url n\'est pas valide.')
                )
            )
        ));
        $builder->add('url', 'text', array(
            'label' => 'Lien',
            'constraints' => array(
                new Assert\NotBlank(array(
                    'message' => 'Ce champ est obligatoire.'
                )),
                new Assert\Url(array(
                    'message' => 'L\'url n\'est pas valide.'
                ))
            )
        ));
    }

    public function getName()
    {
        return 'article';
    }
}
