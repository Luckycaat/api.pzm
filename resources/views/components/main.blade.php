<div class="main-background relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 
    selection:bg-red-500 selection:text-white"
    style="background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)),url('{{ asset('images/background.jpg') }}')">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <x-title />
        <x-box :collection="$collection" />
    </div>
</div>
