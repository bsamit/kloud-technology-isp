<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FrontSettings\ServiceDetails;
use Illuminate\Support\Carbon;

class ServiceDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceDetails = [
            [
                "id" => "70",
                "service_id" => "8",
                "title" => "Proactive Protection",
                "description" => "Our DDoS mitigation tools detect and respond to threats before they can impact your network.",
                "uuid" => "cc34f4f0-ae9b-415a-af73-2f67a6d8e2cf",
                "deleted_at" => null,
                "created_at" => "2025-01-30 06:20:08",
                "updated_at" => "2025-01-30 06:20:08"
            ],
            [
                "id" => "71",
                "service_id" => "8",
                "title" => "Continuous Availability",
                "description" => "Maintain uninterrupted service, even during an attack, ensuring that your customers and users experience no downtime.",
                "uuid" => "f3a831bc-a47b-4a83-9dd0-2d8db818e996",
                "deleted_at" => null,
                "created_at" => "2025-01-30 06:20:08",
                "updated_at" => "2025-01-30 06:20:08"
            ],
            // ... more entries for service_id 8
            [
                "id" => "74",
                "service_id" => "4",
                "title" => "Exclusive Access",
                "description" => "Limit network access to authorized members only, enhancing security and reducing the risk of external threats.",
                "uuid" => "7e9db3e4-f1b9-4eee-9d8c-8037302d217d",
                "deleted_at" => null,
                "created_at" => "2025-01-30 06:20:29",
                "updated_at" => "2025-01-30 06:20:29"
            ],
            // ... continuing with all entries
            [
                "id" => "124",
                "service_id" => "1",
                "title" => "Reduced Latency",
                "description" => "Direct data paths between networks mean faster delivery of content, improving the end-user experience, particularly for latency-sensitive applications like gaming and video streaming.",
                "uuid" => "76764435-c1be-4aa1-959d-71ef2fd22e81",
                "deleted_at" => null,
                "created_at" => "2025-01-30 09:54:44",
                "updated_at" => "2025-01-30 09:54:44"
            ],
            [
                "id" => "125",
                "service_id" => "1",
                "title" => "Cost Efficiency",
                "description" => "By reducing dependency on third-party transit providers, your organization can significantly lower operational expenses",
                "uuid" => "17fb97ab-f9e0-4035-8f1e-e516166614a7",
                "deleted_at" => null,
                "created_at" => "2025-01-30 09:54:44",
                "updated_at" => "2025-01-30 09:54:44"
            ],
            [
                "id" => "126",
                "service_id" => "1",
                "title" => "Enhanced Traffic Management",
                "description" => "Gain more control over your traffic routes, optimizing the performance of your network.",
                "uuid" => "62045e2c-d1a8-47ed-97f0-33ef44f5ca47",
                "deleted_at" => null,
                "created_at" => "2025-01-30 09:54:44",
                "updated_at" => "2025-01-30 09:54:44"
            ],
            [
                "id" => "127",
                "service_id" => "1",
                "title" => "Scalability",
                "description" => "Easily scale your peering connections as your business grows, ensuring that your network can handle increased traffic volumes.",
                "uuid" => "6ccc3b0d-3b49-4ccb-af61-ffac54613409",
                "deleted_at" => null,
                "created_at" => "2025-01-30 09:54:44",
                "updated_at" => "2025-01-30 09:54:44"
            ]
        ];

        foreach ($serviceDetails as $detail) {
            ServiceDetails::create($detail);
        }
    }
}
