<?php
/**
 * Created by IntelliJ IDEA.
 * User: Geoffroy
 * Date: 25/01/18
 * Time: 11:51
 * Version 0.1
 *
 * welcome_page contient la variable $welcome_page utilisée par index.php pour afficher
 * la page d'accueil Cette variable contient un str.
 */

$welcome_page = '<html>
  <head>
    <meta=charset="utf8"/>
   <title></title>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js" type="text/javascript"></script>
    <style type="text/css">
    <!--
      .ui-event .ui-state-default{
    color: green;
}
    //-->
    </style>
  </head>
  <body id="demos">
   <script type="text/javascript">
    $(function() {
        $("#datepicker" ).datepicker({
        beforeShowDay: function(date){
            var b = (date.getDay() < 5);
            var c = "";
            if (!b) {
                c = "ui-state-disabled";
            }

            d = new Date(2010, 1, 22)
          if ((date >= d) && (date <= d)) {
              c = "ui-event";
          }



          return [b, c];
        }
      });
   });
   </script>
    <input type="button" id="datepicker" value="Calendrier"></p>
  </body>
</html>
';