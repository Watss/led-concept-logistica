<x-app-layout >
    <div id="app" data-app >
        <create-budget :user="{{ auth()->user()->id }}" ></create-budget>
    </div>
</x-app-layout>
