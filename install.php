<?php
include('config.php');
// TODO: version control
// TODO: update tables

$db = $databasemanagar;
if( isset($_GET['install'])) {

    $arraynamesexist = [];
    $tables = $databasemanagar::select('SHOW TABLES');
    foreach ($tables as $key => $val) {

        $tableName = (array)$val;
        $tableName = array_shift($tableName);

        array_push($arraynamesexist, $tableName);
    }

    if ($_GET['install'] == 'fresh') {
        $db::schema()->dropIfExists('admins');
        $db::schema()->dropIfExists('categories');
        $db::schema()->dropIfExists('category_user');
        $db::schema()->dropIfExists('settings');
        $db::schema()->dropIfExists('streams') ;
        $db::schema()->dropIfExists('users');
        $arraynamesexist = [];
    }

    if (!in_array('admins', $arraynamesexist)) {

        $db->schema()->create('admins', function ($table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        $admin = new Admin;
        $admin->username = 'admin';
        $admin->password = md5('admin');
        $admin->save();

        echo "created admin table <br>" . PHP_EOL;
        echo "admin created: username: admin  and password: admin <br>" . PHP_EOL;
    }



    if (!in_array('categories', $arraynamesexist)) {

        $db->schema()->create('categories', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        echo "created categories table <br>" . PHP_EOL;
    }


    if (!in_array('category_user', $arraynamesexist)) {

        $db->schema()->create('category_user', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->timestamps();
        });

        echo "created category_user table <br>" . PHP_EOL;
    }



    if (!in_array('settings', $arraynamesexist)) {

        $db->schema()->create('settings', function ($table) {
            $table->increments('id');
            $table->string('ffmpeg_path')->default('/usr/local/bin/ffmpeg');
            $table->string('ffprobe_path')->default('/usr/local/bin/ffprobe');
            $table->string('webport')->default('8000');
            $table->string('webip');
            $table->string('hlsfolder')->default('hl');
            $table->timestamps();
        });

        echo "created settings table <br>" . PHP_EOL;
    }


    if (!in_array('streams', $arraynamesexist)) {

        $db->schema()->create('streams', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('streamurl');
            $table->tinyInteger('running');
            $table->tinyInteger('status');
            $table->integer('cat_id');
            $table->integer('trans_id');
            $table->integer('pid');
            $table->tinyInteger('restream');
            $table->string('video_codec_name');
            $table->string('audio_codec_name');
            $table->tinyInteger('bitstreamfilter');
            $table->timestamps();
        });
        echo "created streams table <br>" . PHP_EOL;
    }

    if (!in_array('users', $arraynamesexist)) {

        $db->schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->tinyInteger('active');
            $table->timestamps();
        });

        echo "created users table <br>" . PHP_EOL;

    }


    if (!in_array('transcodes', $arraynamesexist)) {

        $db->schema()->create('transcodes', function ($table) {
            $table->increments('id');
            $table->string('name')->unique();

            $table->BigInteger('probesize');
            $table->BigInteger('analyzeduration');
            $table->string('video_codec');
            $table->string('audio_codec');
            $table->string('profile');
            $table->string('preset_values');
            $table->string('scale');
            $table->string('aspect_ratio');
            $table->BigInteger('video_bitrate');
            $table->integer('audio_channel');
            $table->BigInteger('audio_bitrate');
            $table->integer('fps');
            $table->integer('minrate');
            $table->integer('maxrate');
            $table->integer('bufsize');
            $table->integer('audio_sampling_rate');
            $table->integer('crf');
            $table->integer('threads');
            $table->tinyInteger('deinterlance');
            $table->timestamps();
        });

        echo "created transcodes table <br>" . PHP_EOL;

    }
}

if( isset($_GET['update'])) {

    $db->schema()->table('streams', function ($table) use ($db) {
        $db->schema()->hasColumn('streams', 'bitstreamfilter') ? '' : $table->tinyInteger('bitstreamfilter');
        $db->schema()->hasColumn('streams', 'trans_id') ? '' : $table->Integer('trans_id');
    });

    $db->schema()->table('users', function ($table) use ($db) {
        $db->schema()->hasColumn('users', 'lastconnected_ip') ? '' : $table->string('lastconnected_ip');
        $db->schema()->hasColumn('users', 'exp_date') ? '' : $table->date('exp_date');
    });

    $db->schema()->table('settings', function ($table) use ($db) {
        $db->schema()->hasColumn('users', 'less_secure') ? '' : $table->tinyInteger('less_secure');
    });

    echo "update <br>" . PHP_EOL;
}
