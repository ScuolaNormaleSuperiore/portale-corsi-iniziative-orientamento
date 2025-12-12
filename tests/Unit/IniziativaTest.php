<?php

namespace Tests\Unit;

use App\Models\Iniziativa;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IniziativaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getVotiLabelsAttribute con anno diverso dall'anno corrente.
     *
     * @return void
     */
    public function test_voti_labels_with_different_year_from_current()
    {
        $iniziativa = new Iniziativa();
        $iniziativa->anno = '2024'; // Anno diverso dal 2025/2026

        $labels = $iniziativa->voti_labels;

        // Anno 2024 -> year = 24
        // year2 = 22, year1 = 23
        $this->assertEquals("Voto finale 22/23", $labels['voto_anno_2']);
        $this->assertEquals("Voto finale 23/24", $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. 24/25", $labels['voto_primo_quadrimestre']);
    }

    /**
     * Test getVotiLabelsAttribute con anno uguale all'anno corrente.
     * Se l'anno dell'iniziativa è uguale all'anno corrente, usa l'anno corrente.
     *
     * @return void
     */
    public function test_voti_labels_with_current_year()
    {
        $iniziativa = new Iniziativa();

        // Calcola l'anno corrente con la stessa logica del metodo
        $currentYear = date('Y');
        $month = intval(date('m'));
        $day = intval(date('d'));
        if ($month > 9 || ($month == 9 && $day >= 15)) {
            $currentYear = intval($currentYear) + 1;
        }

        // Imposta l'anno dell'iniziativa uguale all'anno corrente
        $iniziativa->anno = (string)$currentYear;

        $labels = $iniziativa->voti_labels;

        // Verifica che usi l'anno corrente
        $year = intval(substr((string)$currentYear, 2, 2));
        $this->assertEquals("Voto finale " . ($year - 2) . '/' . ($year - 1), $labels['voto_anno_2']);
        $this->assertEquals("Voto finale " . ($year - 1) . '/' . $year, $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. " . $year . '/' . ($year + 1), $labels['voto_primo_quadrimestre']);
    }

    /**
     * Test getVotiLabelsAttribute senza anno definito usa anno corrente.
     *
     * @return void
     */
    public function test_voti_labels_without_year_uses_current_year()
    {
        // Quando non c'è un anno definito, usa l'anno corrente

        $iniziativa = new Iniziativa();
        // Non impostiamo $iniziativa->anno

        $labels = $iniziativa->voti_labels;

        // Verifichiamo che le chiavi esistano
        $this->assertArrayHasKey('voto_anno_2', $labels);
        $this->assertArrayHasKey('voto_anno_1', $labels);
        $this->assertArrayHasKey('voto_primo_quadrimestre', $labels);

        // Verifichiamo che il formato sia corretto
        $this->assertMatchesRegularExpression('/Voto finale \d+\/\d+/', $labels['voto_anno_2']);
        $this->assertMatchesRegularExpression('/Voto finale \d+\/\d+/', $labels['voto_anno_1']);
        $this->assertMatchesRegularExpression('/Voto 1° Quad\. \d+\/\d+/', $labels['voto_primo_quadrimestre']);
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
        // year2 = 21, year1 = 22
        $this->assertEquals("Voto finale 21/22", $labels['voto_anno_2']);
        $this->assertEquals("Voto finale 22/23", $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. 23/24", $labels['voto_primo_quadrimestre']);
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
        // year2 = 20, year1 = 21
        $this->assertEquals("Voto finale 20/21", $labels['voto_anno_2']);
        $this->assertEquals("Voto finale 21/22", $labels['voto_anno_1']);
        $this->assertEquals("Voto 1° Quad. 22/23", $labels['voto_primo_quadrimestre']);
    }
}
