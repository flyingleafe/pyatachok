<nav class="top">

    <?php

      $menu =  Menu::handler('topmenu', array('class' => 'menu'));

        if(Auth::check())  {
            $url ='/workers/profile/'. Auth::user()->id;
            $menu->add( "$url", '<ins id="anketa">Моя анкета</ins>');
        }

        $menu
            ->add('/feedback', '<ins id="feedbacks">Отзывы</ins>')
            ->add('/contacts', '<ins id="contacts">Контакты</ins>')
            ->add('about', '<ins id="about_us">О нас</ins>');


    ?>

    <?php echo $menu->render(array('active_class' => 'active'))?>
</nav>