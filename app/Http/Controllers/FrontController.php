<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function about()
    {
        return view('front.about');
    }

    public function clients()
    {
        return view('front.clients');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function events()
    {
        return view('front.events');
    }

    public function careers()
    {
        $roles = [
            [
                'title' => 'Metallurgical Quality Assurance Engineer',
                'department' => 'Quality & Testing Division',
                'area' => 'Quality',
                'location' => 'Chhatral Plant, Gujarat',
                'experience' => '3 – 6 Years in Seamless Steel / Pipe Testing',
                'qualification' => 'B.E. / B.Tech in Metallurgy / Mechanical Engineering',
            ],
            [
                'title' => 'Cold Draw Bench & Pilger Mill Operator',
                'department' => 'Tube Manufacturing Operations',
                'area' => 'Operations',
                'location' => 'Chhatral Plant, Gujarat',
                'experience' => '2 – 5 Years in Tube Cold Drawing',
                'qualification' => 'Diploma / ITI Mechanical',
            ],
            [
                'title' => 'Industrial Sales & Marketing Executive (Tubes & Pipes)',
                'department' => 'Commercial & Export Sales',
                'area' => 'Business support',
                'location' => 'Ahmedabad Corporate Office / Gujarat',
                'experience' => '3 – 7 Years in Industrial Metal Sales',
                'qualification' => 'B.E. / B.Tech / MBA (Marketing)',
            ],
        ];

        $areas = ['Engineering', 'Quality', 'Operations', 'Business support'];

        $reasons = [
            ['title' => 'Work Close to the Process', 'text' => 'Get closer to the machines, materials and manufacturing processes that shape critical industrial products. Learn how engineering decisions translate into real-world performance.'],
            ['title' => 'Learn Through Responsibility', 'text' => 'Take ownership of meaningful work, work alongside experienced professionals and build expertise through hands-on responsibility and practical exposure.'],
            ['title' => 'Solve Real Engineering Problems', 'text' => 'Work on challenges where precision matters. From manufacturing and quality to testing and process improvement, every challenge is an opportunity to think, analyse and improve.'],
            ['title' => 'Grow Across Disciplines', 'text' => 'Build a broader understanding of the manufacturing ecosystem by working across engineering, production, quality, testing, commercial and operational functions.'],
        ];

        $locations = [
            ['title' => 'Registered Office', 'address' => '402, Sai Prasad Apartment, Usmanpura, Ahmedabad – 380 013, Gujarat, India.', 'phone' => '+91 82380 92054', 'email' => 'ro@ratnadeepmetal.com'],
            ['title' => 'Corporate Office:', 'address' => '102, "Rajgiri", 196/198, Khetwadi Back Road, Mumbai – 400 004, Maharashtra, India.', 'phone' => '022-66362742', 'email' => 'info@ratnadeepmetal.com'],
            ['title' => 'Manufacturing site:', 'address' => 'Survey No. 1015, Village Rajpur, Taluka Kadi, District Mehsana – 382 715, Gujarat, India.', 'phone' => '+91 97243 03768', 'email' => 'works@ratnadeepmetal.com'],
            ['title' => 'Europe Sales:', 'address' => 'Gritec Metals, S.L. Calle Barroso 6, 3a 29001 Málaga Spain', 'phone' => '+34 656 727439', 'email' => 'sales@gritecmetals.com'],
        ];

        return view('front.careers', compact('roles', 'areas', 'reasons', 'locations'));
    }

    public function packagingShipping()
    {
        $options = [
            ['title' => 'Wooden Box', 'text' => 'Designed for overseas transportation, our seaworthy wooden boxes provide reliable protection against handling, moisture, and transit conditions. This packaging solution helps preserve the quality, surface finish, and integrity of pipes and tubes during long-distance shipping.'],
            ['title' => 'Plywood Reinforced Box', 'text' => 'Our plywood reinforced boxes provide added strength for precision-engineered and high-value products. Designed for enhanced protection, they minimise movement during transit while maintaining product stability throughout storage and global transportation.'],
            ['title' => 'Hessian Cloth Bundle', 'text' => 'A practical packaging solution for standard dispatches, hessian cloth bundles safeguard finished pipes and tubes against dust, surface damage, and handling during transportation. They also support efficient loading, storage, and delivery across domestic and export shipments.'],
        ];

        $approach = [
            ['title' => 'Surface Protection', 'text' => 'Every pipe and tube is protected using appropriate wrapping and handling methods to preserve surface finish, product quality, and dimensional integrity throughout storage and transportation.'],
            ['title' => 'Secure Bundling', 'text' => 'Products are securely bundled and reinforced to minimise movement during handling, loading, and transit, ensuring safe transportation across domestic and international shipments.'],
            ['title' => 'Export-Grade Packaging', 'text' => 'Our export packaging solutions are selected to meet shipment requirements, providing dependable protection for global logistics while supporting safe handling and efficient delivery.'],
            ['title' => 'Complete Identification', 'text' => 'Each shipment is supplied with clear product identification and supporting documentation, enabling material traceability, accurate verification, and streamlined receiving at the destination.'],
        ];

        $exports = [
            ['icon' => 'icon-open-top.svg', 'title' => "20' & 40' Open Top Containers", 'text' => 'Suitable for long-length pipes and tubes, allowing convenient top loading and secure transportation for oversized cargo.'],
            ['icon' => 'icon-high-cube.svg', 'title' => "45' High Cube Containers", 'text' => 'Provides additional storage height and capacity, making it suitable for larger export shipments and efficient space utilisation.'],
            ['icon' => 'icon-fcl-lcl.svg', 'title' => 'FCL & LCL Loads', 'text' => 'Flexible shipping solutions for full-container and shared-container consignments, supporting efficient domestic and international deliveries.'],
            ['icon' => 'icon-flatbed.svg', 'title' => 'Flat Bed & Breakbulk Shipping', 'text' => 'Designed for oversized or project cargo that requires specialized handling and transportation beyond standard container dimensions.'],
        ];

        $modes = [
            ['icon' => 'icon-road.svg', 'label' => 'By Road'],
            ['icon' => 'icon-sea.svg', 'label' => 'By Sea'],
            ['icon' => 'icon-air.svg', 'label' => 'By Air'],
        ];

        $faqs = [
            ['q' => 'What packaging options do you offer for export shipments?', 'a' => 'We offer wooden boxes, export crate boxes, plywood reinforced boxes, and hessian cloth bundles. Packaging is selected based on product dimensions, handling requirements, and destination.'],
            ['q' => 'Can you accommodate non-standard pipe lengths?', 'a' => 'Yes. Long-length and non-standard consignments can be shipped in open top containers or on flat bed and breakbulk arrangements. Share your length and quantity requirements with our team and we will recommend the most suitable option.'],
            ['q' => 'Do you provide documentation with every shipment?', 'a' => 'Yes. Each shipment is supplied with clear product identification and supporting documentation to enable material traceability, verification, and smooth receiving at the destination.'],
            ['q' => 'Which shipping methods do you support?', 'a' => 'We support shipping by road, sea, and air, including FCL and LCL container loads, open top and high cube containers, and flat bed or breakbulk cargo.'],
        ];

        return view('front.packaging-shipping', compact('options', 'approach', 'exports', 'modes', 'faqs'));
    }

    public function inspectionQualityTesting()
    {
        $approach = [
            ['title' => 'Raw Material Verification', 'text' => 'Every batch is verified before entering production to ensure complete material conformity and traceability.'],
            ['title' => 'In-Process Quality Checks', 'text' => 'Critical dimensions, process parameters, and manufacturing consistency are continuously monitored throughout production.'],
            ['title' => 'Comprehensive Testing', 'text' => 'Mechanical, metallurgical, dimensional, and non-destructive testing validate every product against applicable standards.'],
            ['title' => 'Final Inspection And Documentation', 'text' => 'Finished products undergo final quality verification with complete inspection reports before dispatch.'],
        ];

        $destructive = [
            'Tensile Testing', 'Hardness Testing', 'Flattening Test', 'Flaring & Drift Expansion Test',
            'Flange Test', 'Reverse Bend Test', 'IGC Test (Practice A, B, C & E)', 'Impact Test',
            'Reverse Flattening Test', 'U-Bend Mock-Up Test', 'Residual Stress Measurement', 'Residual Chloride Test',
            'CSC Test', 'SSC Test', 'Micro & Macro Examination', 'Hot Tensile Test',
        ];

        $nonDestructive = [
            'Hydrostatic Testing', 'Eddy Current Testing', 'Ultrasonic Testing with Thickness Measurement', 'Pneumatic Air Under Water Test',
            'Positive Material Identification (PMI)', 'Spectro Analysis', 'Dye Penetrant Testing', 'Boroscopic (ID Camera) Inspection',
            'Surface Roughness Measurement', 'RFET & IRIS Testing', 'Residual Stress Measurement', 'Portable Hardness Testing',
            'Magnetic Particle Testing (MPT)',
        ];

        $reasons = [
            ['title' => 'Quality At Every Stage', 'text' => 'Inspection begins with raw materials and continues until final dispatch. Every critical stage is monitored to maintain consistency, accuracy, and product quality.'],
            ['title' => 'Advanced Testing Facilities', 'text' => "Comprehensive destructive and non-destructive testing under one roof.\nOur testing capabilities verify material integrity, mechanical performance, and dimensional accuracy."],
            ['title' => 'International Standards', 'text' => "Testing procedures aligned with globally accepted manufacturing requirements.\nProducts are evaluated against applicable specifications to ensure dependable performance across industries."],
            ['title' => 'Complete Traceability', 'text' => "Inspection reports and documentation support every shipment.\nMaterial identification and testing records provide clear visibility throughout the manufacturing process."],
        ];

        $faqs = [
            ['q' => 'What types of testing does Ratnadeep perform?', 'a' => 'Ratnadeep performs both destructive and non-destructive testing, including tensile, hardness, hydrostatic, ultrasonic, eddy current, PMI, dye penetrant, magnetic particle, and several other specialized inspection methods.'],
            ['q' => 'Are inspection reports supplied with every shipment?', 'a' => 'Yes. Finished products undergo final quality verification, and inspection reports along with material identification and testing records support every shipment.'],
            ['q' => 'Can third-party inspection agencies witness testing?', 'a' => 'Yes. Third-party inspection agencies can witness testing and inspection at our facility. Please share your inspection requirements with our team in advance so it can be coordinated.'],
            ['q' => 'Is Positive Material Identification (PMI) available?', 'a' => 'Yes. PMI is part of our non-destructive testing program and is used to verify material grade and composition.'],
        ];

        return view('front.inspection-quality-testing', compact('approach', 'destructive', 'nonDestructive', 'reasons', 'faqs'));
    }

    public function applications()
    {
        $applications = [
            ['title' => 'Oil & Gas', 'image' => 'oil-gas.jpg', 'text' => 'Reliable tubes and pipes for demanding oil and gas applications, including process systems and critical fluid handling.'],
            ['title' => 'Petrochemicals & Refineries', 'image' => 'petrochemicals-refineries.jpg', 'text' => 'Engineered for high-temperature, corrosive environments across refining and petrochemical processing operations.'],
            ['title' => 'Power Plants', 'image' => 'power-plants.jpg', 'text' => 'Precision tubes for boilers, heat exchangers, condensers, and other critical power generation systems.'],
            ['title' => 'Chemical Industries', 'image' => 'chemical-industries.jpg', 'text' => 'Corrosion-resistant tubing designed for demanding chemical processing and fluid handling applications.'],
            ['title' => 'Automotive', 'image' => 'automotive.jpg', 'text' => 'Precision tubes for demanding automotive applications requiring dimensional accuracy, strength, and dependable performance.'],
            ['title' => 'LNG', 'image' => 'lng.jpg', 'text' => 'Reliable tubing solutions for LNG systems where material integrity and performance at low temperatures are critical.'],
            ['title' => 'Fertilizers', 'image' => 'fertilizers.jpg', 'text' => 'Manufactured for process equipment and piping systems operating in demanding fertilizer production environments.'],
            ['title' => 'Pharmaceutical', 'image' => 'pharmaceutical.jpg', 'text' => 'High-quality stainless steel tubes for hygienic applications requiring cleanliness, consistency, and reliable performance.'],
            ['title' => 'Defence', 'image' => 'defence.jpg', 'text' => 'Precision-manufactured tubes and pipes for applications where quality, strength, and dependable performance are essential.'],
            ['title' => 'Food & Beverage', 'image' => 'food-beverage.jpg', 'text' => 'Stainless steel tubing suited to hygienic processing environments where surface quality and cleanliness matter.'],
            ['title' => 'Marine', 'image' => 'marine.jpg', 'text' => 'Durable tubes and pipes designed for demanding marine environments requiring corrosion resistance and structural reliability.'],
            ['title' => 'Aerospace', 'image' => 'aerospace.jpg', 'text' => 'Precision tubing for applications where dimensional control, material quality, and consistent performance are critical.'],
            ['title' => 'Mechanical', 'image' => 'mechanical.jpg', 'text' => 'Industrial tubes and pipes for machinery, equipment, hydraulic systems, and demanding mechanical applications.'],
            ['title' => 'Pulp & Paper', 'image' => 'pulp-paper.jpg', 'text' => 'Reliable piping and tubing solutions for process systems exposed to continuous operation and demanding conditions.'],
            ['title' => 'Textile', 'image' => 'textile.jpg', 'text' => 'Precision tubes supporting machinery and process systems across textile manufacturing and industrial operations.'],
            ['title' => 'Cryogenic', 'image' => 'cryogenic.jpg', 'text' => 'Specialized tubing for low-temperature applications where material integrity and reliable performance are essential.'],
            ['title' => 'Desalination Plants', 'image' => 'desalination-plants.jpg', 'text' => 'Corrosion-resistant tubes and pipes for water treatment and desalination systems operating in demanding environments.'],
            ['title' => 'Steel Plants', 'image' => 'steel-plants.jpg', 'text' => 'Heavy-duty tubes and pipes for process equipment, utilities, heat transfer, and demanding steel manufacturing operations.'],
        ];

        $reasons = [
            ['title' => 'Wide Material Portfolio', 'text' => "Stainless Steel, Nickel Alloy, Carbon Steel, Low Alloy Steel, and Low Fin Tubes.\nMultiple material options support diverse industrial applications and operating conditions."],
            ['title' => 'Precision Manufacturing', 'text' => "Controlled processes ensure dimensional consistency and dependable performance.\nEach tube is manufactured to meet specified requirements with consistent quality."],
            ['title' => 'Global Standards', 'text' => "Manufactured in compliance with internationally recognized specifications.\nQuality systems and testing processes support consistent standards across every product."],
            ['title' => 'Complete Quality Assurance', 'text' => 'Every product undergoes comprehensive inspection and testing before dispatch. Testing verifies material integrity, dimensions, mechanical properties, and overall product conformity.'],
        ];

        $faqs = [
            ['q' => 'Which industries use Ratnadeep tubes and pipes?', 'a' => 'Ratnadeep supplies precision tubes and pipes to industries including oil & gas, power generation, petrochemicals, chemicals, marine, aerospace, pharmaceuticals, defence, food processing, and many more.'],
            ['q' => 'Are your products suitable for high-pressure applications?', 'a' => 'Yes. Our tubes and pipes are manufactured to meet specified pressure, temperature, and dimensional requirements, and every product is tested before dispatch. Share your operating conditions and our team will confirm the right specification.'],
            ['q' => 'Which materials are available for different applications?', 'a' => 'Our range includes stainless steel, nickel alloy, carbon steel, low alloy steel, and low fin tubes, so we can match the material to your operating environment.'],
            ['q' => 'Can you recommend the right material for my application?', 'a' => 'Yes. Our technical team works with you to understand pressure, temperature, corrosion exposure, and process media, and recommends the most suitable material grade, dimensions, and manufacturing specification.'],
            ['q' => 'Do your products comply with international standards?', 'a' => 'Yes. Our products are manufactured in compliance with internationally recognized specifications and supported by certifications such as ISO 9001, ISO 14001, ISO 45001, PED, AD 2000, and NORSOK.'],
        ];

        return view('front.applications', compact('applications', 'reasons', 'faqs'));
    }
}
