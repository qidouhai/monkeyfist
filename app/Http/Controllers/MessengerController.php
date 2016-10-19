<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Log;
use App\Http\Requests;
use App\Conversation;
use App\Message;
use App\Participant;
use App\Events\MessageSent;

class MessengerController extends Controller
{

  // search if a conversation between two users exists
  // if yes => return conversation_id, if no => trigger create conversation
  protected function searchConversation(Request $request) {
    // return ['request' => $request];

    // request does not contain the request parameters, as intended by the Request object
    // $participants = Participant::where('user_id', $request->participants[0])->orWhere('user_id', $request->participants[1])->get();

    $conversation = Conversation::whereHas('participants', function($query) use ($request) {
      $query->where('user_id', $request->participants[0]);
    })->whereHas('participants', function($query) use ($request) {
      $query->where('user_id', $request->participants[1]);
    })->has('participants', 2)->select('id')->first();

    if($conversation == null) {
      // trigger conversation creation
      return $this->createConversation($request);
    }
    // return conversation id
    return ['conversation_id' => $conversation->id];

  }

	// create conversation
	protected function createConversation(Request $request) {
    // create conversation and add participants in transaction
		$conversation_id = DB::transaction(function($request) use ($request) {
			$user_id = Auth::user()->id;

			// create conversation
			$conversation = new Conversation;
			$conversation->save();

			// add participants
			for($i = 0; $i < sizeof($request->participants); $i++) {
				$participant = new Participant;
				$participant->user_id = $request->participants[$i];
				$participant->last_read = $conversation->created_at;
				$participant->conversation_id = $conversation->id;
				$participant->save();
			}
      // return id of new conversation
      return $conversation->id;
    });

    return ['conversation_id' => $conversation_id];
	}

	// get list of a user's conversations (sorted by last message and including the last read attribute for each conversation)
	// ADD LAST MESSAGE TIMESTAMP TO EACH CONVERSATION
	protected function listConversations() {
		$conversations = Participant::where('user_id', Auth::user()->id)->get(['conversation_id']);

		return Conversation::with(['participants' => function($query) {
			$query->with(['user' => function($query) {
				$query->select('id', 'username', 'picture');
			}]);
		}])->whereIn('id', $conversations)->get();
	}

	// returns a full conversations (incl. messages and participants)
	protected function getConversation($id) {
		// check if conversation exists
		$conversation = Conversation::find($id);
		if($conversation == null)
			return ["exists" => false];

		// check if user is member of the conversation
		$participant = Participant::where([['user_id', Auth::user()->id],['conversation_id', $id]])->get();
		if($participant->isEmpty())
			return ['exists' => true, 'member' => false];

		// get full conversation
		$conversation = Conversation::with(
			[
				'messages' => function($query) {
					$query->orderBy('created_at');
				},
				'participants' => function($query) {
					$query->with(
						[
							'user' => function($query) {
								$query->select('id', 'username', 'picture');
							}
						]
					);
				}
			]
		)->find($id);

		return ["exists" => true, "member" => true, "data" => $conversation];
	}

	// add a message to a conversation and update its last_message timestamp
	protected function addMessage(Request $request) {
		$message = new Message;

		$user = Participant::where([['user_id', Auth::user()->id],['conversation_id', $request->conversation_id]])->first(['id']);
		if($user == null)
			return ['saved' => false];

		$message->conversation_id = $request->conversation_id;
		$message->participant = $user->id;
		$message->body = $request->body;

		if($message->save()) {
			event(new MessageSent($message));
			return ['saved' => $message];
		}
		return ['saved' => false];
	}

	// update last read of timestamp of a conversation

}
