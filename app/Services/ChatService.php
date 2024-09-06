<?php

namespace App\Services;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatService
{

    public function getUsers()
    {
        return User::where('id', '!=', Auth::id());
    }

    public function getAuthId()
    {
        return Auth::id();
    }

    public function getAllUsers()
    {
        $authId = $this->getAuthId();
        return $this->getUsers()->where(function ($query) use ($authId) {
            $query->whereDoesntHave('conversationsAsUser1', function ($subQuery) use ($authId) {
                $subQuery->where('user2_id', $authId);
            })->whereDoesntHave('conversationsAsUser2', function ($subQuery) use ($authId) {
                $subQuery->where('user1_id', $authId);
            });
        })->get();

        // return $this->getUsers()
        //     ->whereDoesntHave('conversations', function ($query) use ($authId) {
        //         $query->where(function ($q) use ($authId) {
        //             $q->where('user1_id', $authId)
        //                 ->orWhere('user2_id', $authId);
        //         });
        //     })->get();
    }

    public function getContacts()
    {
        $authId = $this->getAuthId();

        // return Conversation::where(function ($query) use ($authId) {
        //     $query->where('user1_id', $authId)
        //         ->orWhere('user2_id', $authId);
        // })->get();

        return $this->getUsers()->where(function ($query) use ($authId) {
            $query->whereHas('conversationsAsUser1', function ($subQuery) use ($authId) {
                $subQuery->where('user2_id', $authId);
            })->orWhereHas('conversationsAsUser2', function ($subQuery) use ($authId) {
                $subQuery->where('user1_id', $authId);
            });
        })->get();

        // return $this->getUsers()
        //     ->whereHas('conversations', function ($query) use ($authId) {
        //         $query->where(function ($q) use ($authId) {
        //             $q->where('user1_id', $authId)
        //                 ->orWhere('user2_id', $authId);
        //         });
        //     })->get();
    }

    public function getConversation($contactId)
    {
        $authUserId = $this->getAuthId();
        return Conversation::where(function ($query) use ($authUserId, $contactId) {
            $query->where('user1_id', $authUserId)
                ->where('user2_id', $contactId);
        })->orWhere(function ($query) use ($authUserId, $contactId) {
            $query->where('user1_id', $contactId)
                ->where('user2_id', $authUserId);
        })->first();
    }

    public function getMessages($id)
    {
        return Message::where('conversation_id', $id)->orderBy('created_at', 'asc')->get();
    }

    public function findOrCreateConversation($id)
    {
        $authUserId = $this->getAuthId();
        $conversation = $this->findConversation($id);
        if (!$conversation) {
            $conversation = Conversation::create([
                'user1_id' => $authUserId,
                'user2_id' => $id,
            ]);
        }
        return $conversation;
    }
    public function findConversation($id)
    {
        $authUserId = $this->getAuthId();
        return Conversation::where(function ($query) use ($authUserId, $id) {
            $query->where('user1_id', $authUserId)
                ->where('user2_id', $id);
        })
            ->orWhere(function ($query) use ($authUserId, $id) {
                $query->where('user1_id', $id)
                    ->where('user2_id', $authUserId);
            })->first();
    }
}
