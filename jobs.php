<?php
include 'job.class.php';

$jobs = Job::getAll();

foreach ($jobs as $job) {
    echo "<h1>{$job->job_title}</h1>";
    echo "<p>{$job->job_description}</p>";
    echo "<p>{$job->job_location}</p>";
    echo "<hr>";
}