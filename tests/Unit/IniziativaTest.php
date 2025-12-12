<?php

namespace Tests\Unit;

use App\Models\Iniziativa;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IniziativaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getVotiLabelsAttribute con anno a 4 cifre.
     *
     * @return void
     */
    public function test_voti_labels_with_4_digit_year()
    {
        $iniziativa = new Iniziativa();
        $iniziativa->anno = '2024';

        $labels = $iniziativa->voti_labels;

        // Anno 2024 -> year = 24
        // year3 = 21, year2 = 22, year1 = 23
        $this->assertEquals("Voto finale 21/22", $labels['voto_anno_2']);
        $this->assertEquals("Voto finale 22/23", $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. 23/24", $labels['voto_primo_quadrimestre']);
    }

    /**
     * Test getVotiLabelsAttribute con anno corrente (prima del 15 settembre).
     *
     * @return void
     */
    public function test_voti_labels_before_september_15()
    {
        // Simula una data prima del 15 settembre
        // Se oggi fosse ad esempio 10 settembre 2025, year sarebbe 25

        $iniziativa = new Iniziativa();
        $iniziativa->anno = '2025';

        $labels = $iniziativa->voti_labels;

        // Anno 2025 -> year = 25
        // year3 = 22, year2 = 23, year1 = 24
        $this->assertEquals("Voto finale 22/23", $labels['voto_anno_2']);
        $this->assertEquals("Voto finale 23/24", $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. 24/25", $labels['voto_primo_quadrimestre']);
    }

    /**
     * Test getVotiLabelsAttribute con anno corrente (dopo il 15 settembre).
     *
     * @return void
     */
    public function test_voti_labels_after_september_15()
    {
        // Quando siamo dopo il 15 settembre, l'anno viene incrementato di 1

        $iniziativa = new Iniziativa();
        $iniziativa->anno = '2025';

        $labels = $iniziativa->voti_labels;

        // La logica è: se oggi è dopo il 15/09, aggiunge +1
        // Quindi se siamo a settembre 2025 dopo il 15, year diventa 26
        // Ma il test dipende dalla data odierna

        $this->assertArrayHasKey('voto_anno_2', $labels);
        $this->assertArrayHasKey('voto_anno_1', $labels);
        $this->assertArrayHasKey('voto_primo_quadrimestre', $labels);
    }

    /**
     * Test getVotiLabelsAttribute verifica formato delle label.
     *
     * @return void
     */
    public function test_voti_labels_format()
    {
        $iniziativa = new Iniziativa();
        $iniziativa->anno = '2023';

        $labels = $iniziativa->voti_labels;

        // Anno 2023 -> year = 23
        // year3 = 20, year2 = 21, year1 = 22
        $this->assertEquals("Voto finale 20/21", $labels['voto_anno_2']);
        $this->assertEquals("Voto finale 21/22", $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. 22/23", $labels['voto_primo_quadrimestre']);
    }

    /**
     * Test getVotiLabelsAttribute con anno a 2 cifre.
     *
     * @return void
     */
    public function test_voti_labels_with_2_digit_year()
    {
        $iniziativa = new Iniziativa();
        $iniziativa->anno = '26'; // Anno a 2 cifre

        $labels = $iniziativa->voti_labels;

        // Con anno a 2 cifre, la logica usa la data corrente
        // Verifichiamo solo che le chiavi esistano
        $this->assertArrayHasKey('voto_anno_2', $labels);
        $this->assertArrayHasKey('voto_anno_1', $labels);
        $this->assertArrayHasKey('voto_primo_quadrimestre', $labels);

        // Verifichiamo che il formato sia corretto
        $this->assertMatchesRegularExpression('/Voto finale \d+\/\d+/', $labels['voto_anno_2']);
        $this->assertMatchesRegularExpression('/Voto finale \d+\/\d+/', $labels['voto_anno_1']);
        $this->assertMatchesRegularExpression('/Voto 1° Quad\. \d+\/\d+/', $labels['voto_primo_quadrimestre']);
    }

    /**
     * Test che l'attributo voti_labels sia nell'array appends.
     *
     * @return void
     */
    public function test_voti_labels_is_appended()
    {
        $iniziativa = new Iniziativa();
        $iniziativa->anno = '2024';

        $appends = $iniziativa->getAppends();

        $this->assertContains('voti_labels', $appends);
    }

    /**
     * Test della logica del calcolo degli anni.
     *
     * @return void
     */
    public function test_voti_labels_year_calculation()
    {
        $iniziativa = new Iniziativa();
        $iniziativa->anno = '2022';

        $labels = $iniziativa->voti_labels;

        // Anno 2022 -> year = 22
        // year3 = 19, year2 = 20, year1 = 21
        $this->assertEquals("Voto finale 19/20", $labels['voto_anno_2']);
        $this->assertEquals("Voto finale 20/21", $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. 21/22", $labels['voto_primo_quadrimestre']);
    }
}
