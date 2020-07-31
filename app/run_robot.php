<?php

//The program will only run through command line
if(php_sapi_name() !== 'cli'){
    echo "This file is only executed through command line";
    exit(0);
}

//load the required file
require_once "classes/Robot.php";

/**
* Set of instructions to be print out when running the program
*/
echo "Enter following commands to run the program\n";
echo "PLACE X,Y,F - Place the robot in position using x,y and f - direction for NORTH, EAST, WEST and SOUTH. X and Y values should be between 0-4 \n";
echo "MOVE        - Move the robot by 1 step ahead in the direction \n";
echo "LEFT        - Turn the robot left by 90 deg\n";
echo "RIGHT       - Turn the robot right by 90 deg \n";
echo "REPORT      - Get the current position of robot\n";
echo "QUIT or 0   - Quit the program loop\n";

$robot = new App\classes\Robot;

//Infinite loop for taking the commands from the user
while(true){

    //read the command from the user
    $command = readline("Enter the command - ");
    $command = strtolower(trim($command));

    //Condition to check if the command is PLACE
    if(strpos($command, 'place') !== FALSE){
        
        $command_args = [];
        
        if(preg_match('/place (\d+),(\d+),(\w+)/', $command, $command_args)){
            $position_x = $command_args[1];
            $position_y = $command_args[2];
            $direction = strtolower($command_args[3]);

            if($robot->validate_position($position_x, $position_y, $direction)){
                $robot->set_position_direction($position_x, $position_y, $direction);
                echo $robot->get_current_position()."\n";
            } else {
                echo "Invalid placing data for robot.\n";
            }
        } else {
            echo "Invalid command.\n";
        }

    } else if($command === 'quit' || $command == '0') {
        //Condition to check if the command is QUIT or 0
        //Only this command will terminate the while loop     
        exit(0);
    
    } else{
        //Condition to check for rest of commands
        if($robot->is_robot_placed()){
            switch($command){
                case 'move':
                    $robot->move();
                break;
                case 'left':
                    $robot->rotate_left();
                break;
                case 'right':
                    $robot->rotate_right();
                break;
                case 'report':
                    echo $robot->get_current_position()."\n";
                break;
                default:
                    echo "Invalid command\n";
            }
        } else {
            echo "You need to place the robot first.\n";
        }
    }

}