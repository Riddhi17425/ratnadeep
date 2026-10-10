<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Static product catalogue used by the products listing and product detail pages.
 * Only products with a Figma design are listed here; add more entries as designs arrive.
 */
class ProductCatalog
{
    public static function families(): array
    {
        return ['Stainless Steel', 'Nickel Alloy', 'Carbon Steel', 'Low Alloy Steel', 'Low Fin Tubes'];
    }

    public static function all(): array
    {
        $products = [
            [
                'title' => 'Stainless Steel Seamless Straight & “U” Tubes',
                'family' => 'Stainless Steel',
                'type' => 'Seamless Straight & U Tubes',
                'image' => 'ss-seamless-tubes.jpg',
                'summary' => 'Designed for demanding industrial applications, these tubes offer corrosion resistance, dimensional accuracy, and dependable performance across elevated temperatures, pressure conditions, and critical heat transfer systems where reliability is essential.',
            ],
            [
                'title' => 'Stainless Steel Seamless Pipes',
                'family' => 'Stainless Steel',
                'type' => 'Seamless Pipes',
                'image' => 'ss-seamless-pipes.jpg',
                'summary' => 'Manufactured for demanding process applications, these seamless pipes provide consistent dimensions, corrosion resistance, and reliable strength for fluid handling, heat transfer, and critical industrial service requirements across demanding operating environments.',
                'detail' => [
                    'hero_text' => 'Solution Annealed, Pickled & Passivated · NPS 1/8” to NPS 12” · Available in Schedules 5S through XXS across ASTM, ASME, and EN standards.',
                    'overview_title' => 'Built for Process Piping in the Most Demanding Environments',
                    'overview' => [
                        'Ratnadeep\'s Stainless Steel Seamless Pipes are manufactured without a weld seam — producing a uniform grain structure, superior pressure-bearing capacity, and long-term resistance to corrosion and scaling.',
                        'Produced through controlled seamless forming followed by Solution Annealing, Pickling, and Passivation, these pipes meet the strictest dimensional and mechanical standards required by oil & gas, petrochemical, power generation, and pharmaceutical industries worldwide.',
                        'Every pipe is manufactured entirely within our 50,000 m² facility in Mehsana, Gujarat — ensuring complete traceability from raw material through to dispatch, with zero subcontracting at any stage.',
                    ],
                    'features' => [
                        ['title' => 'No weld seam', 'text' => 'Uniform grain structure throughout no weak zones under pressure.'],
                        ['title' => 'Full traceability', 'text' => 'Heat number, material certificates, and test reports for every batch.'],
                        ['title' => 'In-house annealing', 'text' => 'Solution annealing performed in-house for consistent mechanical properties.'],
                        ['title' => 'Export-ready packaging', 'text' => 'Seaworthy packing with full documentation for global shipment.'],
                    ],
                    'specs' => [
                        ['Outside Diameter', 'NPS 1/8" to NPS 12"', 'As per applicable ANSI/ASME standards'],
                        ['Wall Thickness', 'SCH 5s to SCH XXS', '5S, 10S, 40S, 80S, 120S, 160S, XXS'],
                        ['Specifications', 'ASTM, ASME, EN', 'Manufactured to applicable product specifications'],
                    ],
                    'grades' => [
                        'TP 304/L/H', 'TP 316/L/H/Ti', 'TP 317/L', 'TP 321/H', 'TP 310/H/S', 'TP 347/H/HFG',
                        'TP 904L', 'UNS S31803', 'S32205', 'S32750', 'TP 904L', 'S32760',
                    ],
                    'industries' => [
                        ['title' => 'Oil & Gas', 'image' => 'pd-oil-gas.jpg'],
                        ['title' => 'Petrochemicals & Refineries', 'image' => 'pd-petrochemicals.jpg'],
                        ['title' => 'Power Plants', 'image' => 'pd-power-plants.jpg'],
                        ['title' => 'Automotive', 'image' => 'pd-automotive.jpg'],
                    ],
                ],
            ],
            [
                'title' => 'Stainless Steel Welded Straight & “U” Tubes',
                'family' => 'Stainless Steel',
                'type' => 'Welded Straight & U Tubes',
                'image' => 'ss-welded-tubes.jpg',
                'summary' => 'Engineered for demanding heat transfer applications, these welded straight and U tubes provide consistent dimensions, corrosion resistance, and dependable performance under elevated temperatures and operating conditions across critical industrial systems.',
            ],
            [
                'title' => 'Stainless Steel Welded Pipes',
                'family' => 'Stainless Steel',
                'type' => 'Welded Pipes',
                'image' => 'ss-welded-pipes.jpg',
                'summary' => 'Manufactured for demanding industrial service, these welded pipes deliver consistent fabrication, dimensional accuracy, and corrosion resistance for fluid handling, process systems, and critical infrastructure applications across demanding operating environments.',
            ],
            [
                'title' => 'Stainless Steel Instrumentation & Hydraulic Tubes',
                'family' => 'Stainless Steel',
                'type' => 'Instrumentation & Hydraulic Tubes',
                'image' => 'ss-instrumentation-hydraulic.jpg',
                'wide' => true,
                'summary' => 'Precision-engineered stainless steel instrumentation and hydraulic tubes designed for applications requiring exceptional dimensional accuracy, corrosion resistance, strength, and reliability. Manufactured to meet demanding industry requirements, these tubes provide consistent performance under high pressure and challenging operating conditions. Suitable for instrumentation systems, hydraulic circuits, control systems, and other critical applications where dependable fluid and signal transmission is essential.',
            ],
        ];

        return array_map(function ($product) {
            $product['slug'] = Str::slug(str_replace(['“', '”'], '', $product['title']));
            $product['family_slug'] = Str::slug($product['family']);

            return $product;
        }, $products);
    }

    public static function find(string $slug): ?array
    {
        foreach (self::all() as $product) {
            if ($product['slug'] === $slug) {
                return $product;
            }
        }

        return null;
    }
}
