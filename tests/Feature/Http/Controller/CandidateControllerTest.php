<?php

namespace Tests\Feature\Http\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Candidate;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;

class CandidateControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /** @test */
    public function user_can_create_a_candidate()
    {
        $faker = Faker::create();

        $first = $faker->firstName();
        $last = $faker->lastName();
        $university = [
            'Universitas Indonesia', 'Universitas Gadjah Mada', 'Institut Teknologi Bandung', 'Universitas Brawijaya', 'Universitas Airlangga', 'Universitas Pendidikan Indonesia', 'Universitas Negeri Yogyakarta', 'Institut Pertanian Bogor', 'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Negeri Semarang', 'Universitas Sebelas Maret', 'Universitas Bina Nusantara', 'Institut Teknologi Sepuluh Nopember', 'Universitas Negeri Malang', 'Universitas Udayana', 'Universitas Muhammadiyah Surakarta', 'Universitas Hasanuddin', 'Universitas Muhammadiyah Malang', 'Universitas Islam Indonesia', 'Universitas Sumatera Utara', 'Universitas Andalas', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Islam Negeri Sunan Ampel Surabaya', 'Universitas Lampung', 'Universitas Gunadarma', 'Universitas Telkom', 'Universitas Islam Negeri Syarif Hidayatullah Jakarta', 'Universitas Mercu Buana', 'Universitas Islam Negeri Maulana Malik Ibrahim Malang', 'Universitas Jember', 'Universitas Jenderal Soedirman', 'Universitas Atma Jaya Yogyakarta', 'Universitas Syiah Kuala', 'Universitas Dian Nuswantoro', 'Universitas Islam Negeri Sultan Syarif Kasim Riau', 'Universitas Negeri Padang', 'Universitas Esa Unggul', 'Universitas Bengkulu', 'Universitas Negeri Surabaya', 'Universitas Islam Negeri Sunan Gunung Djati', 'Universitas Pasundan', 'Universitas Islam Negeri Alauddin Makassar', 'Universitas Ahmad Dahlan', 'Universitas Jambi', 'Universitas Islam Negeri Sunan Kalijaga Yogyakarta', 'Universitas Muhammadiyah Semarang', 'Universitas Kristen Petra', 'Universitas Kristen Satya Wacana', 'Universitas Muhammadiyah Purwokerto', 'Universitas Pamulang', 'Universitas Sam Ratulangi', 'Universitas Islam Negeri Raden Intan Lampung', 'Universitas Sriwijaya', 'Universitas Islam Negeri Walisongo', 'Universitas Sanata Dharma', 'Universitas Medan Area', 'Universitas Komputer Indonesia', 'Universitas Muhammadiyah Sumatera Utara', 'Universitas Mulawarman', 'Universitas Negeri Jakarta', 'Universitas Islam Negeri Sumatera Utara', 'Universitas Teknokrat Indonesia', 'Universitas Riau', 'Universitas Islam Negeri Ar-Raniry', 'Universitas Pendidikan Ganesha', 'Universitas Muhammadiyah Ponorogo', 'Universitas Bina Sarana Informatika', 'Universitas Negeri Medan', 'Universitas Mataram'
        ];

        $job = [
            'IT Analyst', 'Network Architect', 'Network Engineer', 'IT Support Manager', 'Technical Specialist', 'Senior Database Administrator', 'Senior System Analyst', 'Chief Information Officer', 'Chief Technology Officer', 'Director of Technology', 'IT Manager', 'Security Specialist', 'Junior Software Engineer', 'Senior Software Engineer', 'Senior System Designer', 'Software Architect', 'System Architect', 'Front End Developer', 'Web Administrator', 'Software Quality Assurance Analyst', 'Technical Operations Officer', 'Business Analyst', 'Computer Service Technician', 'Cyber Security Specialist', 'Data Analyst', 'Data Centre Technician', 'Data Scientist', 'Database Administrator', 'Database Analyst', 'Hardware Engineer', 'IT Consultant', 'IT Manager', 'Network Administrator', 'Devops Engineer', 'Director of Technology ', 'Machine Learning Engineer', 'Statistician', 'Financial Analyst', 'Auditor'
        ];

        $skill = [
            'HTML', 'CSS', 'PHP', 'Golang', 'Javascript', 'MySQL', 'C#', 'C++', 'Ruby', 'Python', 'Java', 'Digital Marketing', 'Marketing Strategy',
        ];

        $response = $this->actingAs(User::find(1))
            ->from(route('candidates.create'))
            ->post(route('candidates.store'), [
            'name' => $first. ' '.$last,
            'email' => strtolower($first.'.'.$last).'@'.$faker->freeEmailDomain(),
            'phone_number' => str_replace("+","",$faker->e164PhoneNumber()),
            'experience' => rand(1, 9),
            'education' => $faker->randomElement($university),
            'birth_date' => $faker->dateTimeBetween($startDate = '-35 years', $endDate = '-20 years', $timezone = null)->format('Y-m-d'),
            'last_position' => $faker->randomElement($job),
            'applied_position' => $faker->randomElement($job),
            'skill' => $faker->randomElement($skill),
            'resume_file' => UploadedFile::fake()->create('test.pdf')
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('candidates.index'));
    }
    
    /** @test */
    public function user_can_update_a_candidate()
    {
        $faker = Faker::create();

        $first = $faker->firstName();
        $last = $faker->lastName();
        $candidate = Candidate::latest()->first();
        $response = $this->actingAs(User::find(1))
            ->from(route('candidates.edit', $candidate->id))
            ->put(route('candidates.update', $candidate->id), [
            'name' => $first. ' '.$last,
            'email' => strtolower($first.'.'.$last).'@'.$faker->freeEmailDomain(),
            'phone_number' => str_replace("+","",$faker->e164PhoneNumber()),
            'experience' => rand(1, 9),
            'education' => 'UII',
            'birth_date' => '1998-07-11',
            'last_position' => 'Junior Programmer',
            'applied_position' => 'Senior Programmer',
            'skill' => 'Laravel, MySQL'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('candidates.edit', $candidate->id));

    }
    
    /** @test */
    public function user_can_delete_a_candidate()
    {
        $candidate = Candidate::latest()->first();
        $response = $this->actingAs(User::find(1))
            ->delete(route('candidates.destroy', $candidate->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('candidates.index'));
    }
}
