<?php
/**
 * Created by PhpStorm.
 * User: adri
 * Date: 25/10/17
 * Time: 15:23
 */


namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\Translator;

class ProductType extends AbstractType
{
    private  $translator;

    public function __construct(Translator $translator){
        $this->translator = $translator;
    }

    public function BuildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title', TextType::class,['label'=>$this->translator->trans('product.title')])
            ->add('Description', TextareaType::class,['label'=>$this->translator->trans('product.description')])
            ->add('Price', MoneyType::class, ['label'=>$this->translator->trans('product.price')])
            ->add('submit', SubmitType::class, ['label'=>$this->translator->trans('product.submit')]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Post'
        ]);


    }
}