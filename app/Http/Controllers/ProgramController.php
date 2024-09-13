<?php

namespace App\Http\Controllers;

use App\Events\RegisterEvent;
use App\Models\System;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
	public function index()
	{
		RegisterEvent::dispatch('Entra uno nuevo');
		$my_programs = Auth()->user()->systems_of_my_roles;
		$all_programs = System::select('url', 'name')->getPublish();

		return view('programs.programs', compact('my_programs', 'all_programs'));
	}
}
