<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	public function index()
	{
		$published_programs = System::Publish()->get();
		$publish_programs = System::all();
		return view('admin.dashboard', compact('publish_programs', 'published_programs'));
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
}
