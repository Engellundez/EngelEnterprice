<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	public function index()
	{
		return view('admin.dashboard');
	}

	public function update_programs(Request $request)
	{
		if ($request->system_id == Null || $request->system_id == '') return response()->json('No id in your request', 400);

		DB::beginTransaction();
		try {
			$system = System::find($request->system_id);
			$system->is_publish = $request->publish;
			$system->save();
			DB::commit();
			return response()->json($system->name . ' has updated successful.');
		} catch (\Throwable $th) {
			DB::rollBack();
			throw $th;
		}
	}

	public function get_programs_publish()
	{
		$programs_publish = System::Publish()->get();
		return response()->JSON($programs_publish);
	}

	public function get_programs()
	{
		$programs = System::all();
		return response()->JSON($programs);
	}
}
