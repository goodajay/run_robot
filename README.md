Author : Ajaypal Singh
Email : er.ajaypal@gmail.com
==============================

Steps to execute the program:
------------------------------

1. Install the code using the following repo
  https://github.com/goodajay/run_robot.git

2. Install the composer, if not already and then run the following command to install the dependencies
  	composer install

3. Program is command line based and it will not work for the file if run in browser. To run the program in command line using following php command
	php app\run_robot.php - Windows
	php app/run_robot.php - Mac/Linux

4. The program will give the instructions which command to follow and how to use them. Below is the sample of how the instructions will look like after running the program

	Enter following commands to run the program
	PLACE X,Y,F - Place the robot in position using x,y and f - direction for NORTH, EAST, WEST and SOUTH. X and Y values should be between 0-4
	MOVE        - Move the robot by 1 step ahead in the direction
	LEFT        - Turn the robot left by 90 deg
	RIGHT       - Turn the robot right by 90 deg
	REPORT      - Get the current position of robot
	QUIT or 0   - Quit the program loop
	Enter the command - 

5. The program will ask the user to input the command from one of the above instructed commands. It will behave only based on the above commands, if invalid command is given then it will show the following error message
  	Invalid Command
