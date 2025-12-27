<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->bootEnv(__DIR__.'/.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

$container = $kernel->getContainer();
$courseService = $container->get(\App\Course\Service\CourseService::class);

echo "=== Test Course Service ===\n";

// Test 1: Tous les cours
$allCourses = $courseService->getAllCourses();
echo "Nombre de cours: " . count($allCourses) . "\n";
foreach ($allCourses as $slug => $course) {
    echo "- Slug: '$slug' => " . $course->name . "\n";
}

// Test 2: Cours par slug
$testSlug = 'introduction-a-la-programmation';
$course = $courseService->getCourseBySlug($testSlug);
echo "\nRecherche du slug: '$testSlug'\n";
echo "Trouvé: " . ($course ? "OUI - " . $course->name : "NON") . "\n";

// Test 3: Slug incorrect
$badSlug = 'test-inexistant';
$course = $courseService->getCourseBySlug($badSlug);
echo "\nRecherche du slug incorrect: '$badSlug'\n";
echo "Trouvé: " . ($course ? "OUI" : "NON (correct)") . "\n";
