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
   php generate-llmstxt.php
   ```

2. The `llms.txt` file will be generated in the root directory of the repository.

## Example

The generated `llms.txt` file will have a structure similar to the following:

```
# Laravel Blueprint

> Code generation for Laravel developers

## Introduction

- [Getting Started](https://raw.githubusercontent.com/laravel-shift/blueprint-docs/refs/heads/master/source/docs/getting-started.md)

## Commands

- [Make Blueprint](https://raw.githubusercontent.com/laravel-shift/blueprint-docs/refs/heads/master/source/docs/commands/make-blueprint.md)
- [Make Migration](https://raw.githubusercontent.com/laravel-shift/blueprint-docs/refs/heads/master/source/docs/commands/make-migration.md)

## Configuration

- [Configuration Options](https://raw.githubusercontent.com/laravel-shift/blueprint-docs/refs/heads/master/source/docs/configuration.md)
```

## Notes

- The script uses the `master` branch of the Laravel Blueprint documentation repository. Ensure that the branch exists and is up-to-date.
- The script assumes that the `index.blade.php` and `navigation.php` files are structured as expected. Any changes to the repository structure may require updates to the script.
