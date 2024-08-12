<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('Published Programs') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __('Programs of ') }}<b>{{ config('app.name') }}</b>{{__(' with access to public')}}
		</p>
	</header>

	<div>
		@forelse ($published_programs as $program)
			<li>
				<x-nav-link :href="url($program->url)">
					{{ $program->name }}
				</x-nav-link>
			</li>
		@empty
			<li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
				{{ __('No publish programs yet!') }}
			</li>
		@endforelse
	</div>
</section>
