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
        'about.values' => [
            'page' => 'About Us', 'label' => 'What We Stand For (cards)',
            'description' => true, 'contact' => false, 'image' => false,
            'defaults' => [
                ['title' => 'Manufacturing Excellence', 'description' => 'Every pipe and tube is manufactured through disciplined processes, advanced manufacturing infrastructure, and rigorous quality control to ensure consistent performance across industrial applications.'],
                ['title' => 'Customer Commitment', 'description' => 'We support customers with reliable pipe and tube manufacturing solutions, responsive communication, dependable delivery, and a clear understanding of project requirements.'],
                ['title' => 'Continuous Improvement', 'description' => 'We continuously strengthen our manufacturing capabilities, production technologies, and quality systems to meet evolving industry standards and customer expectations.'],
                ['title' => 'Integrity in Operations', 'description' => 'From raw material inspection to final dispatch, every pipe and tube is backed by complete material traceability, documented quality assurance, and transparent manufacturing practices.'],
            ],
        ],
        'about.strengths' => [
            'page' => 'About Us', 'label' => 'Our Strengths (image cards)',
            'description' => true, 'contact' => false, 'image' => 'image',
            'image_hint' => 'Shown as a background image on the About page.',
            'defaults' => [
                ['title' => 'Complete Material Traceability', 'description' => 'Every batch of raw material is fully documented and traceable from mill origin through all stages of production.', 'image' => 'frontend/assets/images/About/strength-1.png', 'alt_image_text' => 'Complete Material Traceability'],
                ['title' => 'End-to-End In-House Manufacturing', 'description' => 'Equipped with specialized cold drawing, pilgering, and finishing lines for total quality assurance.', 'image' => 'frontend/assets/images/About/strength-2.png', 'alt_image_text' => 'End-to-End In-House Manufacturing'],
                ['title' => 'Approved by Global Industries', 'description' => 'Recognized and certified by major international engineering consultants and certification bodies.', 'image' => 'frontend/assets/images/About/strength-3.png', 'alt_image_text' => 'Approved by Global Industries'],
                ['title' => '100% Inspection Before Dispatch', 'description' => 'Comprehensive hydro, eddy-current, and ultrasonic testing to verify defect-free tubing.', 'image' => 'frontend/assets/images/About/strength-4.png', 'alt_image_text' => '100% Inspection Before Dispatch'],
            ],
        ],
        'about.certifications' => [
            'page' => 'About Us', 'label' => 'Certifications (logo cards)',
            'description' => false, 'contact' => false, 'image' => 'image',
            'image_hint' => 'Upload the certification logo image.',
        ],
        'about.stages' => [
            'page' => 'About Us', 'label' => 'Manufacturing Stages',
            'description' => true, 'contact' => false, 'image' => 'image',
            'image_hint' => 'Shown when this manufacturing stage is selected.',
            'defaults' => [
                ['title' => 'Raw Material Inspection', 'description' => 'Every raw material batch is carefully inspected for chemical composition, mechanical properties, and dimensional accuracy before entering production, ensuring every pipe and tube begins with verified quality.'],
                ['title' => 'Pipe Forming & Rolling', 'description' => 'Seamless and welded pipes and tubes are formed through controlled rolling, piercing, and welding processes managed in-house to maintain tighter tolerances, consistent dimensions, and reliable mechanical performance.'],
                ['title' => 'Heat Treatment', 'description' => 'Heat treatment is carried out under controlled furnace conditions to achieve the required metallurgical structure, strength, and durability needed for demanding industrial and high-pressure applications.'],
                ['title' => 'In-House Testing & NDT', 'description' => 'Every product undergoes rigorous in-house inspection and non-destructive testing, including dimensional verification and material validation, to confirm compliance with applicable standards before moving to finishing.'],
                ['title' => 'Finishing & Marking', 'description' => 'Pipes and tubes are finished, marked, and documented with complete material traceability so every product can be identified, tracked, and supplied with the quality records required by global customers.'],
                ['title' => 'Final Inspection & Dispatch', 'description' => 'Before dispatch, every order passes through final inspection and packing checks to ensure products leave our facility ready for dependable performance in domestic and international project environments.'],
            ],
        ],
        'clients.logos' => [
            'page' => 'Clients', 'label' => 'Client Logos',
            'description' => false, 'contact' => false, 'image' => 'image',
            'image_hint' => 'Upload a client logo (SVG, PNG, JPG or WebP).',
            'defaults' => [
                ['title' => 'SABIC', 'image' => 'frontend/assets/images/Clients/sabic.svg'],
                ['title' => 'Thyssenkrupp', 'image' => 'frontend/assets/images/Clients/thyssenkrupp.svg'],
                ['title' => 'Reliance Industries Limited', 'image' => 'frontend/assets/images/Clients/reliance.png'],
                ['title' => 'Técnicas Reunidas', 'image' => 'frontend/assets/images/Clients/tecnicas-reunidas.png'],
                ['title' => 'Linde', 'image' => 'frontend/assets/images/Clients/linde.png'],
                ['title' => 'Jacobs', 'image' => 'frontend/assets/images/Clients/jacobs.png'],
                ['title' => 'Saipem', 'image' => 'frontend/assets/images/Clients/saipem.png'],
                ['title' => 'NTPC', 'image' => 'frontend/assets/images/Clients/ntpc.svg'],
                ['title' => 'BHEL', 'image' => 'frontend/assets/images/Clients/bhel.png'],
                ['title' => 'Technip', 'image' => 'frontend/assets/images/Clients/technip.svg'],
                ['title' => 'Tecnimont', 'image' => 'frontend/assets/images/Clients/tecnimont.png'],
                ['title' => 'Engineers India Limited', 'image' => 'frontend/assets/images/Clients/eil.svg'],
                ['title' => 'Thermo Cables', 'image' => 'frontend/assets/images/Clients/thermocables.png'],
                ['title' => 'Valmet', 'image' => 'frontend/assets/images/Clients/valmet.png'],
                ['title' => 'Yaar', 'image' => 'frontend/assets/images/Clients/yaar.png'],
                ['title' => 'Petrofac', 'image' => 'frontend/assets/images/Clients/petrofac.png'],
            ],
        ],
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

    // Pages that have FAQs (Admin > FAQs)
    'faq_pages' => [
        'packaging'    => 'Packaging & Shipping',
        'inspection'   => 'Inspection & Quality Testing',
        'applications' => 'Applications',
    ],
];
