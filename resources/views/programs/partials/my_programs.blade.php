<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('My Programs') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __('Here you find your programs of ') }}<b>{{ config('app.name') }}</b>
		</p>
	</header>

	<div>
		@forelse ($my_programs as $program)
			<li>
				<x-nav-link :href="url($program->url)">
					{{ $program->name }}
				</x-nav-link>
			</li>
		@empty
			<li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
				{{ __('You no have programs yet!') }}
			</li>
		@endforelse
	</div>
</section>
