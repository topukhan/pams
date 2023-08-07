<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GroupInvitation;
use App\Models\PendingGroup;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class GroupRequestResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:group-request-response';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Group Request Response';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $currentTime = Carbon::now();
    $pendingUsers = GroupInvitation::where('status', 0)->get();
    
    foreach ($pendingUsers as $user){
        $createdTime = Carbon::parse($user->created_at);
        $MinutesDifferent = $createdTime->diffInMinutes($currentTime);
        
        if($MinutesDifferent > 0){

            GroupInvitation::where('id', $user->id)->update(['status' => 3]);
            PendingGroup::where('id', $user->group_id)->increment('member_feedback', 1);
            // Log::info("Updated Rows in PendingGroup: ". $updatedRows);
        }
    }
}

}
