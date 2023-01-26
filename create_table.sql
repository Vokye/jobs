CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id VARCHAR(100) NOT NULL,
    job_title VARCHAR(150) NOT NULL,
    job_description TEXT NOT NULL,
    job_posted VARCHAR(50) NOT NULL,
    job_employment_type VARCHAR(100) NOT NULL,
    job_category VARCHAR(100) NOT NULL,
    job_url VARCHAR(255) NOT NULL,
    job_location VARCHAR(100) NOT NULL,
    job_image VARCHAR(255) NOT NULL
);
