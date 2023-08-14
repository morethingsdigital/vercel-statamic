<?php

return [
    /**
     * Authentication token to vercel
     *
     * https://vercel.com/docs/rest-api#authentication
     */
    'token' => env('VERCEL_STATAMIC_TOKEN', ''),
    /**
     * Team id of vercel
     *
     * https://vercel.com/docs/rest-api#accessing-resources-owned-by-a-team
     */
    'team_id' => env('VERCEL_STATAMIC_TEAM_ID', ''),
    /**
     * Project id of vercel
     *
     */
    'project_id' => env('VERCEL_STATAMIC_PROJECT_ID', ''),
    /**
     * Deploy Target
     *
     * Can only have the value "production" or "preview"
     */
    'deploy_target' => env('VERCEL_STATAMIC_DEPLOY_TARGET', 'production'),
    /**
     * Enable Tag-based revalidation via Endpoint
     *
     * https://vercel.com/docs/infrastructure/data-cache#tag-based-revalidation
     */
    'tag_based_revalidation' => env('VERCEL_STATAMIC_TAG_BASED_REVALIDATION', true),
    /**
     * Custom Tag revalidation
     *
     * Define an array with collection handle keys which should be revalidated if the collection handle is changed
     */
    'custom_tag_revalidation' => [
        'collection' => null, // Default all collection handles
        'globals' => null, // Default 'globals'
        'navigation' => null, // Default 'navigation'
        'all' => null // Default all collection handles, 'navigation', 'globals'
    ]
];
