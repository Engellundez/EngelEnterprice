<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('Published Programs') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __('Programs of ') }}<b>{{ config('app.name') }}</b>{{ __(' with access to public') }}
		</p>
	</header>

	<div x-data="published_programs_js()" x-init="getPrograms" @program.window="getPrograms">
		<template x-if="has_programs">
			<template x-for="program in published_programs">
				<li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
					<a :href="program.url" target="_blank" rel="noopener noreferrer" x-text="program.name"></a>
				</li>
			</template>
		</template>

		<template x-if="!has_programs">
			<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">No publish programs yet!</p>
		</template>
	</div>
</section>
<script>
	function published_programs_js() {
		return {
			published_programs: [],
			has_programs: false,
			async getPrograms() {
				const URL = "{{ route('admin.get_programs_publish') }}";
				fetch(URL)
					.then(response => response.json())
					.then(data => {
						this.published_programs = data;
						if (this.published_programs.length) {
							this.has_programs = true;
						} else {
							this.has_programs = false;
						}
					});
			}
		}
	}
</script>
