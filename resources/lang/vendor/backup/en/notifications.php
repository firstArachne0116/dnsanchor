<?php

return [
    'exception_message' => 'Exception message: :message',
    'exception_trace' => 'Exception trace: :trace',
    'exception_message_title' => 'Exception message',
    'exception_trace_title' => 'Exception trace',

    'backup_failed_subject' => 'Failed back up of :application_name',
    'backup_failed_body' => 'Important: An error occurred while backing up :application_name',

    'backup_successful_subject' => 'Successful new backup of :application_name',
    'backup_successful_subject_title' => 'Successful new backup!',
    'backup_successful_body' => 'Great news, a new backup of :application_name was successfully created on the disk named :disk_name.',

    'cleanup_failed_subject' => 'Cleaning up the Controller-Backups of :application_name failed.',
    'cleanup_failed_body' => 'An error occurred while cleaning up the Controller-Backups of :application_name',

    'cleanup_successful_subject' => 'Clean up of :application_name Controller-Backups successful',
    'cleanup_successful_subject_title' => 'Clean up of Controller-Backups successful!',
    'cleanup_successful_body' => 'The clean up of the :application_name Controller-Backups on the disk named :disk_name was successful.',

    'healthy_backup_found_subject' => 'The Controller-Backups for :application_name on disk :disk_name are healthy',
    'healthy_backup_found_subject_title' => 'The Controller-Backups for :application_name are healthy',
    'healthy_backup_found_body' => 'The Controller-Backups for :application_name are considered healthy. Good job!',

    'unhealthy_backup_found_subject' => 'Important: The Controller-Backups for :application_name are unhealthy',
    'unhealthy_backup_found_subject_title' => 'Important: The Controller-Backups for :application_name are unhealthy. :problem',
    'unhealthy_backup_found_body' => 'The Controller-Backups for :application_name on disk :disk_name are unhealthy.',
    'unhealthy_backup_found_not_reachable' => 'The backup destination cannot be reached. :error',
    'unhealthy_backup_found_empty' => 'There are no Controller-Backups of this application at all.',
    'unhealthy_backup_found_old' => 'The latest backup made on :date is considered too old.',
    'unhealthy_backup_found_unknown' => 'Sorry, an exact reason cannot be determined.',
    'unhealthy_backup_found_full' => 'The Controller-Backups are using too much storage. Current usage is :disk_usage which is higher than the allowed limit of :disk_limit.',
];
