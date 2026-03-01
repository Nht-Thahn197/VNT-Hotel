<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'number' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        DB::table('contact_messages')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['number'],
            'message' => $data['message'],
            'created_at' => now(),
        ]);

        return Redirect::route('home.index', ['#contact'])->with('contact_success', 'Cảm ơn bạn! Chúng tôi sẽ phản hồi sớm.');
    }

    public function index()
    {
        $messages = DB::table('contact_messages')
            ->orderBy('id', 'desc')
            ->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function notifications(Request $request)
    {
        $lastId = (int) $request->query('last_id', 0);
        if ($lastId < 0) {
            $lastId = 0;
        }

        $latestId = (int) (DB::table('contact_messages')->max('id') ?? 0);
        $newCount = 0;
        if ($latestId > $lastId) {
            $newCount = DB::table('contact_messages')
                ->where('id', '>', $lastId)
                ->count();
        }

        $latestMessages = DB::table('contact_messages')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        $latestMessages->transform(function ($message) {
            $time = $message->created_at ? Carbon::parse($message->created_at) : null;
            if ($time) {
                Carbon::setLocale('vi');
                $message->time_ago = $time->diffForHumans(null, [
                    'parts' => 1,
                    'short' => false,
                ]);
                $message->created_at_iso = $time->toIso8601String();
            } else {
                $message->time_ago = 'Vừa xong';
                $message->created_at_iso = null;
            }
            return $message;
        });

        return response()->json([
            'latest_id' => $latestId,
            'new_count' => $newCount,
            'messages' => $latestMessages,
        ]);
    }
}
