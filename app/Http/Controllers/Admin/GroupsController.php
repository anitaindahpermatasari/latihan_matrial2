<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\Groups;
use App\Models\Riwayat;
use App\Models\Users;
use App\Models\User_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Groups';
        $data['menu'] = User_menu::all();
        $data['group'] = Groups::all();
        $data['group'] = Groups::orderBy('id', 'desc')->paginate(3);

        return view('admin.groups.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Create Groups';
        $data['menu'] = User_menu::all();

        return view('admin.groups.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:groups|max:255',
            'description' => 'required'
        ]);

        $groups = new groups;

        $groups->name = $request->name;
        $groups->description = $request->description;

        $groups->save();

        return redirect('/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Detail Groups';
        $data['menu'] = User_menu::all();
        $data['group'] = Groups::where('id', $id)->first();
        $data['jumlah_anggota'] = Friends::where('groups_id', '=', $data['group']->id)->get()->count();
        return view('admin.groups.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Edit Groups';
        $data['menu'] = User_menu::all();
        $data['group'] = Groups::where('id', $id)->first();
        return view('admin.groups.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Groups::whereId($id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Groups::find($id)->delete();
        return redirect('/groups');
    }
    public function addmember($id)
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Add Groups Member';
        $data['menu'] = User_menu::all();
        $data['friend'] = Friends::where('groups_id', '=', 0)->get();
        $data['group'] = Groups::where('id', $id)->first();

        return view('admin.groups.addmember', $data);
    }
    public function updateaddmember(Request $request, $id)
    {
        $friend = Friends::where('id', $request->friend_id)->first();
        Friends::find($friend->id)->update([
            'groups_id' => $id

        ]);

        $group = Groups::find($id);
        $group->total_users_join = $group->total_users_join + 1;
        $group->save();

        $riwayat = new Riwayat();
        $riwayat->friends_id = $request->friend_id;
        $riwayat->groups_id = $id;
        $riwayat->activity = 1;
        $riwayat->date = Carbon::now();
        $riwayat->save();

        return redirect('/groups');
    }
    public function deleteaddmember(Request $request, $id)
    {
        //dd($id);

        $friend = Friends::find($id);

        $group = Groups::find($friend->groups_id);
        $group->total_users_leave = $group->total_users_leave + 1;
        $group->save();

        $riwayat = new Riwayat();
        $riwayat->friends_id = $id;
        $riwayat->groups_id = $friend->groups_id;
        $riwayat->activity = 0;
        $riwayat->date = Carbon::now();
        $riwayat->save();

        $friend->groups_id = 0;
        $friend->save();

        return redirect('/groups');
    }
}
