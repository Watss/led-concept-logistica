<x-app-layout >
    <div id="app" data-app >

        <create-budget :id="{{$id}}" :budgets_detail="{{$budget}}" :user="{{auth()->user()->id}}" ></create-budget>
    </div>
</x-app-layout>
