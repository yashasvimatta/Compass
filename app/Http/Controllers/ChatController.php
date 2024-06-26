<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Message;
class ChatController extends Controller
{

    public function getChatUsers(Request $request)
    {
$userData = $request->session()->get('user');
        // Fetch users with status=1 and exclude the current user
        $users = User::where('status', 1)
                     ->where('id', '!=', $userData->id) // Exclude the current authenticated user
                     ->get(['id', 'first_name']); // Adjust the fields based on your user model

        return response()->json($users);
    }

    public function saveMessage(Request $request)
    {
        $userData = $request->session()->get('user');
        $message = new Message([
            'sender_id' => $userData->id,
            'receiver_id' => $request->input('receiver_id'),
            'content' => $request->input('content'),
        ]);

        $message->save();

        return response()->json(['message' => 'Message saved successfully'], 201);
    }

    public function getMessages(Request $request,$receiverId)
{
   // Ensure that $senderId and $receiverId are integers
   $userData = $request->session()->get('user');
   $senderId = (int)$userData->id;
   $receiverId = (int)$receiverId;

   // Retrieve messages along with sender and receiver names
   $messages = Message::where(function ($query) use ($senderId, $receiverId) {
       $query->where('sender_id', $senderId)
             ->where('receiver_id', $receiverId);
   })->orWhere(function ($query) use ($senderId, $receiverId) {
       $query->where('sender_id', $receiverId)
             ->where('receiver_id', $senderId);
   })->orderBy('created_at', 'asc')
     ->with(['sender', 'receiver']) // Eager load sender and receiver relationships
     ->get();

   return response()->json(['messages' => $messages], 200);
}
}
