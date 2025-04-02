<?php

use App\Models\Employer;
use App\Models\Job;

it('belongs to an employer', function () {

    /** 1st step Arrange **/
    // If we want to check if a Job belongs to an employer - we need an employer.
    $employer = Employer::factory()->create();
    // We also need the Job to check if that Job belongs to an Employer.
    // Here if we run the below code the factory method for Job will create its own employer, however if we want
    // to override it we need to provide the employer that we want it to override.
    $job =  Job::factory()->create([
        'employer_id' => $employer->id,
    ]);

    /** 2nd step Act and Assert **/
    // Here is method check if the current instance is exactly the same as the passed argument.
    expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function () {
    $job = Job::factory()->create();
    $job->tag('Front-end');
    expect($job->tags)->toHaveCount(1);
});
