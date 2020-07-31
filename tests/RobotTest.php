<?php
use \PHPUnit\Framework\TestCase;
use App\classes\Robot;

/**
* Robot Test class definition
*/

class RobotTest extends TestCase
{
    public function testPlaceCommand()
    {
        $robot = new Robot();
        $robot->set_position_direction(3,3,'north');

        $this->assertSame(3, $robot->get_position_x());
        $this->assertSame(3, $robot->get_position_y());
        $this->assertSame('NORTH', $robot->get_direction());
    }

    public function testMoveCommand()
    {
        $robot = new Robot;
        $robot->set_position_direction(3,3,'north');
        $robot->move();

        $this->assertSame(3, $robot->get_position_x());
        $this->assertSame(4, $robot->get_position_y());
        $this->assertSame('NORTH', $robot->get_direction());

        $robot->move();
        $this->assertSame(3, $robot->get_position_x());
        $this->assertSame(4, $robot->get_position_y());
        $this->assertSame('NORTH', $robot->get_direction());
    }

    public function testLeftCommand()
    {
        $robot = new Robot;
        $robot->set_position_direction(0,0,'NORTH');
        $robot->rotate_left();

        $this->assertSame('WEST', $robot->get_direction());
    }

    public function testRightCommand()
    {
        $robot = new Robot;
        $robot->set_position_direction(0,0,'NORTH');
        $robot->rotate_right();

        $this->assertSame('EAST', $robot->get_direction());
    }

    public function testReportCommand()
    {
        $robot = new Robot;
        $robot->set_position_direction(0,0,'NORTH');
        
        $this->assertSame('Toy robot is at 0, 0, NORTH', $robot->get_current_position());
    }
}