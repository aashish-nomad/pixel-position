<x-layout>
    <section class="text-center mb-30 mt-20">
        <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>
        <form action="" class="mt-6">
            <input type="text" placeholder="Web Developer..." class="rounded-xl bg-white/10 border-white/20 px-5 py-4 w-full max-w-xl">
        </form>
    </section>
    <section class="mb-20">
        <x-section-heading>Featured Jobs</x-section-heading>
        <div class="grid lg:grid-cols-3 gap-8 mt-6">
            @foreach($featuredJobs as $job)
                <x-job-card :$job />
            @endforeach
        </div>
    </section>
    <section class="mb-20">
        <x-section-heading>Tags</x-section-heading>
        <div class="mt-6 space-x-1">
            @foreach($tags as $tag)
                <x-tag :$tag />
            @endforeach
        </div>
    </section>
    <section class="mb-20">
        <x-section-heading>Recent Jobs</x-section-heading>
        <div class="space-y-6 mt-6">
            @foreach($jobs as $job)
                <x-job-card-wide :$job/>
            @endforeach
        </div>
    </section>
</x-layout>
