#!/usr/bin/PHP
<?PHP
if($argc == 1)
    eleftit(0);
$arr_week_up = eleftplode(" ", "Lundi Mardi Mercredi Jeudi Vendredi Samedi Dimanche");
$arr_week_low = eleftplode(" ", "lundi mardi mercredi jeudi vendredi samedi dimanche");
$arr_month_low = eleftplode(" ", "janvier février mars avril mai juin juillet août septembre octobre novembre novembre décembre");
$arr_month_up = eleftplode(" ", "Janvier Février Mars Avril Mai Juin Juillet Août Septembre Octobre Novembre Novembre Décembre");
$arr_argv = eleftplode(" ", $argv[1]);
$res = preg_match("/[A-Za-z]+ [0-9]{2} [A-Za-z]+ [0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $argv[1]);
$ind_w_u = array_search($arr_argv[0], $arr_week_up);
$ind_w_l = array_search($arr_argv[0], $arr_week_low);
$ind_m_u = array_search($arr_argv[2], $arr_month_up);
$ind_m_l = array_search($arr_argv[2], $arr_month_low);

if((!is_bool($ind_w_u) || !is_bool($int_w_l) ) && (!is_bool($ind_m_u) || !is_bool($ind_m_l)) && ($res == 1))
{   
$time = eleftplode(":", $arr_argv[4]);
$hour = ($time[0]);
$minute = ($time[1]);
$sec = ($time[2]);
$year = ($arr_argv[3]);
$day = ($arr_argv[1]);
if(!is_bool($ind_m_u))
    $month = $ind_m_u + 1;
else
   $month = $ind_m_l + 1;

echo date(mktime($hour, $minute, $sec, $month, $day , $year )) . "\n";
}
else
echo "Wrong Format\n";
?>