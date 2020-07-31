<?php

namespace App\classes;

/**
* Definition of Robot class
*/

class Robot {

    /**
    * @param x position of the robot
    */
    protected $position_x;
    
    /**
    * @param y position of the robot
    */
    protected $position_y;
    
    /**
    * @param direction of the robot
    */
    protected $direction;

    /**
    * set of available directions
    */
    private $directions = ['north', 'west', 'south','east'];

    /**
    * constants
    */
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

    /**
    * Check if robot has valid position
    */
    public function is_robot_placed()
    {
        return $this->validate_position($this->position_x, $this->position_y, $this->direction);
    }

    /**
    * Validate the position
    */
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

    /**
    * Function to validate the position x
    * @param int x position
    * @return boolean true or false  
    */
    protected function validate_pos_x($pos_x)
    {
        return $pos_x <= self::MAX_STEP_X && $pos_x >= self::MIN_STEP_X;
    }

    /**
    * Function to validate the position y
    * @param int y position
    * @return boolean true or false 
    */
    protected function validate_pos_y($pos_y)
    {
        return $pos_y <= self::MAX_STEP_Y && $pos_y >= self::MIN_STEP_Y;
    }

    /**
    * Function to validate the direction
    * @param string direction
    * @return boolean true or false, direction is valid 
    */
    protected function validate_dir($dir)
    {
        return in_array($dir, $this->directions);
    }

    /**
    * Function to get the x position
    */
    public function get_position_x()
    {
        return $this->position_x;
    }

    /**
    * Function to get the y position
    */
    public function get_position_y()
    {
        return $this->position_y;
    }

    /**
    * Function to get the direction
    */
    public function get_direction()
    {
        return strtoupper($this->direction);
    }

    /**
    * Function to get robot current position in form of string
    */
    public function get_current_position()
    {
        return sprintf("Toy robot is at %d, %d, %s", $this->position_x, $this->position_y, strtoupper($this->direction)); 
    }

    /**
    * Function to set the x position
    * @param int position_x
    */
    protected function set_position_x($position_x)
    {
        $this->position_x = $position_x;
    }

    /**
    * Function to set the y position
    * @param int position_y
    */
    protected function set_position_y($position_y)
    {
        $this->position_y = $position_y;
    }

    /**
    * Function to set the direction
    * @param string direction
    */
    protected function set_direction($direction)
    {
        $this->direction = strtolower($direction);
    }

    /**
    * Function to set the robot position
    * @param int pos_x
    * @param int pos_y
    * @param string dir
    */
    public function set_position_direction($pos_x, $pos_y, $dir)
    {
        $this->set_position_x($pos_x);
        $this->set_position_y($pos_y);
        $this->set_direction($dir);
    }

    /**
    * Function to rotate the direction of the robot left by 90 degree
    */
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

    /**
    * Function to rotate the direction of the robot right by 90 degree
    */
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

    /**
    * Function to move the robot by 1 step in the direction
    */
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

    /**
    * Function to check if the robot can move along y direction
    * @param string direction
    * @return boolean true or false
    */
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

    /**
    * Function to check if the robot can move along x direction
    * @param string direction
    * @return boolean true or false
    */
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