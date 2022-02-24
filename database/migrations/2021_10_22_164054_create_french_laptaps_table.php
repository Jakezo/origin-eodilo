<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Models\Partner;

use Illuminate\Support\Facades\DB;
class CreateFrenchLaptapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $fnBlueprint = function (Blueprint $table) {
            $table->id('lt_no');
            $table->string('lt_name', 20)->default('');
            $table->string('lt_spec', 255)->default('');
            $table->char('lt_state',1)->default('Y');
            $table->SoftDeletes();
            $table->timestamps();
        };

        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->create('french_laptaps', $fnBlueprint);

        /*
        $ex_partners = DB::table('partners')->select('p_no','p_id')->orderBy("p_no","desc")->get();
        foreach(  $ex_partners as $p ) {
            echo "boss_".$p->p_id."\n";
            config(["database.connections.partner.database" => "boss_".$p->p_id]);

            try {
                Schema::connection('partner')->create('french_laptaps', $fnBlueprint);
            } catch(Exception $e) {
                echo $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
            }

        }
        */

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config(["database.connections.partner.database" => "boss_enha"]);
        Schema::connection('partner')->dropIfExists('french_laptaps');
    }
}
