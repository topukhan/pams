<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\User;
use App\Models\PendingGroup;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetStudentSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('student')->check()) {
            
            $id = Auth::guard('student')->user()->id;
            $loggedInStudent = User::where('id', $id)->with('student')->first();
            $groupsMembers = Group::pluck('members')->flatten()->unique();
            $pendingGroupsMembers = PendingGroup::pluck('members')->flatten()->unique();

            $groupsMembersArray = $groupsMembers->map(fn ($item) => json_decode($item, true))->flatten()->unique()->toArray();
            $pendingGroupsMembersArray = $pendingGroupsMembers->map(fn ($item) => json_decode($item, true))->flatten()->unique()->toArray();

            $authorizedToCreateGroup = !in_array($loggedInStudent->id, $pendingGroupsMembersArray) && !in_array($loggedInStudent->id, $groupsMembersArray);
            $authorizedToAccessRequest = in_array($loggedInStudent->id, $pendingGroupsMembersArray);
            $authorizedToAccessMyGroup = in_array($loggedInStudent->id, $groupsMembersArray);

            // Create an array with the data needed for session
            $sessionData = [
                'authorizedToCreateGroup' => $authorizedToCreateGroup,
                'authorizedToAccessRequest' => $authorizedToAccessRequest,
                'authorizedToAccessMyGroup' => $authorizedToAccessMyGroup,
            ];

            // Store the session data
            session()->put($sessionData);
        }
        return $next($request);
    }
}
