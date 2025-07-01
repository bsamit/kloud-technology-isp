<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneralSettings\FrontSettings\Service;
use Illuminate\Support\Carbon;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                "id" => "1",
                "title" => "Internet Peering",
                "description" => "Internet Peering at KloudNIX enables ISPs, CDNs, and enterprises to exchange internet traffic directly, bypassing the need for intermediate networks. This direct exchange reduces latency, enhances network performance, and allows for better control over traffic flow.\r\n\r\nKloudNIX offers multiple peering options, including public peering through a shared infrastructure and private peering for more secure and dedicated connections.",
                "image" => "images/uploads/services/1738230884_d9ae70T1Kd.png",
                "status" => "1",
                "uuid" => "8ac7e181-208f-4005-b956-fa8b0acbb83c",
                "created_at" => "2025-01-28 19:04:45",
                "updated_at" => "2025-01-30 09:54:44"
            ],
            [
                "id" => "2",
                "title" => "Mobile Peering",
                "description" => "Mobile Peering at KloudNIX is designed to optimize the performance of mobile networks by facilitating direct interconnection between mobile operators. This service is crucial for reducing latency and improving the quality of mobile services, particularly in areas with high data demand.",
                "image" => null,
                "status" => "1",
                "uuid" => "e1980857-c8f4-48e7-9bcf-6dc8ba84de4c",
                "created_at" => "2025-01-28 19:10:02",
                "updated_at" => "2025-01-30 06:24:48"
            ],
            [
                "id" => "3",
                "title" => "Private Interconnect",
                "description" => "Our Private Interconnect service provides a dedicated, high-performance connection between your network and your partners, ensuring that sensitive data is exchanged securely.\r\n\r\nThis service is ideal for organizations that require guaranteed bandwidth and privacy for critical operations.",
                "image" => null,
                "status" => "1",
                "uuid" => "84c6f5b7-3c45-47ee-83d2-6292593d23a1",
                "created_at" => "2025-01-28 19:12:36",
                "updated_at" => "2025-01-30 06:25:02"
            ],
            [
                "id" => "4",
                "title" => "Closed User Group",
                "description" => "The Closed User Group (CUG) service at KloudNIX is designed for organizations or groups of organizations that need exclusive, high-performance interconnectivity.\r\n\r\nThis service creates a private network environment where members can exchange data securely and efficiently, with controlled access",
                "image" => null,
                "status" => "1",
                "uuid" => "7357dd16-bbf3-4f96-bd3a-da9c36343cc8",
                "created_at" => "2025-01-28 19:30:48",
                "updated_at" => "2025-01-30 06:20:29"
            ],
            [
                "id" => "5",
                "title" => "Remote Peering",
                "description" => "Remote Peering allows your network to connect to KloudNIX without needing a physical presence at the exchange. This service extends the reach of your network, allowing you to participate in the BanglaIX ecosystem from any location globally.",
                "image" => null,
                "status" => "1",
                "uuid" => "d3dd42e1-f5fc-464b-879f-431384241e9a",
                "created_at" => "2025-01-29 09:46:05",
                "updated_at" => "2025-01-30 06:25:21"
            ],
            [
                "id" => "6",
                "title" => "Easy Access",
                "description" => "KloudNIX's Easy Access service provides multiple points of entry to our Internet Exchange, making it simple for networks of all sizes to connect and benefit from our services.\r\n\r\nThis service is designed to reduce the complexity of connecting to an IX, allowing for quick and hassle-free setup.",
                "image" => null,
                "status" => "1",
                "uuid" => "f6daa6a4-4bd4-4b7f-8fe0-a03a68dc629d",
                "created_at" => "2025-01-29 09:47:45",
                "updated_at" => "2025-01-30 06:22:46"
            ],
            [
                "id" => "7",
                "title" => "Data Centre Interconnect",
                "description" => "Data Centre Interconnect (DCI) services at KloudNIX provide high-speed, reliable connections between data centers within our exchange ecosystem.\r\n\r\nThis service is crucial for businesses that rely on multiple data centers to deliver services, ensuring that data can be transferred quickly and securely between locations.",
                "image" => null,
                "status" => "1",
                "uuid" => "0d45294e-2cc1-42fd-83ae-49db11749880",
                "created_at" => "2025-01-29 09:49:29",
                "updated_at" => "2025-01-30 06:22:32"
            ],
            [
                "id" => "8",
                "title" => "Anti-DDoS",
                "description" => "Our Anti-DDoS service is designed to protect your network from Distributed Denial of Service (DDoS) attacks. These attacks can overwhelm your network with traffic, causing disruptions or complete outages.\r\n\r\nKloudNIX offers advanced DDoS protection, ensuring your services remain available even during an attack.",
                "image" => null,
                "status" => "1",
                "uuid" => "43e26d1b-9237-4819-8f7e-93017b444e8b",
                "created_at" => "2025-01-29 09:50:50",
                "updated_at" => "2025-01-30 06:20:08"
            ],
            [
                "id" => "9",
                "title" => "Cloud Access",
                "description" => "KloudNIX's Cloud Access service allows direct connections to major cloud providers, including Amazon Web Services (AWS), Microsoft Azure, and Google Cloud.\r\n\r\nThis service is designed to enhance the performance, security, and reliability of cloud-based applications by bypassing the public internet.",
                "image" => null,
                "status" => "1",
                "uuid" => "fd325b8b-c5e0-46a1-8c54-25760a589025",
                "created_at" => "2025-01-29 09:52:12",
                "updated_at" => "2025-01-30 06:21:15"
            ],
            [
                "id" => "10",
                "title" => "Microsoft Azure Peering Service",
                "description" => "Our Microsoft Azure Peering Service provides direct peering with Microsoft Azure, ensuring that your Azure-based applications run smoothly and securely.\r\n\r\nThis service is ideal for organizations that rely heavily on Azure for their cloud infrastructure and want to optimize their performance and reliability.",
                "image" => null,
                "status" => "1",
                "uuid" => "e1ec880b-7d06-42d3-bbb3-d1e10911a5f0",
                "created_at" => "2025-01-29 09:53:31",
                "updated_at" => "2025-01-30 06:24:29"
            ],
            [
                "id" => "11",
                "title" => "IX as a Service (IXaaS)",
                "description" => "IX as a Service (IXaaS) at KloudNIX provides businesses with the tools and expertise needed to establish and manage their own Internet Exchange.\r\n\r\nThis service is perfect for organizations that want to create a specialized IX to meet specific needs, whether for a private enterprise, a consortium, or a regional initiative.",
                "image" => null,
                "status" => "1",
                "uuid" => "c0612e4a-1890-496d-bbb1-37d5af5e5630",
                "created_at" => "2025-01-29 09:54:47",
                "updated_at" => "2025-01-30 06:24:06"
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
