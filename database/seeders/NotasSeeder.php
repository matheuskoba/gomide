<?php

namespace Database\Seeders;

use App\Models\Nota;
use Illuminate\Database\Seeder;

class NotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nota::create(
            [
                'emitente' => 'Imposto Adm',
                'serie' => '1',
                'uf' => 'DF',
                'n' => '1563',
                'valor' => '1266,30',
                'emissao' => '05/02/2022',
                'mes_ano' => '02/2022',
            ],
            [
                'emitente' => 'Empresa Emitente',
                'serie' => '1',
                'uf' => 'DF',
                'n' => '1013',
                'valor' => '952,30',
                'emissao' => '16/10/2022',
                'mes_ano' => '10/2022',
            ],
            [
                'emitente' => 'Primeira Linha',
                'serie' => '1',
                'uf' => 'AC',
                'n' => '5926',
                'valor' => '458,77',
                'emissao' => '11/08/2022',
                'mes_ano' => '08/2022',
            ],
            [
                'emitente' => 'Segundo Emitente',
                'serie' => '1',
                'uf' => 'AC',
                'n' => '623596',
                'valor' => '52,41',
                'emissao' => '16/10/2022',
                'mes_ano' => '10/2022',
            ],
            [
                'emitente' => 'Outra Enpresa',
                'serie' => '1',
                'uf' => 'GO',
                'n' => '2445',
                'valor' => '1124,30',
                'emissao' => '02/11/2022',
                'mes_ano' => '11/2022',
            ],
            [
                'emitente' => 'Outra Empresa',
                'serie' => '1',
                'uf' => 'SP',
                'n' => '33261',
                'valor' => '9758,20',
                'emissao' => '13/01/2022',
                'mes_ano' => '01/2022',
            ],
            [
                'emitente' => 'Empresa',
                'serie' => '1',
                'uf' => 'DF',
                'n' => '6420',
                'valor' => '787,90',
                'emissao' => '23/08/2022',
                'mes_ano' => '08/2022',
            ],
            [
                'emitente' => 'Empresa Emitente',
                'serie' => '1',
                'uf' => 'DF',
                'n' => '1013',
                'valor' => '952,30',
                'emissao' => '16/10/2022',
                'mes_ano' => '10/2022',
            ],
            
        );  
    }
}
