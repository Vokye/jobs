<?php
$job_id ="";
$job = JobProfile::getById($job_id);
$job->delete();
//expected results