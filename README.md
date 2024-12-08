# Laravel Blueprint llms.txt and llms-full.txt Generator

This script generates an `llms.txt` and `llms-full.txt`  file for Laravel Blueprint by scraping the repository documentation from GitHub. The files are used for creating a structured overview of the documentation, which can be useful for LLMs, both for learning and building up-to-date context.

## Features

- Fetches content from the Laravel Blueprint GitHub repository.
- Extracts the description from the `index.blade.php` file.
- Parses the navigation structure from the `navigation.php` file.
- Generates an `llms.txt` file with a structured format.
- Generates an `llms-full.txt` file with the content of the full documentation.

## Installation

1. Clone the repository: `git clone github.com:minthemiddle/llmstxt-generator.git`
2. Install dependencies using Composer: `composer install`

## Usage

`php generate-llmstxt.php`

2. The script will generate two files in the `output` directory:
   - `output/llms.txt` - Basic documentation index with links
   - `output/llms-full.txt` - Complete documentation including full content of all linked documents

## Notes

- The script assumes that the `index.blade.php` and `navigation.php` files are structured as expected. Any changes to the repository structure may require updates to the script.
