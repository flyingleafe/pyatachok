<nav class="top">
    {{
        Menu::handler('topmenu', array('class' => 'menu'))
            ->add('/', '<ins id="anketa">Моя анкета</ins>')
            ->add('/', '<ins id="feedbacks">Отзывы</ins>')
            ->add('/', '<ins id="contacts">Контакты</ins>')
            ->add('about', '<ins id="about_us">О нас</ins>')
            ->render(array(
                'active_class' => 'active',    
            ))
    }}
</nav>