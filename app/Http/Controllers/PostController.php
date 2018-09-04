<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

	// public function __construct()
 //    {
 //        parent::__construct();

 //        $this->Post = new Post;
 //    }

	/*store data*/
	public function store(Request $request){
		$this->validate($request,[
			'title'=>'required|max:255',
			'description'=>'required',
		]);

		$input = array_except($request->all(),array('_token'));

		$this->Post->AddData($input);

		$notification = \DB::table('api_users')->get();

		foreach ($notification as $key => $value) {
			$this->notification($value->token, $request->get('title'));
		}

		\Session::put('success','Post store and send notification successfully!!');

		return redirect()->route('post.index');

	}

	/*send notification*/
	public function notification($token, $title){
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		$token=$token;


		$notification = [
			'title' => $title,
			'sound' => true,
		];

		$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

		$fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
        	'Authorization: key=AIzaSyBZF5I3bI5uuAK9tlint7pE16_XFQAxQbU',
        	'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    public function test()
    {

    	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    	$token='AAAANjiv55s:APA91bFLmcHVDChNsru4cndOwzvS_o4j4lCgz5E83V_stcLvpi_T_DknMs23pA92Gys-rIlDyi81FPVI0g3uTHdRmQ5C69Sl-8MlC_S9pr9nd_dYKARHwQFW7sXHyx5dOxj-Ydxmeb2k';


    	$notification = [
    		'body' => 'this is test',
    		'sound' => true,
    	];

    	$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

    	$fcmNotification = [
        //'registration_ids' => $tokenList, //multple token array
        'to'        => $token, //single token
        'notification' => $notification,
        'data' => $extraNotificationData
    	];

	    $headers = [
	    	'Authorization: key=Legacy server key',
	    	'Content-Type: application/json'
	    ];


	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
	    $result = curl_exec($ch);
	    curl_close($ch);


	    dd($result);

	}

}
