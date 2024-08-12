<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
	public function index()
	{
		$my_programs = Auth()->user()->systems_of_my_roles;
		$all_programs = System::select('url', 'name')->getPublish();

		return view('programs.programs', compact('my_programs', 'all_programs'));
	}
}
