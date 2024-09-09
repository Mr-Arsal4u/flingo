<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Services\ChatService;
use App\Services\MailService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{

    public $chatService;
    public $MailService;

    public function __construct(ChatService $chatService, MailService $MailService)
    {
        $this->chatService = $chatService;
        $this->MailService = $MailService;
    }

    public function index()
    {
        $allUsers = $this->chatService->getAllUsers();
        // dd($allUsers->pluck('id')->toArray());
        $contacts = $this->chatService->getContacts();
        // dd($contacts);
        $messages = [];
        return view('welcome', compact('contacts', 'allUsers', 'messages'));
    }

    public function getMessages(Request $request)
    {
        $conversation = $this->chatService->getConversation($request->contact_id);
        if (!$conversation) {
            return view('chat.empty')->render();
        }
        $messages = $this->chatService->getMessages($conversation->id);

        return view('chat.messages', compact('messages'))->render();
    }

    public function sendMessage(Request $request)
    {
        $authUserId = Auth::id();
        $contact = User::find($request->contact_id);
        $conversation = $this->chatService->findOrCreateConversation($contact->id);
        if ($contact->logged_in) {
            $status = 'delivered';
        } else {
            $status = 'sent';
        }
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $authUserId,
            'message' => $request->message,
            'status' => $status,
        ]);

        $messages = $this->chatService->getMessages($conversation->id);
        // dd($messages->where('status', 'sent')
        //     ->where('sender_id', $authUserId))->pluck('id')->toArray();
        $messages->where('status', 'sent')
            ->where('sender_id', $authUserId)
            ->each(function ($message) {
                $message->status = 'delivered';
                $message->save();
            });
        return view('chat.messages', compact('messages'))->render();
    }

    public function sendMail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'message' => 'required|string',
            ]);
            // dd('here');
            $data = $request->only(['email', 'message']);
            $result = $this->MailService->sendMail($data);
            if ($result['status'] === 'success') {
                return response()->json(['status' => 'success', 'message' => $result['message']]);
            } else {
                return response()->json(['status' => 'error', 'message' => $result['message']]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function statusSeen(Request $request)
    {
        $conversation = $this->chatService->findConversation($request->contact_id);
        if (!$conversation) {
            return view('chat.empty')->render();
            // return response()->json(['status' => 'error', 'message' => 'Conversation not found']);
        }
        // dd($conversation);
        $messages = Message::where('conversation_id', $conversation->id)
            ->where('status', 'delivered')
            ->where('sender_id', '!=', Auth::id())
            ->update(['status' => 'seen', 'read_at' => now()]);
        // dd($message);
        if (!$messages) {
            return response()->json(['status' => 'error', 'message' => 'No message found']);
            // return view('chat.messages', compact('messages'))->render();
        }
        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'asc')->get();
        return view('chat.messages', compact('messages'))->render();
    }
}
