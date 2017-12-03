<?php

namespace App\Tests\Unit\Builder;

use App\Builder\AppointmentEntityBuilder;
use App\Entity\Hospital;
use App\Entity\User;
use Codeception\Test\Unit;

/**
 * Class AppointmentEntityBuilderTest
 *
 * @package App\Tests\Unit\Builder
 */
class AppointmentEntityBuilderTest extends Unit
{
    public function testBuild() {
        $userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $hospitalMock = $this->getMockBuilder(Hospital::class)->disableOriginalConstructor()->getMock();
        $date = '2017-12-25 08:00:00.000000';

        $appointmentEntityBuilder = new AppointmentEntityBuilder();
    }
}