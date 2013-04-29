<?php

class Helpers {

    public static function isMainPage(  ) {

       if(URL::current() == URL::base().'/'){
          return true;
       }

       else return false;
    }
}
