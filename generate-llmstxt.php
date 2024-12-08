<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

function get_content(string $url): string
{
    $client = new Client();
    try {
        $response = $client->get($url);
        return $response->getBody()->getContents();
    } catch (\Exception $e) {
        throw new Exception("Failed to fetch content from: " . $url . " - " . $e->getMessage());
    }
}

function extract_description_from_index(string $index_content): string
{
    $crawler = new Crawler($index_content);
    try {
        // Use a CSS selector to find the paragraph containing the description
        $descriptionNode = $crawler->filter('p.text-lg');
        $description = $descriptionNode->text();
        // Remove HTML tags
        $description = str_replace(['<b>', '</b>', '<br>'], ['', '', ' '], $description);
        return $description;
    } catch (\Exception $e) {
        // Fallback description if extraction fails
        return "Code generation for Laravel developers";
    }
}

function build_llms_txt(string $base_url, string $repo_path, bool $full_content): string
{
    $index_url = "{$base_url}/{$repo_path}/master/source/index.blade.php";
    $navigation_url = "{$base_url}/{$repo_path}/master/navigation.php";

    try {
        $index_content = get_content($index_url);
        $navigation_content = get_content($navigation_url);
    } catch (Exception $e) {
        echo "Error fetching content: " . $e->getMessage() . "\n";
        return "";
    }

    $description = extract_description_from_index($index_content);

    $llms_txt_content = "# Laravel Blueprint\n\n";
    $llms_txt_content .= "> {$description}\n\n";

    // Evaluate the navigation.php content to get the array
    $navigation = eval(str_replace('<?php', '', $navigation_content));

    $current_section = "";

    foreach ($navigation as $section => $data) {
        if (is_array($data)) {
            if ($current_section !== $section) {
                $llms_txt_content .= "## {$section}\n";
                $current_section = $section;
            }

            if (isset($data['url'])) {
                $markdown_url = str_replace('/docs/', '/source/docs/', $data['url']) . '.md';
                $llms_txt_content .= "- [{$section}]({$base_url}/{$repo_path}/master{$markdown_url})\n";
                if ($full_content) {
                    $llms_txt_content .= get_document_content($base_url, $repo_path, $markdown_url);
                }
            }

            if (isset($data['children'])) {
                foreach ($data['children'] as $sub_section => $sub_url) {
                    $markdown_url = str_replace('/docs/', '/source/docs/', $sub_url) . '.md';
                    $llms_txt_content .= "- [{$sub_section}]({$base_url}/{$repo_path}/master{$markdown_url})\n";
                    if ($full_content) {
                        $llms_txt_content .= get_document_content($base_url, $repo_path, $markdown_url);
                    }
                }
            }
        }
    }

    return $llms_txt_content;
}

// --- Main execution ---
$github_raw_base_url = "https://raw.githubusercontent.com";
$repo_path = "laravel-shift/blueprint-docs/refs/heads";
$full_content = false;

// Parse command-line arguments
$options = getopt("", ["full"]);
if (isset($options['full'])) {
    $full_content = true;
}

$llms_txt = build_llms_txt($github_raw_base_url, $repo_path, $full_content);

if ($llms_txt) {
    file_put_contents($full_content ? "llms-full.txt" : "llms.txt", $llms_txt);
}

function get_document_content(string $base_url, string $repo_path, string $markdown_url): string
{
    $document_url = "{$base_url}/{$repo_path}/master{$markdown_url}";
    try {
        $document_content = get_content($document_url);
        return "\n" . $document_content . "\n";
    } catch (Exception $e) {
        echo "Error fetching document content: " . $e->getMessage() . "\n";
        return "";
    }
}
?>
