<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatSpecificKnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'name' =>'C#',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'C++',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'DART',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'GENERO',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'GROOVY',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'JAVA',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'JAVASCRIPT',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'KOTLIN',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'PERL',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'PHP',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'PYTHON',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'RUBY',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'SWIFT',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'TYPESCRIPT',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'VISUAL BASIC .NET',
                'cat_knowledge_area_types_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'ORACLE',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'SQL SERVER',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'MYSQL',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'MARIADB',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'SQLITE',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'POSTGRESQL',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'REDIS',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'FIREBASE',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'MONGODB',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'CASSANDRA',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'ELASTICSEARCH',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'APACHE SOLR',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'GOOGLE CLOUD SEARCH',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'MARKLOGIC',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'APACHE LUCENE',
                'cat_knowledge_area_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'ANGULAR JS',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'ANGULAR 2++',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'CAKEPHP',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'GRAILS',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'HIBERNATE',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'IONIC',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'JAVASERVER FACES',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'LARAVEL',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'MYBATIS',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'REACT (WEB)',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'REACT NATIVE (MOVIL)',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'SIWFT',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'SPRING',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'STRUTS',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'SYMFONY',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'VUEJS',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'OTROS',
                'cat_knowledge_area_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
    DB::table('cat_specific_knowledge')->insert($values);
    }
}
