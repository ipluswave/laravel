<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;

class AddFakeTailor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for ($i = 0; $i < 10; $i++) {
            $tn = 'tailor00' . $i;
            $u = new User();
            $u->email = $tn . '@gmail.com';
            $u->password = 'qweasd';
            $u->real_name = $tn;
            $u->gender = 1;
            $u->date_of_birth = '1980-01-01';
            $u->address = 'Fake address ' . $i;
            $u->handphone_no = '00012345679' . $i;
            $u->is_validated = 1;
            $u->nick_name = $tn;
            $u->is_tailor = 1;
            $u->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        for ($i = 0; $i < 10; $i++) {
            $tn = 'tailor00' . $i;
            $u = User::where('email', '=', $tn . '@gmail.com')->first();
            $u->delete();
        }
    }
}
