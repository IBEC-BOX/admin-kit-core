<?php

declare(strict_types=1);

namespace AdminKit\Core\Services;

use AdminKit\Core\DTO\Github\OrgRepos;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GithubClient
{
    private string $orgName = 'ibec-box';
    private string $url = 'https://api.github.com';
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl($this->url);
    }

    public function getOrgRepos(): Collection
    {
        $repos = $this->client
            ->accept('application/vnd.github+json')
            ->get("$this->url/orgs/$this->orgName/repos", [
                'type' => 'public',
                'per_page' => 100,
            ])
            ->collect();

        return OrgRepos::collect($repos)
            ->filter(fn (OrgRepos $repo) => Str::startsWith($repo->name, 'admin-kit-'));
    }
}