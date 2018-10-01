<?php

namespace AppBundle\Form;

use AppBundle\Manager\Teams;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Class LeagueSearchType
 * @package AppBundle\Form
 */
class LeagueSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
           $league = $event->getData();
           $form = $event->getForm();
           if ($league === null) {
               $form->add('league', SearchType::class,
                   array(
                       'attr' => array('placeholder' => 'Search by league'),
                       'required' => true,
                   ));
           }
       });
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundle_home_type';
    }

    /**
     * @return string
     */
    public function checkLeagues(){
        
        return Teams::postShowLeagues();
    }
}
