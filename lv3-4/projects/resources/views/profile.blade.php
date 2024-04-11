<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2> <span style="font-size: large;font-weight: bold">Leading projects:</span></h2>
                    @foreach($lead_projects as $project)
                        <div class="p-6 bg-white border-gray-200">
                            <a href="{{ route('project',['id'=>$project->id]) }}">
                                <span style="font-weight: bold; font-size: large">{{ $project->name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2> <span style="font-size: large;font-weight: bold">Member projects:</span></h2>
                    @foreach($member_projects as $project)
                        <div class="p-6 bg-white border-gray-200">
                            <a href="{{ route('project',['id'=>$project->id]) }}">
                                <span style="font-weight: bold; font-size: large">{{ $project->name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
