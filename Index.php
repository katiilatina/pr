<?php
  include_once ("Calendar.php");
  include_once ("basetasks.php"); 
  $calendar= new Calendar;
  if ($_SERVER['REQUEST_METHOD'] === 'GET')
  {
    include ("form.php"); 

  }
  else if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
      if($calendar->savedb())
      {
        include ("header.php"); 
        echo "<form method='GET' action=''><input type='submit' value='Добавить еще задачу'/></form>";
      }    
      else
      {
        include ("form.php");
      }       

  }
