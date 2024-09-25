<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LivroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class,
                ['label' => 'Título: '])
            ->add('Autor',TextType::class,
                ['label' => 'Autor: '])
            ->add('edicao', TextType::class,
                ['label' => 'Edição: '])
            ->add('editora', TextType::class,
                ['label' => 'Editora: '])
            ->add('ano_publicacao', IntegerType::class,
                ['label' => 'Ano: '])
            ->add('cod_isbn', IntegerType::class,
                ['label' => 'ISBN: '])
            ->add('quantidade', TextType::class,
                ['label' => 'Quantidade: '])
            ->add('setor', TextType::class,
                ['label' => 'Setor: '])
            ->add('Salvar', SubmitType::class);
    }
}