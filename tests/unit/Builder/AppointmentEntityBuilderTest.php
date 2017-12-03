<?php

namespace App\Tests\Unit\Builder;

use App\Builder\AppointmentEntityBuilder;
use App\Entity\Appointment;
use App\Entity\Hospital;
use App\Entity\User;
use Codeception\Test\Unit;
use PHPUnit_Framework_MockObject_MockObject;
use DateTime;
use Symfony\Component\Validator\Constraints\Type;
use TypeError;

/**
 * Class AppointmentEntityBuilderTest
 *
 * @package App\Tests\Unit\Builder
 */
class AppointmentEntityBuilderTest extends Unit
{
    /**
     * @covers AppointmentEntityBuilder::build()
     * @covers Appointment::getUser()
     * @covers Appointment::getHospital()
     * @covers Appointment::getAppointmentDatetime()
     * @covers Appointment::setUser()
     * @covers Appointment::setHospital()
     * @covers Appointment::setAppointmentDatetime()
     */
    public function testBuild()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|User $userMock */
        $userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|Hospital $hospitalMock */
        $hospitalMock = $this->getMockBuilder(Hospital::class)->disableOriginalConstructor()->getMock();
        $date = '2017-12-25 08:00:00';

        $appointmentEntityBuilder = new AppointmentEntityBuilder();
        $appointmentEntity = $appointmentEntityBuilder->build($userMock, $hospitalMock, $date);

        $this->assertInstanceOf(Appointment::class, $appointmentEntity);
        $this->assertSame($userMock, $appointmentEntity->getUser());
        $this->assertSame($hospitalMock, $appointmentEntity->getHospital());
        $this->assertInstanceOf(DateTime::class, $appointmentEntity->getAppointmentDatetime());
        $this->assertSame($date, $appointmentEntity->getAppointmentDatetime()->format("Y-m-d H:i:s"));
    }

    /**
     * @expectedException TypeError
     */
    public function testBuildIncorrectDataHospital()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|User $userMock */
        $userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        /** @var PHPUnit_Framework_MockObject_MockObject|Hospital $hospitalMock */
        $hospitalMock = 'hospital';
        $date = '2017-12-25 08:00:00';

        $appointmentEntityBuilder = new AppointmentEntityBuilder();
        $appointmentEntityBuilder->build($userMock, $hospitalMock, $date);
    }

    /**
     * @expectedException TypeError
     */
    public function testBuildIncorrectDataUser()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|User $userMock */
        $userMock = 'user';
        /** @var PHPUnit_Framework_MockObject_MockObject|Hospital $hospitalMock */
        $hospitalMock = $this->getMockBuilder(Hospital::class)->disableOriginalConstructor()->getMock();
        $date = '2017-12-25 08:00:00';

        $appointmentEntityBuilder = new AppointmentEntityBuilder();
        $appointmentEntityBuilder->build($userMock, $hospitalMock, $date);
    }
}