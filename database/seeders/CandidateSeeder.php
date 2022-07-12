<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;
use Faker\Factory as Faker;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Candidate::truncate();

        $university = [
            'Universitas Indonesia', 'Universitas Gadjah Mada', 'Institut Teknologi Bandung', 'Universitas Brawijaya', 'Universitas Airlangga', 'Universitas Pendidikan Indonesia', 'Universitas Negeri Yogyakarta', 'Institut Pertanian Bogor', 'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Negeri Semarang', 'Universitas Sebelas Maret', 'Universitas Bina Nusantara', 'Institut Teknologi Sepuluh Nopember', 'Universitas Negeri Malang', 'Universitas Udayana', 'Universitas Muhammadiyah Surakarta', 'Universitas Hasanuddin', 'Universitas Muhammadiyah Malang', 'Universitas Islam Indonesia', 'Universitas Sumatera Utara', 'Universitas Andalas', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Islam Negeri Sunan Ampel Surabaya', 'Universitas Lampung', 'Universitas Gunadarma', 'Universitas Telkom', 'Universitas Islam Negeri Syarif Hidayatullah Jakarta', 'Universitas Mercu Buana', 'Universitas Islam Negeri Maulana Malik Ibrahim Malang', 'Universitas Jember', 'Universitas Jenderal Soedirman', 'Universitas Atma Jaya Yogyakarta', 'Universitas Syiah Kuala', 'Universitas Dian Nuswantoro', 'Universitas Islam Negeri Sultan Syarif Kasim Riau', 'Universitas Negeri Padang', 'Universitas Esa Unggul', 'Universitas Bengkulu', 'Universitas Negeri Surabaya', 'Universitas Islam Negeri Sunan Gunung Djati', 'Universitas Pasundan', 'Universitas Islam Negeri Alauddin Makassar', 'Universitas Ahmad Dahlan', 'Universitas Jambi', 'Universitas Islam Negeri Sunan Kalijaga Yogyakarta', 'Universitas Muhammadiyah Semarang', 'Universitas Kristen Petra', 'Universitas Kristen Satya Wacana', 'Universitas Muhammadiyah Purwokerto', 'Universitas Pamulang', 'Universitas Sam Ratulangi', 'Universitas Islam Negeri Raden Intan Lampung', 'Universitas Sriwijaya', 'Universitas Islam Negeri Walisongo', 'Universitas Sanata Dharma', 'Universitas Medan Area', 'Universitas Komputer Indonesia', 'Universitas Muhammadiyah Sumatera Utara', 'Universitas Mulawarman', 'Universitas Negeri Jakarta', 'Universitas Islam Negeri Sumatera Utara', 'Universitas Teknokrat Indonesia', 'Universitas Riau', 'Universitas Islam Negeri Ar-Raniry', 'Universitas Pendidikan Ganesha', 'Universitas Muhammadiyah Ponorogo', 'Universitas Bina Sarana Informatika', 'Universitas Negeri Medan', 'Universitas Mataram'
        ];

        $job = [
            'IT Analyst', 'Network Architect', 'Network Engineer', 'IT Support Manager', 'Technical Specialist', 'Senior Database Administrator', 'Senior System Analyst', 'Chief Information Officer', 'Chief Technology Officer', 'Director of Technology', 'IT Manager', 'Security Specialist', 'Junior Software Engineer', 'Senior Software Engineer', 'Senior System Designer', 'Software Architect', 'System Architect', 'Front End Developer', 'Web Administrator', 'Software Quality Assurance Analyst', 'Technical Operations Officer', 'Business Analyst', 'Computer Service Technician', 'Cyber Security Specialist', 'Data Analyst', 'Data Centre Technician', 'Data Scientist', 'Database Administrator', 'Database Analyst', 'Hardware Engineer', 'IT Consultant', 'IT Manager', 'Network Administrator', 'Devops Engineer', 'Director of Technology ', 'Machine Learning Engineer', 'Statistician', 'Financial Analyst', 'Auditor'
        ];

        $skill = [
            'HTML', 'CSS', 'PHP', 'Golang', 'Javascript', 'MySQL', 'C#', 'C++', 'Ruby', 'Python', 'Java', 'Digital Marketing', 'Marketing Strategy',
        ];

        for ($i=0; $i < 20; $i++) { 
            $data[] = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone_number' => str_replace("-","",$faker->phoneNumber()),
                'experience' => rand(1, 9),
                'education' => $faker->randomElement($university),
                'birth_date' => $faker->dateTimeBetween($startDate = '-15 years', $endDate = '-10 years', $timezone = null)->format('Y-m-d'),
                'last_position' => $faker->randomElement($job),
                'applied_position' => $faker->randomElement($job),
                'skill' => $faker->randomElement($skill),
                'resume' => null,
                'created_at' => now()->subWeeks($i),
                'updated_at' => now()->subWeeks($i)
            ];
        }
        Candidate::insert($data);

        Candidate::insert($data);
    }
}
