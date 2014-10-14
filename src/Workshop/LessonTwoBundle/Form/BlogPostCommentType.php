<?php

namespace Workshop\LessonTwoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', null, array('label' => 'Autor'))
            ->add('email', 'email', array('label' => 'E-Mail'))
            ->add('content', 'textarea', array('label' => 'Kommentar'))
            // ->add('createdAt')	all removed, not needed in form
            // ->add('updatedAt')
            // ->add('isOnline')
            // ->add('blogPost')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Workshop\LessonTwoBundle\Entity\BlogPostComment'
        ));
    }

    public function getName()
    {
        return 'workshop_lessontwobundle_blogpostcommenttype';
    }
}
