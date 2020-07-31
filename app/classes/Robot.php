<?php

namespace App\classes;

class Robot {
    protected $position_x;
    protected $position_y;
    private $directions = ['north', 'west', 'south','east'];
    protected $direction;

    const DEFAULT_DIR = 'north';
    const MAX_STEP_X = 4;
    const MAX_STEP_Y = 4;
    const MIN_STEP_X = 0;
    const MIN_STEP_Y = 0;
    
    public function __construct()
    {
        $this->position_y = null;
        $this->position_x = null;
        $this->direction = null;
    }

    public function is_robot_placed()
    {
        return $this->validate_position($this->position_x, $this->position_y, $this->direction);
    }

    public function validate_position($pos_x, $pos_y, $dir)
    {
        if(!is_null($pos_y) && !is_null($pos_x) && !is_null($dir)){
           $pos_x = (int)$pos_x; 
           $pos_y = (int)$pos_y; 

           if( $this->validate_pos_x($pos_x) && 
               $this->validate_pos_y($pos_y) &&
               $this->validate_dir($dir)
           ){
               return true;
           } else {
               return false;
           }

           return false;
        }   

        return false;
    }

    protected function validate_pos_x($pos_x)
    {
        return $pos_x <= self::MAX_STEP_X && $pos_x >= self::MIN_STEP_X;
    }
    protected function validate_pos_y($pos_y)
    {
        return $pos_y <= self::MAX_STEP_Y && $pos_y >= self::MIN_STEP_Y;
    }
    protected function validate_dir($dir)
    {
        return in_array($dir, $this->directions);
    }

    public function get_position_x()
    {
        return $this->position_x;
    }

    public function get_position_y()
    {
        return $this->position_y;
    }

    public function get_direction()
    {
        return strtoupper($this->direction);
    }

    public function get_current_position()
    {
        return sprintf("Toy robot is at %d, %d, %s", $this->position_x, $this->position_y, strtoupper($this->direction)); 
    }

    public function set_position_x($position_x)
    {
        $this->position_x = $position_x;
    }

    public function set_position_y($position_y)
    {
        $this->position_y = $position_y;
    }

    public function set_direction($direction)
    {
        $this->direction = strtolower($direction);
    }

    public function set_position_direction($pos_x, $pos_y, $dir)
    {
        $this->set_position_x($pos_x);
        $this->set_position_y($pos_y);
        $this->set_direction($dir);
    }

    public function rotate_left()
    {
        switch($this->direction){
            case 'north':
                $this->direction = 'west';
            break;
            case 'west':
                $this->direction = 'south';
            break;
            case 'south':
                $this->direction = 'east';
            break;
            case 'east':
                $this->direction = 'north';
            break;
        }
    }

    public function rotate_right()
    {
        switch($this->direction){
            case 'north':
                $this->direction = 'east';
            break;
            case 'west':
                $this->direction = 'north';
            break;
            case 'south':
                $this->direction = 'west';
            break;
            case 'east':
                $this->direction = 'south';
            break;
        }
    }

    public function move()
    {
        switch($this->direction){
            case 'north':
                if($this->can_move_y('north')){
                    $this->position_y += 1;
                }
            break;
            case 'west':
                if($this->can_move_x('west')){
                    $this->position_x -= 1;
                }
            break;
            case 'south':
                if($this->can_move_y('south')){
                    $this->position_y -= 1;
                }
            break;
            case 'east':
                if($this->can_move_x('east')){
                    $this->position_x += 1;
                }
            break;
        }
    }

    public function can_move_y($direction)
    {
        switch($direction){
            case 'north':
                return $this->position_y < self::MAX_STEP_Y;
            break;
            case 'south':
                return $this->position_y > self::MIN_STEP_Y;
            break;
        }
    }

    public function can_move_x($direction)
    {
        switch($direction){
            case 'east':
                return $this->position_x < self::MAX_STEP_X;
            break;
            case 'west':
                return $this->position_x > self::MIN_STEP_X;
            break;
        }
    }
}