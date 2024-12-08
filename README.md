# Laravel Blueprint Documentation Generator

This script generates an `llms.txt` file for Laravel Blueprint by scraping the repository documentation from GitHub. The `llms.txt` file is used for creating a structured overview of the documentation, which can be useful for learning and reference.

## Features

- Fetches content from the Laravel Blueprint GitHub repository.
- Extracts the description from the `index.blade.php` file.
- Parses the navigation structure from the `navigation.php` file.
- Generates an `llms.txt` file with a structured format.

## Requirements

- PHP 7.2 or higher
- Guzzle HTTP client
- Symfony DomCrawler component

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repository.git
   cd your-repository
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

## Usage

1. Run the script:
   ```bash
   # Generate basic documentation index
   php generate-llmstxt.php

   # Generate full documentation with complete content
   php generate-llmstxt.php --full
   ```

2. The script will generate one of these files:
   - `llms.txt` - Basic documentation index with links (default)
   - `llms-full.txt` - Complete documentation including full content of all linked documents (when using --full)

## Notes

- The script assumes that the `index.blade.php` and `navigation.php` files are structured as expected. Any changes to the repository structure may require updates to the script.
