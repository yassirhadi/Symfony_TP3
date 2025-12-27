#!/bin/bash

echo "Fixing Symfony homepage..."

# Stop server
symfony server:stop 2>/dev/null

# Remove HomeController if exists
if [ -f "src/Controller/HomeController.php" ]; then
    echo "Removing HomeController.php..."
    rm src/Controller/HomeController.php
fi

# Remove home templates
if [ -d "templates/home" ]; then
    echo "Removing templates/home/..."
    rm -rf templates/home
fi

# Clear cache
echo "Clearing cache..."
php bin/console cache:clear --no-warmup

# Check routes in YAML files
echo "Checking route configurations..."
if grep -q "path: /" config/routes.yaml 2>/dev/null; then
    echo "Found route '/' in config/routes.yaml - please check this file"
    grep -n "path: /" config/routes.yaml
fi

# Start server
echo "Starting server..."
symfony server:start -d

echo "Done! Access http://localhost:8000/"
