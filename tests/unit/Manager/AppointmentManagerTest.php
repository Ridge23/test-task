<?php

namespace App\Tests\Unit\Manager;

use App\Entity\Appointment;
use App\Entity\Hospital;
use App\Entity\User;
use App\Manager\AppointmentManager;
use App\Repository\AppointmentRepository;
use App\Builder\AppointmentEntityBuilder;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class AppointmentManagerTest
 *
 * @package App\Tests\Unit\Manager
 */
class AppointmentManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $dependencies = [
        AppointmentRepository::class,
        AppointmentEntityBuilder::class,
        EntityManagerInterface::class
    ];

    /**
     * @covers AppointmentManager::createAppointment()
     */
    public function testCreateAppointment()
    {
        /** @var Appointment|PHPUnit_Framework_MockObject_MockObject $appointmentEntityMock */
        $appointmentEntityMock = $this->createEmptyMock(Appointment::class);
        /** @var User|PHPUnit_Framework_MockObject_MockObject $userEntityMock */
        $userEntityMock = $this->createEmptyMock(User::class);
        /** @var Hospital|PHPUnit_Framework_MockObject_MockObject $hospitalEntityMock */
        $hospitalEntityMock = $this->createEmptyMock(Hospital::class);

        /** @var PHPUnit_Framework_MockObject_MockObject|AppointmentEntityBuilder $appointmentEntityBuilderMock */
        $appointmentEntityBuilderMock = $this->createEmptyMock(AppointmentEntityBuilder::class);
        $appointmentEntityBuilderMock->expects($this->once())
            ->method('build')
            ->with(

                $userEntityMock,
                $hospitalEntityMock,
                '2017-10-12 8:00:00'
            )
            ->willReturn($appointmentEntityMock);

        /** @var EntityManagerInterface|PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createEmptyMock(EntityManagerInterface::class);
        $entityManagerMock->expects($this->once())
                          ->method('persist')
                          ->with($appointmentEntityMock);

        $entityManagerMock->expects($this->once())
                          ->method('flush');

        $appointmentManager = $this->createMockedAppointmentManager(
            [
                AppointmentEntityBuilder::class => $appointmentEntityBuilderMock,
                EntityManagerInterface::class => $entityManagerMock
            ]
        );

        $appointment = $appointmentManager->createAppointment(
            $userEntityMock,
            $hospitalEntityMock,
            '2017-10-12 8:00:00'
        );

        $this->assertSame($appointmentEntityMock, $appointment);
    }

    /**
     * @param array $mockedDependencies
     *
     * @return AppointmentManager
     */
    private function createMockedAppointmentManager(array $mockedDependencies = [])
    {
        $dependenciesArray = [];

        foreach ($this->dependencies as $dependencyClassName) {
            if (isset($mockedDependencies[$dependencyClassName])) {
                $dependenciesArray[$dependencyClassName] = $mockedDependencies[$dependencyClassName];
            } else {
                $dependenciesArray[$dependencyClassName] = $this->createEmptyMock($dependencyClassName);
            }
        }

        return new AppointmentManager(
            $dependenciesArray[AppointmentRepository::class],
            $dependenciesArray[AppointmentEntityBuilder::class],
            $dependenciesArray[EntityManagerInterface::class]
        );
    }

    /**
     * @param string $className
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function createEmptyMock($className = '')
    {
        return $this->getMockBuilder($className)->disableOriginalConstructor()->getMock();
    }
}
