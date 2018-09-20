<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function create(Request $request){
        if($request->filled('roomName')) {
          $name = $request->roomName;
          $hash = md5(($request->roomName) . time());
          DB::table('chatroom')->insert(['name' => $name, 'hash' => $hash]);
          return redirect('/chat/' . $hash);
		  }
    }

    
    public function join($room) {
        
        // Array of potential user names.
        $names = array("Donald Trump", "Hillary Clinton", "Vladmir Putin", "George W. Bush", "Richard Nixon", 
                       "John A Macdonald", "Queen Elizabeth XIII", "Bernie Sanders", "Barack Obama", "Abraham Lincoln", 
                       "George Washington", "Ronald Reagan", "Theodore Roosevelt", "Justin Trudeau");
        
        // Array of potential colors for names.        
        $colors = array("Black", "Red", "Green", "Blue", "Yellow", "DarkBlue", "Cyan", "DarkRed", "Lime", "Aqua", 
                         "Teal", "Navy", "Purple", "DarkOrchid");

        $roomData = DB::table('chatroom')->where('hash', '=', $room)->first();
        $name = $roomData->name;
        $hash = $roomData->hash;
        $user = $names[array_rand($names)];                         
        $color = $colors[array_rand($colors)];
        
        return view('chat', compact('name', 'hash', 'user', 'color'));
    }


    public function send(Request $request) {
        $user = htmlspecialchars($request->input('user')); 
        $message = htmlspecialchars($request->input('message'));
		$color = htmlspecialchars($request->input('color'));
		$room = htmlspecialchars($request->input('hash'));
        $build_string = '<p><span style="color:' . $color . '";>' . $user . '</span>: ' . $message . '</p>';  
        DB::table('chat')->insert(['room' => $room, 'message' => $build_string, 'timestamp' => time()]);
    }

    public function getMessage($room, $id){
        $msgs = DB::table('chat')->where('room', '=', $room)->where('id', '>', $id)->orderBy('id', 'asc')->get();
		$array = array();

		foreach ($msgs as $message) {
          $array[$message->id] = $message->message;
		}

        $jsonArray = json_encode($array, JSON_UNESCAPED_SLASHES);

        return $jsonArray;  
    }

}