<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('Configure of Programs') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __('Edit or create new\'s programs for ') }}<b>{{ config('app.name') }}</b>
		</p>
	</header>

	<div x-data="config_programs_js()" x-init="getPrograms()">
		<template x-if="has_programs">
			<table class="table-auto w-full text-left border-collapse border border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
				<thead>
					<tr class="bg-gray-100 dark:bg-gray-700">
						<th class="px-4 py-2 border-b dark:border-gray-600">#</th>
						<th class="px-4 py-2 border-b dark:border-gray-600">Nombre</th>
						<th class="px-4 py-2 border-b dark:border-gray-600">URL</th>
						<th class="px-4 py-2 border-b dark:border-gray-600">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<template x-for="(program, index) in programs" :key="program.id">
						<tr class="border-b dark:border-gray-600">
							<td class="px-4 py-2" x-text="index + 1"></td>
							<td class="px-4 py-2">
								<input type="text" x-model="program.name" class="w-full px-2 py-1 bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 border rounded">
							</td>
							<td class="px-4 py-2">
								<input type="text" x-model="program.url" class="w-full px-2 py-1 bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 border rounded">
							</td>
							<td class="px-4 py-2">
								<button class="px-4 py-2 text-sm font-medium text-white bg-yellow-700 rounded hover:bg-yellow-800 dark:bg-yellow-600 dark:hover:bg-yellow-700">
									<i class="fa-solid fa-pen-to-square"></i>
								</button>
							</td>
						</tr>
					</template>
				</tbody>
			</table>
		</template>

		<template x-if="!has_programs">
			<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">No publish programs yet!</p>
		</template>
	</div>
</section>
<script>
	function config_programs_js() {
		return {
			programs: [],
			has_programs: false,
			async getPrograms() {
				const URL = "{{ route('admin.get_programs') }}";
				fetch(URL)
					.then(response => response.json())
					.then(data => {
						this.programs = data;
						if (this.programs.length) {
							this.has_programs = true;
						} else {
							this.has_programs = false;
						}
					});
			},
		}
	}
</script>
