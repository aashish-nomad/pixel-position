<x-layout>
    <x-page-heading>Results</x-page-heading>
    <section class="mb-20">
        <div class="space-y-6 mt-6">
            @foreach($jobs as $job)
                <x-job-card-wide :$job/>
            @endforeach
        </div>
    </section>
</x-layout>
