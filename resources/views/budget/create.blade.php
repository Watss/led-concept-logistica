<x-app-layout >
    <div id="app" data-app >

        <create-budget :id="{{$id}}" :statuses="{{$statuses}}" :budgets_detail="{{$budget}}" :is_admin="{{auth()->user()->hasRole('Administrador')}}" :user="{{auth()->user()->id}}" ></create-budget>
    </div>
</x-app-layout>
