<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\GroupMember;
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
            $groupsMembers = GroupMember::pluck('user_id')->unique()->toArray();
            $pendingGroupsMembers = GroupInvitation::pluck('user_id')->unique()->toArray();

            // $domainIds = $loggedInStudent->domains->pluck('id')->toArray();
            // $projectTypeIds = $loggedInStudent->projectTypes->pluck('id')->toArray();

            $authorizedToCreateGroup = !in_array($loggedInStudent->id, $pendingGroupsMembers) && !in_array($loggedInStudent->id, $groupsMembers);
            $authorizedToAccessRequest = in_array($loggedInStudent->id, $pendingGroupsMembers);
            $authorizedToAccessMyGroup = in_array($loggedInStudent->id, $groupsMembers);

            // Create an array with the data needed for session
            $sessionData = [
                'authorizedToCreateGroup' => $authorizedToCreateGroup,
                'authorizedToAccessRequest' => $authorizedToAccessRequest,
                'authorizedToAccessMyGroup' => $authorizedToAccessMyGroup,
                // 'loggedInStudentDomainIds' => $domainIds,
                // 'loggedInStudentProjectTypeIds' => $projectTypeIds,
            ];
            // Store the session data
            session()->put($sessionData);
        }
        return $next($request);
    }
}
