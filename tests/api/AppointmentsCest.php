<?php


class AppointmentsCest
{
    public function _before(ApiTester $I)
    {
        $I->am('Api tester');

        $I->haveHttpHeader('Accept', 'application/json');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('apikey', 'test_api_key_1');
    }

    public function _after(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     */
    public function testGetAppointments(ApiTester $I)
    {
        $I->wantTo("Test getting of appointments");

        $I->sendGet('appointments');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType(
            [
                'id' => 'integer',
                'appointment_time' => [
                    'date' => 'string',
                    'timezone_type' => 'integer',
                    'timezone' => 'string'
                ],
                'hospital' => [
                    'name' => 'string',
                    'city' => 'string',
                    'country' => 'string'
                ],
                'user' => [
                    'email' => 'string',
                    'username' => 'string'
                ],
                'created_at' => [
                    'date' => 'string',
                    'timezone_type' => 'integer',
                    'timezone' => 'string'
                ],
                'updated_at' => [
                    'date' => 'string',
                    'timezone_type' => 'integer',
                    'timezone' => 'string'
                ]
            ]
        );
    }

    /**
     * @param ApiTester $I
     */
    public function testGetSingleAppointment(ApiTester $I)
    {
        $I->wantTo("Test getting of singe appointment");

        $I->sendGet('appointments/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType(
            [
                'id' => 'integer',
                'appointment_time' => [
                    'date' => 'string',
                    'timezone_type' => 'integer',
                    'timezone' => 'string'
                ],
                'hospital' => [
                    'name' => 'string',
                    'city' => 'string',
                    'country' => 'string'
                ],
                'user' => [
                    'email' => 'string',
                    'username' => 'string'
                ],
                'created_at' => [
                    'date' => 'string',
                    'timezone_type' => 'integer',
                    'timezone' => 'string'
                ],
                'updated_at' => [
                    'date' => 'string',
                    'timezone_type' => 'integer',
                    'timezone' => 'string'
                ]
            ]
        );
    }
}
