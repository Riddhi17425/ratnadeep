<?php

/*
 * Repeating content blocks of the newer inner pages (managed in Admin > Page Content).
 * Each section maps to PageItem rows (page_items.section).
 *
 *  label       - name shown in the admin
 *  page        - front page the block belongs to
 *  description - show a description field
 *  contact     - show phone + email fields (office cards)
 *  image       - false | 'image' | 'icon'  (image field type)
 *  image_hint  - helper text under the image field
 */
return [

    'sections' => [
        'careers.reasons' => [
            'page' => 'Careers', 'label' => 'Why Join Ratnadeep (numbered cards)',
            'description' => true, 'contact' => false, 'image' => false,
        ],
        'careers.locations' => [
            'page' => 'Careers', 'label' => 'Locations & Contacts (office cards)',
            'description' => true, 'contact' => true, 'image' => false,
            'description_label' => 'Address',
        ],

        'packaging.options' => [
            'page' => 'Packaging & Shipping', 'label' => 'Packaging Options (cards)',
            'description' => true, 'contact' => false, 'image' => 'image',
            'image_hint' => 'Optional. Shown at 570 x 480 (the Figma card is a grey box until an image is added).',
        ],
        'packaging.approach' => [
            'page' => 'Packaging & Shipping', 'label' => 'Our Approach (numbered cards)',
            'description' => true, 'contact' => false, 'image' => false,
        ],
        'packaging.exports' => [
            'page' => 'Packaging & Shipping', 'label' => 'Export Options (cards with icon)',
            'description' => true, 'contact' => false, 'image' => 'icon',
            'image_hint' => 'SVG / PNG icon, shown at about 60 x 60.',
        ],
        'packaging.modes' => [
            'page' => 'Packaging & Shipping', 'label' => 'Global Logistics (By Road / Sea / Air)',
            'description' => false, 'contact' => false, 'image' => 'icon',
            'image_hint' => 'SVG / PNG icon, shown at about 100 x 100.',
        ],

        'inspection.approach' => [
            'page' => 'Inspection & Quality Testing', 'label' => 'Our Quality Approach (steps)',
            'description' => true, 'contact' => false, 'image' => false,
        ],
        'inspection.destructive' => [
            'page' => 'Inspection & Quality Testing', 'label' => 'Destructive Testing (checklist)',
            'description' => false, 'contact' => false, 'image' => false,
        ],
        'inspection.non_destructive' => [
            'page' => 'Inspection & Quality Testing', 'label' => 'Non-Destructive Testing (checklist)',
            'description' => false, 'contact' => false, 'image' => false,
        ],
        'inspection.reasons' => [
            'page' => 'Inspection & Quality Testing', 'label' => 'Why Ratnadeep Quality (numbered cards)',
            'description' => true, 'contact' => false, 'image' => false,
        ],

        'applications.items' => [
            'page' => 'Applications', 'label' => 'Application Cards (industries grid)',
            'description' => true, 'contact' => false, 'image' => 'image',
            'image_hint' => 'Shown at 570 x 480.',
        ],
        'applications.reasons' => [
            'page' => 'Applications', 'label' => 'Why Ratnadeep (numbered cards)',
            'description' => true, 'contact' => false, 'image' => false,
        ],
    ],

    // Areas offered in the job openings filter
    'job_areas' => ['Engineering', 'Quality', 'Operations', 'Business support'],

    // Pages that have FAQs (Admin > FAQs)
    'faq_pages' => [
        'packaging'    => 'Packaging & Shipping',
        'inspection'   => 'Inspection & Quality Testing',
        'applications' => 'Applications',
    ],
];
