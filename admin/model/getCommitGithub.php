<?php
function getRecentCommits($owner, $repo, $count = 4, $token = null)
{
    $url = "https://api.github.com/repos/$owner/$repo/commits?per_page=$count";

    $headers = [
        "User-Agent: MyApp"
    ];
    
    if ($token) {
        $headers[] = "Authorization: token $token";
    }

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => implode("\r\n", $headers)
        ]
    ];
    $context = stream_context_create($opts);

    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        return [];
    }

    $commits = json_decode($response, true);

    return $commits ?: [];
}