<?php

namespace Morethingsdigital\VercelStatamic\Enums;

enum VercelWebhookEvents: string
{
        // Domain
    case DOMAIN_CREATED = 'domain.created';
    case DOMAIN_CREATED_2 = 'domain-created';

        // Deployment
    case DEPLOYMENT = 'deployment';
    case DEPLOYMENT_CREATED = 'deployment.created';
    case DEPLOYMENT_ERROR = 'deployment.error';
    case DEPLOYMENT_CANCELED = 'deployment.canceled';
    case DEPLOYMENT_SUCCEEDED = 'deployment.succeeded';
    case DEPLOYMENT_READY = 'deployment.ready';
    case DEPLOYMENT_CHECK_REREQUESTED = 'deployment.check-rerequested';
    case DEPLOYMENT_CHECKS_COMPLETED = 'deployment-checks-completed';
    case DEPLOYMENT_READY_2 = 'deployment-ready';
    case DEPLOYMENT_PREPARED = 'deployment-prepared';
    case DEPLOYMENT_ERROR_2 = 'deployment-error';
    case DEPLOYMENT_CHECK_REREQUESTED_2 = 'deployment-check-rerequested';
    case DEPLOYMENT_CANCELED_2 = 'deployment-canceled';

        // Integration Configuration
    case INTEGRATION_CONFIGURATION_PERMISSION_UPGRADED = 'integration-configuration.permission-upgraded';
    case INTEGRATION_CONFIGURATION_REMOVED = 'integration-configuration.removed';
    case INTEGRATION_CONFIGURATION_SCOPE_CHANGE_CONFIRMED = 'integration-configuration.scope-change-confirmed';
    case INTEGRATION_CONFIGURATION_PERMISSION_UPDATED_2 = 'integration-configuration-permission-updated';
    case INTEGRATION_CONFIGURATION_REMOVED_2 = 'integration-configuration-removed';
    case INTEGRATION_CONFIGURATION_SCOPE_CHANGE_CONFIRMED_2 = 'integration-configuration-scope-change-confirmed';

        // Project
    case PROJECT_CREATED = 'project.created';
    case PROJECT_REMOVED = 'project.removed';
    case PROJECT_CREATED_2 = 'project-created';
    case PROJECT_REMOVED_2 = 'project-removed';
}
