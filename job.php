<?php
include 'job.class.php';
$job_id = "";
$job = new Job::getById($job_id);

 if ($job) {
    echo "<h1>{$job->job_title}</h1>";
    echo "<p>{$job->job_description}</p>";
    echo "<p>{$job->job_location}</p>";
} else {
    echo "Job not found";
}