<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('Programs for Publishing') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __('Programs of ') }}<b>{{ config('app.name') }}</b>{{ __(' for Publishing') }}
		</p>
	</header>

	<div id="publish_programs" x-data="allPrograms()" x-init="getPrograms().then(() => activate())">
		<span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Programs') }}</span>
		<br>
		<template x-if="has_programs">
			<template x-for="program in programs">
				<div>
					<label class="inline-flex items-center cursor-pointer">
						<input type="checkbox" :checked="program.is_publish == 1 ? true : false" :name="'program-' + program.id + '-' + program.name" class="sr-only peer programs">
						<div
							class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300" x-text="program.name"></span>
					</label>
				</div>
			</template>
		</template>
		<template x-if="!has_programs">
			<li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
				{{ __('No exist programs yet!') }}</p>
			</li>
		</template>
	</div>
</section>

<script>
	const CSRF = "{{ csrf_token() }}";

	function updateProgram(data) {
		let url = "{{ route('admin.update_programs') }}"
		return new Promise((resolve, reject) => {
			fetch(url, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': CSRF
					},
					body: JSON.stringify(data)
				})
				.then(response => {
					if (!response.ok) return response.json().then(err => {
						console.error(err);
						throw err
					});
					window.dispatchEvent(new CustomEvent('program'));
					return response.json();
				})
				.then(result => {
					resolve(result); // Resolviendo la promesa con los datos resultantes
				})
				.catch(error => {
					reject(error); // Rechazando la promesa si ocurre un error
				});
		});
	}

	function allPrograms() {
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
			activate() {
				setTimeout(this._activate, 200);
			},
			_activate() {
				let checkboxes = document.querySelectorAll('#publish_programs input[type="checkbox"]');
				checkboxes.forEach(function(checkbox) {

					checkbox.addEventListener('change', function(event) {
						let id_name = event.target.name.replace('program-', '')
						id_name = id_name.split('-')
						let system_id = id_name[0]
						let name = id_name[1]
						let data = {
							_method: 'PUT',
							system_id: system_id,
							publish: event.target.checked,
							_token: CSRF
						}

						let publish_unpublis = event.target.checked ? 'publish' : 'unpublish'

						Swal.fire({
							title: `Do you want ${publish_unpublis} the program "${name}"`,
							showDenyButton: true,
							showCancelButton: false,
							confirmButtonText: publish_unpublis,
							denyButtonText: `Don't ${publish_unpublis}`
						}).then((result) => {
							/* Read more about isConfirmed, isDenied below */
							if (result.isConfirmed) {
								updateProgram(data).then(result => {
										Swal.fire({
											position: 'top-end',
											title: "Saved!",
											text: result,
											icon: "success",
											showConfirmButton: false,
											timer: 1500
										});
									})
									.catch(error => {
										Swal.fire({
											icon: 'error',
											html: error,
											title: 'error'
										});
									});
							} else {
								event.target.checked = !event.target.checked;
								Swal.fire({
									position: 'top-end',
									icon: "info",
									title: "Changes are not saved",
									showConfirmButton: false,
									timer: 1500
								});
							}
						});

					});
				});
			}
		}
	}
</script>
