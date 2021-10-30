<x-app-layout >
    <div id="app" data-app >
        <create-budget :user="{{ auth()->user()->id }}" :is_admin="{{auth()->user()->hasRole('Administrador')}}" :statuses="{{$statuses}}"></create-budget>
    </div>
</x-app-layout>
