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

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['user'] = AUTH::user();
        $data['title'] = 'Friends';
        $data['menu'] = User_menu::all();
        $data['friend'] = Friends::all();
        $data['friend'] = Friends::orderBy('id', 'desc')->get();

        return view('admin.friends.index', $data);
    }
    public function create()
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Create Friends';
        $data['menu'] = User_menu::all();

        return view('admin.friends.create', $data);
    }
    public function store(Request $request)
    {
        // Validate the request...
        $request->validate([
            'nama' => 'required|unique:friends|max:255',
            'no_tlp' => 'required|numeric',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'instagram' => 'required',
        ]);

        $friends = new Friends;

        $friends->groups_id = $request->groups_id;
        $friends->nama = $request->nama;
        $friends->no_tlp = $request->no_tlp;
        $friends->alamat = $request->alamat;
        $friends->jenis_kelamin = $request->jenis_kelamin;
        $friends->instagram = $request->instagram;

        $friends->save();

        return redirect('/friends');
    }
    public function show($id)
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Detail Friends';
        $data['menu'] = User_menu::all();
        $data ['friend'] = Friends::with('groups')->where('id', $id)->first();
        $data ['riwayats'] = Riwayat::with('friends', 'groups')->where('friends_id', $id)->get();
        return view('admin.friends.show', $data);
    }
    public function edit($id)
    {
        $data['user'] = AUTH::user();
        $data['title'] = 'Edit Friends';
        $data['menu'] = User_menu::all();
        $data['friend'] = Friends::where('id', $id)->first();
        return view('admin.friends.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:friends|max:255',
            'no_tlp' => 'required|numeric',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'instagram' => 'required',
        ]);
        Friends::find($id)->update([
            'groups_id' => $request->groups_id,
            'nama' => $request->nama,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'instagram' => $request->instagram
        ]);

        return redirect('/friends');
    }
    public function destroy($id)
    {
        Friends::find($id)->delete();
        return redirect('/friends');
    }
}
