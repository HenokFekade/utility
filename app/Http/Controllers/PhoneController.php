<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class PhoneController extends Controller
{
    /**
     * @var mixed
     */
    private $account_sid;
    /**
     * @var mixed
     */
    private $auth_token;
    /**
     * @var mixed
     */
    private $from;
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->account_sid = env('ACCOUNT_SID');
        $this->auth_token = env('AUTH_TOKEN');

        $this->from = env('TWILIO_PHONE_NUMBER');

        $this->client = new Client($this->account_sid, $this->auth_token);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \SoapFault
     */
    public function index()
    {

        return view('phone.index');
    }


    public function initiateCall(Request $request)
    {
        try {
            //Lookup phone number to make sure it is valid before initiating call
            $phone_number = $this->verifier($request);

            // If phone number is valid and exists
            if ($phone_number) {
                // Initiate call and record call
                $call = $this->client->account->calls->create(
                    $request->phone_number, // Destination phone number
                    $this->from, // Valid Twilio phone number
                    array(
                        "record" => True,
                        "url" => "http://demo.twilio.com/docs/voice.xml")
                );

                if ($call) {
                    return redirect()->back()->with('success P', 'success');
                } else {
                    return redirect()->back()->with('error P', 'error');
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        } catch (RestException $rest) {
            echo 'Error: ' . $rest->getMessage();
        }
    }


    public function initiateMessage(Request $request)
    {
        try {
            //Lookup phone number to make sure it is valid before initiating call
            $phone_number = $this->verifier($request);

            // If phone number is valid and exists
            if ($phone_number) {
                // Initiate call and record call
                $message = $this->client->messages->create(
                // Where to send a text message (your cell phone?)
                    $request->phone_number,
                    array(
                        'from' => $this->from,
                        'body' => 'Power on button is pressed!'
                    )
                );

                if ($message) {
                    return redirect()->back()->with('success M', 'success');
                } else {
                    return redirect()->back()->with('error M', 'error');
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        } catch (RestException $rest) {
            echo 'Error: ' . $rest->getMessage();
        }
    }

    private function verifier(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required|string',
        ]);
        return $this->client->lookups->v1->phoneNumbers($request->phone_number)->fetch();
    }
}




