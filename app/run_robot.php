<?php
if(php_sapi_name() !== 'cli'){
    echo "This file is only executed through command line";
    exit(0);
}

require_once "classes/Robot.php";

echo "Enter following commands to run the program\n";
echo "PLACE X,Y,F - Place the robot in position using x,y and f - direction for NORTH, EAST, WEST and SOUTH. X and Y values should be between 0-4 \n";
echo "MOVE        - Move the robot by 1 step ahead in the direction \n";
echo "LEFT        - Turn the robot left by 90 deg\n";
echo "RIGHT       - Turn the robot right by 90 deg \n";
echo "REPORT      - Get the current position of robot\n";
echo "QUIT or 0   - Quit the program loop\n";

$robot = new App\classes\Robot;
while(true){
    
    $command = readline("Enter the command - ");
    $command = strtolower(trim($command));

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
    } else {
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
            case 'quit':
            case '0':
                exit(0);
            break;
            default:
                echo "Invalid command\n";
        }
    }


}