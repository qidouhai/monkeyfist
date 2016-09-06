<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Conversation;
use App\Message;
use App\Participant;

class MessengerController extends Controller
{
    

	// create conversation
	protected function createConversation(Request $request) {
		$conversation = new Conversation;

		return DB::transaction(function($request) use ($request) {
			$user_id = Auth::user()->id;

			// create conversation
			$conversation = new Conversation;
			$conversation->save();
			// return $conversation->created_at;

			// add create of conversation as participant
			$participant = new Participant;
			$participant->user_id = $user_id;
			$participant->last_read = $conversation->created_at;
			$participant->conversation_id = $conversation->id;
			$participant->save();

			// add participants
			for($i = 0; $i < sizeof($request->participants); $i++) {
				$participant = new Participant;
				$participant->user_id = $request->participants[$i];
				$participant->last_read = $conversation->created_at;
				$participant->conversation_id = $conversation->id;
				$participant->save(); 
			}

			return ['created' => true];
		});
	}

	// get list of a user's conversations (sorted by last message and including the last read attribute for each conversation)
	// ADD LAST MESSAGE TIMESTAMP TO EACH CONVERSATION
	protected function getConversations() {
		$conversations = Participant::where('user_id', Auth::user()->id)->get(['conversation_id']);

		return Conversation::with(['participants' => function($query) {
			$query->with(['user' => function($query) {
				$query->select('id', 'username', 'picture');
			}]);
		}])->whereIn('id', $conversations)->get();
	}

	// add a message to a conversation and update its last_message timestamp
	protected function addMessage(Request $request) {
		$message = new Message;

		$message->conversation_id = $request->conversation_id;
		$message->participant = Auth::user()->id;
		$message->body = $request->body;

		$message->save();

		return ['saved' => true];
	}

	// update last read of timestamp of a conversation
	
}
