<?php

return [

    'page_title_suffix' => 'GPSD',

    'brackets/admin-ui::admin.page_title_suffix' => 'GPSD',

    'footer' => [
        'copyright'  => 'GPSD ©',
        'powered_by' => 'Powered by',
    ],

    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => "ID",
            'first_name' => "First name",
            'last_name' => "Last name",
            'email' => "Email",
            'password' => "Password",
            'password_repeat' => "Password Confirmation",
            'activated' => "Activated",
            'forbidden' => "Forbidden",
            'language' => "Language",
                
            //Belongs to many relations
            'roles' => "Roles",
                
        ],
    ],

    'vendor' => [
        'title' => 'Vendors',

        'actions' => [
            'index' => 'Vendors',
            'create' => 'New Vendor',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'vendor' => [
        'title' => 'Vendors',

        'actions' => [
            'index' => 'Vendors',
            'create' => 'New Vendor',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'phone' => "Phone",
            'website' => "Website",
            'primary_first_name' => "Primary first name",
            'primary_last_name' => "Primary last name",
            'primary_email' => "Primary email",
            'primary_phone' => "Primary phone",
            'primary_position' => "Primary position",
            'billing_address_street' => "Billing address street",
            'billing_address_city' => "Billing address city",
            'billing_address_state' => "Billing address state",
            'billing_address_zip_code' => "Billing address zip code",
            'billing_address_country' => "Billing address country",
            'notes' => "Notes",
            
        ],
    ],

    'contact' => [
        'title' => 'Contacts',

        'actions' => [
            'index' => 'Contacts',
            'create' => 'New Contact',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'contact' => [
        'title' => 'Contacts',

        'actions' => [
            'index' => 'Contacts',
            'create' => 'New Contact',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'type' => "Type",
            'sales_representative_id' => "Sales representative",
            'primary_contact_name' => "Primary contact name",
            'primary_contact_phone' => "Primary contact phone",
            'primary_contact_email' => "Primary contact email",
            'primary_contact_address' => "Primary contact address",
            'primary_contact_job_title' => "Primary contact job title",
            'primary_contact_status' => "Primary contact status",
            'secondary_contact_name' => "Secondary contact name",
            'secondary_contact_phone' => "Secondary contact phone",
            'secondary_contact_email' => "Secondary contact email",
            'secondary_contact_address' => "Secondary contact address",
            'secondary_contact_job_title' => "Secondary contact job title",
            'secondary_contact_status' => "Secondary contact status",
            'sales_contact_name' => "Sales contact name",
            'sales_contact_phone' => "Sales contact phone",
            'sales_contact_email' => "Sales contact email",
            'sales_contact_address' => "Sales contact address",
            'sales_contact_status' => "Sales contact status",
            'design_contact_name' => "Design contact name",
            'design_contact_phone' => "Design contact phone",
            'design_contact_email' => "Design contact email",
            'design_contact_address' => "Design contact address",
            'design_contact_status' => "Design contact status",
            'financial_contact_name' => "Financial contact name",
            'financial_contact_phone' => "Financial contact phone",
            'financial_contact_email' => "Financial contact email",
            'financial_contact_address' => "Financial contact address",
            'financial_contact_status' => "Financial contact status",
            'company_name' => "Company name",
            'company_phone' => "Company phone",
            'company_address' => "Company address",
            'shipping_address' => "Shipping address",
            'website' => "Website",
            'social_media' => "Social media",
            'source' => "Source",
            'referred_by' => "Referred by",
            
        ],
    ],

    'contact' => [
        'title' => 'Contacts',

        'actions' => [
            'index' => 'Contacts',
            'create' => 'New Contact',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'project' => [
        'title' => 'Projects',

        'actions' => [
            'index' => 'Projects',
            'create' => 'New Project',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'access-log' => [
        'title' => 'Access Logs',

        'actions' => [
            'index' => 'Access Logs',
            'create' => 'New Access Log',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'vendor-category' => [
        'title' => 'Vendor Categories',

        'actions' => [
            'index' => 'Vendor Categories',
            'create' => 'New Vendor Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'setting' => [
        'title' => 'Settings',

        'actions' => [
            'index' => 'Settings',
            'create' => 'New Setting',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'role' => [
        'title' => 'Roles',

        'actions' => [
            'index' => 'Roles',
            'create' => 'New Role',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'guard_name' => "Guard name",
            
        ],
    ],

    'customer-category' => [
        'title' => 'Customer Categories',

        'actions' => [
            'index' => 'Customer Categories',
            'create' => 'New Customer Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            
        ],
    ],

    'orientation' => [
        'title' => 'Orientations',

        'actions' => [
            'index' => 'Orientations',
            'create' => 'New Orientation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'project-type' => [
        'title' => 'Project Types',

        'actions' => [
            'index' => 'Project Types',
            'create' => 'New Project Type',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'vendor-note' => [
        'title' => 'Vendor Notes',

        'actions' => [
            'index' => 'Vendor Notes',
            'create' => 'New Vendor Note',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'email-template' => [
        'title' => 'Email Templates',

        'actions' => [
            'index' => 'Email Templates',
            'create' => 'New Email Template',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'header' => "Header",
            'body' => "Body",
            'footer' => "Footer",
            'published_at' => "Published at",
            
        ],
    ],

    'project-invoice' => [
        'title' => 'Project Invoices',

        'actions' => [
            'index' => 'Project Invoices',
            'create' => 'New Project Invoice',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'project-invoice-line' => [
        'title' => 'Project Invoice Lines',

        'actions' => [
            'index' => 'Project Invoice Lines',
            'create' => 'New Project Invoice Line',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'letter-head' => [
        'title' => 'Letter Heads',

        'actions' => [
            'index' => 'Letter Heads',
            'create' => 'New Letter Head',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'payment-term' => [
        'title' => 'Payment Terms',

        'actions' => [
            'index' => 'Payment Terms',
            'create' => 'New Payment Term',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'remittance-info' => [
        'title' => 'Remittance Info',

        'actions' => [
            'index' => 'Remittance Info',
            'create' => 'New Remittance Info',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'value' => "Value",
            'default' => "Default",
            
        ],
    ],

    'vendor-payment-term' => [
        'title' => 'Vendor Payment Terms',

        'actions' => [
            'index' => 'Vendor Payment Terms',
            'create' => 'New Vendor Payment Term',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'leave-request' => [
        'title' => 'Leave Requests',

        'actions' => [
            'index' => 'Leave Requests',
            'create' => 'New Leave Request',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'timesheet' => [
        'title' => 'Timesheets',

        'actions' => [
            'index' => 'Timesheets',
            'create' => 'New Timesheet',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'purchase-order' => [
        'title' => 'Purchase Orders',

        'actions' => [
            'index' => 'Purchase Orders',
            'create' => 'New Purchase Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'project_id' => "Project",
            'type' => "Type",
            'vendor_id' => "Vendor",
            'contact_id' => "Contact",
            'sales_representative_id' => "Sales representative",
            'approved_manager_id' => "Approved manager",
            'approval_requested_by' => "Approval requested by",
            'template_type' => "Template type",
            'title' => "Title",
            'quantity' => "Quantity",
            'trim_size' => "Trim size",
            'information_requests' => "Information requests",
            'extent' => "Extent",
            'origination' => "Origination",
            'finishing_information' => "Finishing information",
            'packaging_information' => "Packaging information",
            'vendor_notes' => "Vendor notes",
            'customer_shipping_to' => "Customer shipping to",
            'additional_comments' => "Additional comments",
            'remittance_id' => "Remittance",
            'payment_term_id' => "Payment term",
            'fob_at' => "Fob at",
            'materials_in_at' => "Materials in at",
            'delivery_at' => "Delivery at",
            'approved_at' => "Approved at",
            
        ],
    ],

    'task' => [
        'title' => 'Tasks',

        'actions' => [
            'index' => 'Tasks',
            'create' => 'New Task',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    'template' => [
        'title' => 'Templates',

        'actions' => [
            'index' => 'Templates',
            'create' => 'New Template',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];