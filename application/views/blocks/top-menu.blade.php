<nav class="top">
    {{
        Menu::handler('topmenu', array('class' => 'menu'))
            ->add('/', 'Главная')
            ->add('about', 'О нас')
            ->render(array(
                'active_class' => 'active',    
            ))
    }}
</nav>