<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					{{ __("You're logged in!") }}
				</div>
			</div>
		</div>
		<br><br>
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					<div id="nuevo_registro"></div>
				</div>
			</div>
		</div>
	</div>

	<script defer>
		document.onreadystatechange = function() {
			if (document.readyState === 'complete') {
				var callback = function(e) {
					console.log("🚀 ~ callback ~ e:", e)
					document.getElementById("nuevo_registro").innerHTML += `<p>Nuevo registro recibido</p>`
				}
				Echo.private(`changeDB`)
					.listen('RegisterEvent', callback);
			}
		}
	</script>
</x-app-layout>
