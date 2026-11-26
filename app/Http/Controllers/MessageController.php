<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
   
    public function clientChat()
    {
        $admin = User::where('role', 'admin')->first();
        
        if ($admin) {
            
            Message::where('sender_id', $admin->id)
                ->where('receiver_id', Auth::id())
                ->update(['is_read' => true]);

            $messages = Message::where(function($q) use ($admin) {
                $q->where('sender_id', Auth::id())->where('receiver_id', $admin->id);
            })->orWhere(function($q) use ($admin) {
                $q->where('sender_id', $admin->id)->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')->get();
        } else {
            $messages = collect();
        }

        return view('chat.client', compact('messages', 'admin'));
    }

   
    public function adminChat($clientId = null)
    {
        $clients = User::where('role', 'client')->get();
        $messages = collect();
        $selectedClient = null;

        if ($clientId) {
            $selectedClient = User::findOrFail($clientId);
            
          
            Message::where('sender_id', $clientId)
                ->where('receiver_id', Auth::id())
                ->update(['is_read' => true]);

            $messages = Message::where(function($q) use ($clientId) {
                $q->where('sender_id', Auth::id())->where('receiver_id', $clientId);
            })->orWhere(function($q) use ($clientId) {
                $q->where('sender_id', $clientId)->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')->get();
        }

        return view('chat.admin', compact('clients', 'messages', 'selectedClient'));
    }

  
    public function send(Request $request)
    {
        $request->validate([
            'content' => 'required|string', 
            'receiver_id' => 'required|exists:users,id'
        ]);
        
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return back();
    }
}