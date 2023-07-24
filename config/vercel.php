<?php

return [
    /**
     * Authentication token to vercel
     * https://vercel.com/docs/rest-api#authentication
     */
    'token' => env('VERCEL_STATAMIC_TOKEN', ''),
    /**
     * Team id of vercel
     * https://vercel.com/docs/rest-api#accessing-resources-owned-by-a-team
     */
    'team_id' => env('VERCEL_STATAMIC_TEAM_ID', ''),
    /**
     * Project id of vercel
     *
     */
    'project_id' => env('VERCEL_STATAMIC_PROJECT_ID', '')
];
