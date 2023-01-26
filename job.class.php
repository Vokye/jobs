<?php
class Job {
    private $job_id;
    private $job_title;
    private $job_description;
    private $job_posted;
    private $job_employment_type;
    private $job_category;
    private $job_url;
    private $job_location;
    private $job_image;

    public function __construct($job_title, $job_description, $job_posted, $job_employment_type, $job_category, $job_url, $job_location, $job_image) {
        $this->job_title = $job_title;
        $this->job_description = $job_description;
        $this->job_posted = $job_posted;
        $this->job_employment_type = $job_employment_type;
        $this->job_category = $job_category;
        $this->job_url = $job_url;
        $this->job_location = $job_location;
        $this->job_image = $job_image;
    }

    private function connectDB() {
        return new mysqli("hostname", "username", "password", "database_name");
    }

    public function save() {
        $conn = $this->connectDB();

        $query = "INSERT INTO job (job_title, job_description, job_posted, job_employment_type, job_category, job_url, job_location, job_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssss", $this->job_title, $this->job_description, $this->job_posted, $this->job_employment_type, $this->job_category, $this->job_url, $this->job_location, $this->job_image);
        $stmt->execute();

        $this->job_id = $conn->insert_id;

        $conn->close();
    }

    public static function getById($id) {
        $conn = $this->connectDB();

        $query = "SELECT * FROM job WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
        $row = $result->fetch_assoc();
        $conn->close();
        return new Job($row['job_title'], $row['job_description'], $row['job_posted'], $row['job_employment_type'], $row['job_category'], $row['job_url'], $row['job_location'], $row['job_image']);
    }

    public function update() {
        $conn = $this->connectDB();

        $query = "UPDATE job SET job_title = ?, job_description = ?, job_posted = ?, job_employment_type = ?, job_category = ?, job_url = ?, job_location = ?, job_image = ? WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssi", $this->job_title, $this->job_description, $this->job_posted, $this->job_employment_type, $this->job_category, $this->job_url, $this->job_location, $this->job_image, $this->job_id);
        $stmt->execute();

        $conn->close();
    }


    public function delete() {
        $conn = $this->connectDB();

        $query = "DELETE FROM job WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $this->job_id);
        $stmt->execute();

        $conn->close();
    }

    
    public static function getAll($page, $perPage) {
        $conn = $this->connectDB();

        $start = ($page - 1) * $perPage;

        $query = "SELECT * FROM job LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $start, $perPage);
        $stmt->execute();
        $result = $stmt->get_result();

        $jobs = array();
        while ($row = $result->fetch_assoc()) {
            $jobs[] = new Job($row['job_title'], $row['job_description'], $row['job_posted'], $row['job_employment_type'], $row['job_category'], $row['job_url'], $row['job_location'], $row['job_image']);
        }

        $conn->close();
        return $jobs;
    }


    public static function search($keyword) {
        $conn = $this->connectDB();

        $query = "SELECT * FROM job WHERE job_title LIKE ? OR job_description LIKE ? OR job_location LIKE ?";
        $stmt = $conn->prepare($query);
        $search = "%$keyword%";
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        $jobs = array();
        while ($row = $result->fetch_assoc()) {
            $jobs[] = new Job($row['job_title'], $row['job_description'], $row['job_posted'], $row['job_employment_type'], $row['job_category'], $row['job_url'], $row['job_location'], $row['job_image']);
        }
        $conn->close();
        return $jobs;
    }
}

    

