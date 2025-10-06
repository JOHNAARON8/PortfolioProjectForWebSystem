<?php
include "./Backends/DatabaseConnection.php";

$about = null;
$skills = [];
$projectCount = 0;

try {
    $sql = "SELECT * FROM about LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $about = $result->fetch_assoc();
    }
} catch (Throwable $e) {
    error_log("About query error: " . $e->getMessage());
}

// for the about section default text if no data found in the database
$selfIntroduction = !empty($about['selfIntroduction']) 
    ? $about['selfIntroduction'] 
    :   "Hi there! I'm John Aron Cadag, a passionate full-stack developer and creative technologist based in the Philippines. With a keen eye for design and a love for cutting-edge technology, I bridge the gap between functionality and aesthetics.

        My journey in tech began with curiosity about how websites work, which evolved into mastering modern web technologies. I specialize in creating immersive digital experiences using React with Laravel, and I’m also learning MERN Stack, always pushing the boundaries of what's possible on the web.

        Beyond coding, I believe in continuous learning and collaboration. I enjoy sharing knowledge, working on open-source projects, and connecting with like-minded innovators. I also plan to work abroad to gain international experience, broaden my perspective, and bring global insights into my career journey.

        When I'm not coding, you can find me exploring Cyber Security, Data Analysis, and Networking as part of my journey to expand my expertise in the tech world.";

        $yearsExperience  = !empty($about['years_experience']) 
        ? $about['years_experience'] 
    : 0;

if (!empty($about['id'])) {
    $about_id = intval($about['id']);
    try {
        $skillsSql = "SELECT * FROM skills WHERE about_id = $about_id ORDER BY created_at ASC";
        $skillsResult = $conn->query($skillsSql);
        if ($skillsResult && $skillsResult->num_rows > 0) {
            while ($row = $skillsResult->fetch_assoc()) {
                $skills[] = $row;
            }
        }
    } catch (Throwable $e) {
        error_log("Skills query error: " . $e->getMessage());
    }
}

try {
    $countSql = "SELECT COUNT(*) AS total FROM projects";
    $countResult = $conn->query($countSql);
    if ($countResult) {
        $projectCount = $countResult->fetch_assoc()['total'];
    }
} catch (Throwable $e) {
    error_log("Projects count error: " . $e->getMessage());
}

// show the default skills if no skills found in the database
if (empty($skills)) {
    $skills = [
        [
            "skill" => "Full-Stack Development",
            "skillDescription" => "Building robust web applications from database to user interface with modern technologies and best practices."
        ],
        [
            "skill" => "Interactive Design",
            "skillDescription" => "Creating engaging user experiences with smooth animations, micro-interactions, and intuitive interfaces."
        ],
        [
            "skill" => "Network Design",
            "skillDescription" => "Offering professional network design services tailored to ensure efficiency, security, and scalability. From setting up small office networks to implementing enterprise-grade infrastructures, I provide solutions in LAN/WAN configuration, IP addressing, and secure wireless integration."
        ],
        [
            "skill" => "IT Support",
            "skillDescription" => "Providing essential IT support services including basic troubleshooting, software configuration, and system setup to ensure smooth and efficient operations. I help users resolve issues quickly and optimize their technology experience."
        ]
    ];
}
?>
