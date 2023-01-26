<?php
include 'job.class.php';
// Create a new job profile
$job = new JobProfile("PHP Developer", "Seeking an experienced PHP developer to join our team", "2022-01-01", "Full-time", "IT", "https://example.com/jobs/php-developer", "New York", "image.jpg");
$job->save();

//expected results