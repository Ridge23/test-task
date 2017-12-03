<?php


class AppointmentsCest
{
    /** @var int */
    protected $appointmentId = 0;

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

    /**
     * @param ApiTester $I
     */
    public function testCreateAppointment(ApiTester $I)
    {
        $I->wantTo('Test appointment creation');

        $body = [
            'hospital_id' => 1,
            'appointment_time' => "2017-12-12 16:00:00"
        ];

        $I->sendPOST('appointments/', $body);

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

        $responseBody = json_decode($I->grabResponse(), true);
        $this->appointmentId = $responseBody['id'];
    }

    /**
     * @param ApiTester $I
     */
    public function testDeleteAppointment(ApiTester $I)
    {
        $I->wantTo('Test appointment removal');

        $I->sendDELETE('appointments/' . $this->appointmentId);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}
