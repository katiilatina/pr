<?php
include_once "database.php"; 
class BaseCalendar
{
  public $article;
  public $type;
  public static $types=
  [
      	1=>"встреча",
        2=>"звонок",
        3=>"совещание",
      	4=>"дело",
  ];
  public $place;
  public $duration;
  public static $duration_array=
  [
        1=>"меньше часа",
        2=>"1-2 часа",
        3=>"2-3 часа",
        4=>"3-4 часа",
        5=>"4-6 часов",
        6=>"6-9 часов",
        7=>"9-12 часов",
        8=>"более 12 часов",
  ];  
  public $comment;
  public $date_task;
  public $dateDB;  
  public $minute;
  public function get_minutes()
  {
  	for($i=0;$i<60;$i++)
    {
			if(strlen($i)===1) 
        $array[$i]='0'.$i;
      else
        $array[$i]=$i;
    }
    return $array;
  }
  public $hour;
    public function get_hours()
  {
  	for($i=0;$i<24;$i++)
    {
			if(strlen($i)===1) 
        $array[$i]='0'.$i;
      else
        $array[$i]=$i;
    }
    return $array;
  }
  public $time_task;  
  public $date1;
  public $date2;  
  public $status;
  public $period;
  public function set_values($method)
  {
        $this->article= isset($method['article']) ? $method['article'] : '';
        $this->type=isset($method['type']) ? $method['type'] : '';
        $this->place=isset($method['place']) ? $method['place'] : '';
        $this->duration=isset($method['duration']) ? $method['duration'] : '';
        $this->comment=isset($method['comment']) ? $method['comment'] : '';
  			$this->date_task=isset($method['date_task']) ? $method['date_task'] : '';
        $this->hour=isset($method['hour']) ? $method['hour'] : '';
  			$this->minute=isset($method['minute']) ? $method['minute'] : '';  
  }

  public function get_status($time)
  {
  	if($this->validate())
    {
    	if($time>=date('Y-m-d'))
      {
        return 'current';
      }
      else
        return 'failed';        
    }
  }
  public $errors=[];
  public function validate()
  {
    $this->set_values($_POST);
    if (empty($this->type))
    {
        $this->errors["type"]=' Укажите тип встречи';
    }
    if (empty($this->article))
    {  
      	$this->article='Название отсутсвует';
    }     
    if (empty($this->date_task))
    {
        $this->errors["date_task"]=' Заполните дату';      
    }
    else if (empty($this->date_task) && (empty($this->hour) or empty($this->minute)))
    {
    	$this->errors["date_task"]=' Отсутсвет дата и время';  
    }
    else if (empty($this->hour) or empty($this->minute))
    {
    	$this->errors["date_task"]=' Вы не указали время :(';     
    }
    else	
    {
      $this->time_task=$this->hour.":".$this->minute;
  
    }
    return empty($this->errors);

      
  }
}