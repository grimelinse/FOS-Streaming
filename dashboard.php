<?php
include('config.php');
logincheck();
/**
 * Created by Tyfix 2015
 */

$all = Stream::all()->count();
$online = Stream::where('status', '=', 1)->count();
$offline = Stream::where('status', '=', 0)->count();


//space
$space_pr = 0;
$space_free = round((disk_free_space('/'))/1048576, 1);
$space_total = round((disk_total_space('/'))/1048576, 1);
$space_pr = (int)(100 * ($space_free / $space_total));

if (stristr(PHP_OS, 'win')) {
    //cpu
    $cpu_usage = 2;
    $cpu_total = 10;
    $cpu_pr = $cpu_usage / $cpu_total * 100;

    //memory
    $mem_usage = 20;
    $mem_total = 120;
    $mem_pr = (int)(100 * ($mem_usage / $mem_total));

} else {

    //cpu
    $loads = sys_getloadavg();
    $core_nums = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
    $cpu_pr = round($loads[0]/($core_nums + 1)*100, 2);

    //memory
    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);

    $mem_usage = $mem[2];
    $mem_total = $mem[1];
    $mem_pr = $mem[2] / $mem[1] * 100;
}

$space = [];
$space['pr'] = $space_pr;
$space['count'] = $space_free;
$space['total'] = $space_total;

$cpu = [];
$cpu['pr'] = $cpu_pr;
$cpu['count'] = $cpu_usage;
$cpu['total'] = $cpu_total;

$mem = [];
$mem['pr'] = $mem_pr;
$mem['count'] = $mem_usage;
$mem['total'] = $mem_total;


echo $template->view()
    ->make('dashboard')
        ->with('all', $all)
        ->with('online',  $online)
        ->with('offline', $offline)
        ->with('space', $space)
        ->with('cpu', $cpu)
        ->with('mem', $mem)
    ->render();

?>
