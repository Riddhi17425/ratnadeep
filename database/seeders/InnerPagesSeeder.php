<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Faq;
use App\Models\JobOpening;
use App\Models\PageItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Seeds the Figma content of the inner pages (products, job openings, page items, FAQs).
 * Safe to run more than once: every block is only inserted while its table / section is empty.
 */
class InnerPagesSeeder extends Seeder
{
    public function run(): void
    {
        $this->pageItems();
        $this->products();
        $this->jobOpenings();
        $this->faqs();
    }

    private function category(string $needle): ?int
    {
        return Category::whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($needle) . '%'])->value('id');
    }

    private function applicationIds(array $titles): array
    {
        return PageItem::where('section', 'applications.items')
            ->where('status', 1)
            ->whereIn('title', $titles)
            ->get()
            ->sortBy(fn ($application) => array_search($application->title, $titles))
            ->pluck('id')
            ->all();
    }

    private function products(): void
    {
        if (Product::withTrashed()->exists()) {
            return;
        }

        $stainless = $this->category('stainless');
        $img = 'frontend/assets/images/Products/';

        $rows = [
            [
                'title' => 'Stainless Steel Seamless Straight & “U” Tubes',
                'type' => 'Seamless Straight & U Tubes',
                'image' => $img . 'ss-seamless-tubes.jpg',
                'summary' => 'Designed for demanding industrial applications, these tubes offer corrosion resistance, dimensional accuracy, and dependable performance across elevated temperatures, pressure conditions, and critical heat transfer systems where reliability is essential.',
            ],
            [
                'title' => 'Stainless Steel Seamless Pipes',
                'type' => 'Seamless Pipes',
                'image' => $img . 'ss-seamless-pipes.jpg',
                'summary' => 'Manufactured for demanding process applications, these seamless pipes provide consistent dimensions, corrosion resistance, and reliable strength for fluid handling, heat transfer, and critical industrial service requirements across demanding operating environments.',
                'hero_text' => 'Solution Annealed, Pickled & Passivated · NPS 1/8” to NPS 12” · Available in Schedules 5S through XXS across ASTM, ASME, and EN standards.',
                'overview_title' => 'Built for Process Piping in the Most Demanding Environments',
                'overview' => [
                    'Ratnadeep\'s Stainless Steel Seamless Pipes are manufactured without a weld seam — producing a uniform grain structure, superior pressure-bearing capacity, and long-term resistance to corrosion and scaling.',
                    'Produced through controlled seamless forming followed by Solution Annealing, Pickling, and Passivation, these pipes meet the strictest dimensional and mechanical standards required by oil & gas, petrochemical, power generation, and pharmaceutical industries worldwide.',
                    'Every pipe is manufactured entirely within our 50,000 m² facility in Mehsana, Gujarat — ensuring complete traceability from raw material through to dispatch, with zero subcontracting at any stage.',
                ],
                'overview_image' => $img . 'product-detail-overview.jpg',
                'features' => [
                    ['title' => 'No weld seam', 'text' => 'Uniform grain structure throughout no weak zones under pressure.'],
                    ['title' => 'Full traceability', 'text' => 'Heat number, material certificates, and test reports for every batch.'],
                    ['title' => 'In-house annealing', 'text' => 'Solution annealing performed in-house for consistent mechanical properties.'],
                    ['title' => 'Export-ready packaging', 'text' => 'Seaworthy packing with full documentation for global shipment.'],
                ],
                'specs' => [
                    ['parameter' => 'Outside Diameter', 'value' => 'NPS 1/8" to NPS 12"', 'notes' => 'As per applicable ANSI/ASME standards'],
                    ['parameter' => 'Wall Thickness', 'value' => 'SCH 5s to SCH XXS', 'notes' => '5S, 10S, 40S, 80S, 120S, 160S, XXS'],
                    ['parameter' => 'Specifications', 'value' => 'ASTM, ASME, EN', 'notes' => 'Manufactured to applicable product specifications'],
                ],
                'grades' => ['TP 304/L/H', 'TP 316/L/H/Ti', 'TP 317/L', 'TP 321/H', 'TP 310/H/S', 'TP 347/H/HFG', 'TP 904L', 'UNS S31803', 'S32205', 'S32750', 'TP 904L', 'S32760'],
                'industry_ids' => $this->applicationIds(['Oil & Gas', 'Petrochemicals & Refineries', 'Power Plants', 'Automotive']),
            ],
            [
                'title' => 'Stainless Steel Welded Straight & “U” Tubes',
                'type' => 'Welded Straight & U Tubes',
                'image' => $img . 'ss-welded-tubes.jpg',
                'summary' => 'Engineered for demanding heat transfer applications, these welded straight and U tubes provide consistent dimensions, corrosion resistance, and dependable performance under elevated temperatures and operating conditions across critical industrial systems.',
            ],
            [
                'title' => 'Stainless Steel Welded Pipes',
                'type' => 'Welded Pipes',
                'image' => $img . 'ss-welded-pipes.jpg',
                'summary' => 'Manufactured for demanding industrial service, these welded pipes deliver consistent fabrication, dimensional accuracy, and corrosion resistance for fluid handling, process systems, and critical infrastructure applications across demanding operating environments.',
            ],
            [
                'title' => 'Stainless Steel Instrumentation & Hydraulic Tubes',
                'type' => 'Instrumentation & Hydraulic Tubes',
                'image' => $img . 'ss-instrumentation-hydraulic.jpg',
                'is_wide' => true,
                'summary' => 'Precision-engineered stainless steel instrumentation and hydraulic tubes designed for applications requiring exceptional dimensional accuracy, corrosion resistance, strength, and reliability. Manufactured to meet demanding industry requirements, these tubes provide consistent performance under high pressure and challenging operating conditions. Suitable for instrumentation systems, hydraulic circuits, control systems, and other critical applications where dependable fluid and signal transmission is essential.',
            ],
        ];

        foreach ($rows as $i => $row) {
            Product::create($row + [
                'category_id' => $stainless,
                'alt_image_text' => $row['title'],
                'sort_order' => $i + 1,
                'status' => 1,
            ]);
        }
    }

    private function jobOpenings(): void
    {
        if (JobOpening::withTrashed()->exists()) {
            return;
        }

        $rows = [
            ['title' => 'Metallurgical Quality Assurance Engineer', 'department' => 'Quality & Testing Division', 'area' => 'Quality', 'location' => 'Chhatral Plant, Gujarat', 'experience' => '3 – 6 Years in Seamless Steel / Pipe Testing', 'qualification' => 'B.E. / B.Tech in Metallurgy / Mechanical Engineering'],
            ['title' => 'Cold Draw Bench & Pilger Mill Operator', 'department' => 'Tube Manufacturing Operations', 'area' => 'Operations', 'location' => 'Chhatral Plant, Gujarat', 'experience' => '2 – 5 Years in Tube Cold Drawing', 'qualification' => 'Diploma / ITI Mechanical'],
            ['title' => 'Industrial Sales & Marketing Executive (Tubes & Pipes)', 'department' => 'Commercial & Export Sales', 'area' => 'Business support', 'location' => 'Ahmedabad Corporate Office / Gujarat', 'experience' => '3 – 7 Years in Industrial Metal Sales', 'qualification' => 'B.E. / B.Tech / MBA (Marketing)'],
        ];

        foreach ($rows as $i => $row) {
            JobOpening::create($row + ['sort_order' => $i + 1, 'status' => 1]);
        }
    }

    private function seedSection(string $section, array $rows): void
    {
        if (PageItem::withTrashed()->where('section', $section)->exists()) {
            return;
        }

        foreach ($rows as $i => $row) {
            PageItem::create($row + ['section' => $section, 'sort_order' => $i + 1, 'status' => 1]);
        }
    }

    private function pageItems(): void
    {
        $this->seedSection('careers.reasons', [
            ['title' => 'Work Close to the Process', 'description' => 'Get closer to the machines, materials and manufacturing processes that shape critical industrial products. Learn how engineering decisions translate into real-world performance.'],
            ['title' => 'Learn Through Responsibility', 'description' => 'Take ownership of meaningful work, work alongside experienced professionals and build expertise through hands-on responsibility and practical exposure.'],
            ['title' => 'Solve Real Engineering Problems', 'description' => 'Work on challenges where precision matters. From manufacturing and quality to testing and process improvement, every challenge is an opportunity to think, analyse and improve.'],
            ['title' => 'Grow Across Disciplines', 'description' => 'Build a broader understanding of the manufacturing ecosystem by working across engineering, production, quality, testing, commercial and operational functions.'],
        ]);

        $this->seedSection('careers.locations', [
            ['title' => 'Registered Office', 'description' => '402, Sai Prasad Apartment, Usmanpura, Ahmedabad – 380 013, Gujarat, India.', 'phone' => '+91 82380 92054', 'email' => 'ro@ratnadeepmetal.com'],
            ['title' => 'Corporate Office:', 'description' => '102, "Rajgiri", 196/198, Khetwadi Back Road, Mumbai – 400 004, Maharashtra, India.', 'phone' => '022-66362742', 'email' => 'info@ratnadeepmetal.com'],
            ['title' => 'Manufacturing site:', 'description' => 'Survey No. 1015, Village Rajpur, Taluka Kadi, District Mehsana – 382 715, Gujarat, India.', 'phone' => '+91 97243 03768', 'email' => 'works@ratnadeepmetal.com'],
            ['title' => 'Europe Sales:', 'description' => 'Gritec Metals, S.L. Calle Barroso 6, 3a 29001 Málaga Spain', 'phone' => '+34 656 727439', 'email' => 'sales@gritecmetals.com'],
        ]);

        $this->seedSection('packaging.options', [
            ['title' => 'Wooden Box', 'description' => 'Designed for overseas transportation, our seaworthy wooden boxes provide reliable protection against handling, moisture, and transit conditions. This packaging solution helps preserve the quality, surface finish, and integrity of pipes and tubes during long-distance shipping.'],
            ['title' => 'Plywood Reinforced Box', 'description' => 'Our plywood reinforced boxes provide added strength for precision-engineered and high-value products. Designed for enhanced protection, they minimise movement during transit while maintaining product stability throughout storage and global transportation.'],
            ['title' => 'Hessian Cloth Bundle', 'description' => 'A practical packaging solution for standard dispatches, hessian cloth bundles safeguard finished pipes and tubes against dust, surface damage, and handling during transportation. They also support efficient loading, storage, and delivery across domestic and export shipments.'],
        ]);

        $this->seedSection('packaging.approach', [
            ['title' => 'Surface Protection', 'description' => 'Every pipe and tube is protected using appropriate wrapping and handling methods to preserve surface finish, product quality, and dimensional integrity throughout storage and transportation.'],
            ['title' => 'Secure Bundling', 'description' => 'Products are securely bundled and reinforced to minimise movement during handling, loading, and transit, ensuring safe transportation across domestic and international shipments.'],
            ['title' => 'Export-Grade Packaging', 'description' => 'Our export packaging solutions are selected to meet shipment requirements, providing dependable protection for global logistics while supporting safe handling and efficient delivery.'],
            ['title' => 'Complete Identification', 'description' => 'Each shipment is supplied with clear product identification and supporting documentation, enabling material traceability, accurate verification, and streamlined receiving at the destination.'],
        ]);

        $pk = 'frontend/assets/images/Packaging/';
        $this->seedSection('packaging.exports', [
            ['title' => "20' & 40' Open Top Containers", 'description' => 'Suitable for long-length pipes and tubes, allowing convenient top loading and secure transportation for oversized cargo.', 'image' => $pk . 'icon-open-top.svg'],
            ['title' => "45' High Cube Containers", 'description' => 'Provides additional storage height and capacity, making it suitable for larger export shipments and efficient space utilisation.', 'image' => $pk . 'icon-high-cube.svg'],
            ['title' => 'FCL & LCL Loads', 'description' => 'Flexible shipping solutions for full-container and shared-container consignments, supporting efficient domestic and international deliveries.', 'image' => $pk . 'icon-fcl-lcl.svg'],
            ['title' => 'Flat Bed & Breakbulk Shipping', 'description' => 'Designed for oversized or project cargo that requires specialized handling and transportation beyond standard container dimensions.', 'image' => $pk . 'icon-flatbed.svg'],
        ]);

        $this->seedSection('packaging.modes', [
            ['title' => 'By Road', 'image' => $pk . 'icon-road.svg'],
            ['title' => 'By Sea', 'image' => $pk . 'icon-sea.svg'],
            ['title' => 'By Air', 'image' => $pk . 'icon-air.svg'],
        ]);

        $this->seedSection('inspection.approach', [
            ['title' => 'Raw Material Verification', 'description' => 'Every batch is verified before entering production to ensure complete material conformity and traceability.'],
            ['title' => 'In-Process Quality Checks', 'description' => 'Critical dimensions, process parameters, and manufacturing consistency are continuously monitored throughout production.'],
            ['title' => 'Comprehensive Testing', 'description' => 'Mechanical, metallurgical, dimensional, and non-destructive testing validate every product against applicable standards.'],
            ['title' => 'Final Inspection And Documentation', 'description' => 'Finished products undergo final quality verification with complete inspection reports before dispatch.'],
        ]);

        $this->seedSection('inspection.destructive', array_map(fn ($t) => ['title' => $t], [
            'Tensile Testing', 'Hardness Testing', 'Flattening Test', 'Flaring & Drift Expansion Test',
            'Flange Test', 'Reverse Bend Test', 'IGC Test (Practice A, B, C & E)', 'Impact Test',
            'Reverse Flattening Test', 'U-Bend Mock-Up Test', 'Residual Stress Measurement', 'Residual Chloride Test',
            'CSC Test', 'SSC Test', 'Micro & Macro Examination', 'Hot Tensile Test',
        ]));

        $this->seedSection('inspection.non_destructive', array_map(fn ($t) => ['title' => $t], [
            'Hydrostatic Testing', 'Eddy Current Testing', 'Ultrasonic Testing with Thickness Measurement', 'Pneumatic Air Under Water Test',
            'Positive Material Identification (PMI)', 'Spectro Analysis', 'Dye Penetrant Testing', 'Boroscopic (ID Camera) Inspection',
            'Surface Roughness Measurement', 'RFET & IRIS Testing', 'Residual Stress Measurement', 'Portable Hardness Testing',
            'Magnetic Particle Testing (MPT)',
        ]));

        $this->seedSection('inspection.reasons', [
            ['title' => 'Quality At Every Stage', 'description' => 'Inspection begins with raw materials and continues until final dispatch. Every critical stage is monitored to maintain consistency, accuracy, and product quality.'],
            ['title' => 'Advanced Testing Facilities', 'description' => "Comprehensive destructive and non-destructive testing under one roof.\nOur testing capabilities verify material integrity, mechanical performance, and dimensional accuracy."],
            ['title' => 'International Standards', 'description' => "Testing procedures aligned with globally accepted manufacturing requirements.\nProducts are evaluated against applicable specifications to ensure dependable performance across industries."],
            ['title' => 'Complete Traceability', 'description' => "Inspection reports and documentation support every shipment.\nMaterial identification and testing records provide clear visibility throughout the manufacturing process."],
        ]);

        $ap = 'frontend/assets/images/Applications/';
        $apps = [
            ['Oil & Gas', 'oil-gas', 'Reliable tubes and pipes for demanding oil and gas applications, including process systems and critical fluid handling.'],
            ['Petrochemicals & Refineries', 'petrochemicals-refineries', 'Engineered for high-temperature, corrosive environments across refining and petrochemical processing operations.'],
            ['Power Plants', 'power-plants', 'Precision tubes for boilers, heat exchangers, condensers, and other critical power generation systems.'],
            ['Chemical Industries', 'chemical-industries', 'Corrosion-resistant tubing designed for demanding chemical processing and fluid handling applications.'],
            ['Automotive', 'automotive', 'Precision tubes for demanding automotive applications requiring dimensional accuracy, strength, and dependable performance.'],
            ['LNG', 'lng', 'Reliable tubing solutions for LNG systems where material integrity and performance at low temperatures are critical.'],
            ['Fertilizers', 'fertilizers', 'Manufactured for process equipment and piping systems operating in demanding fertilizer production environments.'],
            ['Pharmaceutical', 'pharmaceutical', 'High-quality stainless steel tubes for hygienic applications requiring cleanliness, consistency, and reliable performance.'],
            ['Defence', 'defence', 'Precision-manufactured tubes and pipes for applications where quality, strength, and dependable performance are essential.'],
            ['Food & Beverage', 'food-beverage', 'Stainless steel tubing suited to hygienic processing environments where surface quality and cleanliness matter.'],
            ['Marine', 'marine', 'Durable tubes and pipes designed for demanding marine environments requiring corrosion resistance and structural reliability.'],
            ['Aerospace', 'aerospace', 'Precision tubing for applications where dimensional control, material quality, and consistent performance are critical.'],
            ['Mechanical', 'mechanical', 'Industrial tubes and pipes for machinery, equipment, hydraulic systems, and demanding mechanical applications.'],
            ['Pulp & Paper', 'pulp-paper', 'Reliable piping and tubing solutions for process systems exposed to continuous operation and demanding conditions.'],
            ['Textile', 'textile', 'Precision tubes supporting machinery and process systems across textile manufacturing and industrial operations.'],
            ['Cryogenic', 'cryogenic', 'Specialized tubing for low-temperature applications where material integrity and reliable performance are essential.'],
            ['Desalination Plants', 'desalination-plants', 'Corrosion-resistant tubes and pipes for water treatment and desalination systems operating in demanding environments.'],
            ['Steel Plants', 'steel-plants', 'Heavy-duty tubes and pipes for process equipment, utilities, heat transfer, and demanding steel manufacturing operations.'],
        ];
        $this->seedSection('applications.items', array_map(fn ($a) => [
            'title' => $a[0], 'description' => $a[2], 'image' => $ap . $a[1] . '.jpg', 'alt_image_text' => $a[0],
        ], $apps));

        $this->seedSection('applications.reasons', [
            ['title' => 'Wide Material Portfolio', 'description' => "Stainless Steel, Nickel Alloy, Carbon Steel, Low Alloy Steel, and Low Fin Tubes.\nMultiple material options support diverse industrial applications and operating conditions."],
            ['title' => 'Precision Manufacturing', 'description' => "Controlled processes ensure dimensional consistency and dependable performance.\nEach tube is manufactured to meet specified requirements with consistent quality."],
            ['title' => 'Global Standards', 'description' => "Manufactured in compliance with internationally recognized specifications.\nQuality systems and testing processes support consistent standards across every product."],
            ['title' => 'Complete Quality Assurance', 'description' => 'Every product undergoes comprehensive inspection and testing before dispatch. Testing verifies material integrity, dimensions, mechanical properties, and overall product conformity.'],
        ]);
    }

    private function faqs(): void
    {
        if (Faq::withTrashed()->exists()) {
            return;
        }

        $faqs = [
            'packaging' => [
                ['What packaging options do you offer for export shipments?', 'We offer wooden boxes, export crate boxes, plywood reinforced boxes, and hessian cloth bundles. Packaging is selected based on product dimensions, handling requirements, and destination.'],
                ['Can you accommodate non-standard pipe lengths?', 'Yes. Long-length and non-standard consignments can be shipped in open top containers or on flat bed and breakbulk arrangements. Share your length and quantity requirements with our team and we will recommend the most suitable option.'],
                ['Do you provide documentation with every shipment?', 'Yes. Each shipment is supplied with clear product identification and supporting documentation to enable material traceability, verification, and smooth receiving at the destination.'],
                ['Which shipping methods do you support?', 'We support shipping by road, sea, and air, including FCL and LCL container loads, open top and high cube containers, and flat bed or breakbulk cargo.'],
            ],
            'inspection' => [
                ['What types of testing does Ratnadeep perform?', 'Ratnadeep performs both destructive and non-destructive testing, including tensile, hardness, hydrostatic, ultrasonic, eddy current, PMI, dye penetrant, magnetic particle, and several other specialized inspection methods.'],
                ['Are inspection reports supplied with every shipment?', 'Yes. Finished products undergo final quality verification, and inspection reports along with material identification and testing records support every shipment.'],
                ['Can third-party inspection agencies witness testing?', 'Yes. Third-party inspection agencies can witness testing and inspection at our facility. Please share your inspection requirements with our team in advance so it can be coordinated.'],
                ['Is Positive Material Identification (PMI) available?', 'Yes. PMI is part of our non-destructive testing program and is used to verify material grade and composition.'],
            ],
            'applications' => [
                ['Which industries use Ratnadeep tubes and pipes?', 'Ratnadeep supplies precision tubes and pipes to industries including oil & gas, power generation, petrochemicals, chemicals, marine, aerospace, pharmaceuticals, defence, food processing, and many more.'],
                ['Are your products suitable for high-pressure applications?', 'Yes. Our tubes and pipes are manufactured to meet specified pressure, temperature, and dimensional requirements, and every product is tested before dispatch. Share your operating conditions and our team will confirm the right specification.'],
                ['Which materials are available for different applications?', 'Our range includes stainless steel, nickel alloy, carbon steel, low alloy steel, and low fin tubes, so we can match the material to your operating environment.'],
                ['Can you recommend the right material for my application?', 'Yes. Our technical team works with you to understand pressure, temperature, corrosion exposure, and process media, and recommends the most suitable material grade, dimensions, and manufacturing specification.'],
                ['Do your products comply with international standards?', 'Yes. Our products are manufactured in compliance with internationally recognized specifications and supported by certifications such as ISO 9001, ISO 14001, ISO 45001, PED, AD 2000, and NORSOK.'],
            ],
        ];

        foreach ($faqs as $page => $rows) {
            foreach ($rows as $i => [$question, $answer]) {
                Faq::create(['page' => $page, 'question' => $question, 'answer' => $answer, 'sort_order' => $i + 1, 'status' => 1]);
            }
        }
    }
}
