

<?php
// Set timezone
date_default_timezone_set('America/Sao_Paulo');

#!/usr/bin/php
    // $eaq_measures = [
    //     ["date" => "07/08/2019 10:00","value" => "0"],
    //     ["date" => "07/08/2019 09:00","value" => "0"]
    // ];

$ftp_user = 'user';
$ftp_pass = 'pass';
$ftp_addr = '0.0.0.0';

include 'Net/SFTP.php';

$sftp = new Net_SFTP('0.0.0.0');
if (!$sftp->login('user', 'pass')) {
    exit('Login Failed');
}

$sftp->chdir('/'. date('Y') .'/'. date('m') .'/SCM/RAWDATA/IN/') . "\r\n";
$eaq_files = $sftp->nlist();

//setting all files, organized.
$org_files = ['size' => [], 'measures' => []];
$sizes = [];

foreach ($eaq_files as $key => $value) {
    if (strlen($value) > 50) {
        array_push($org_files['measures'], $value);
        array_push($org_files['size'], $sftp->size($value));
    }
}

$docs_splitted = [];
for ($i = 0; $i < sizeof($org_files['measures']); $i++) {
    $docs_splitted[$i] = explode('_', $org_files['measures'][$i]);
}

$hour = [];
$date = [];
for ($i = 0; $i < sizeof($org_files['measures']); $i++) {
    $hour[$i] = explode('.', $docs_splitted[$i][5]);

    //setting the date to correct format back
    $dateY[$i] = str_split($docs_splitted[$i][4], 4);
    $dateMD[$i] = str_split($dateY[$i][1], 2);
    $dateYMD[$i] = $dateMD[$i][1]."/".$dateMD[$i][0]."/".$dateY[$i][0];

    //setting the time to correct format back
    $dateHM[$i] = str_split($hour[$i][0], 2);
    $dateHour[$i] = $dateHM[$i][0].":00";

    $pre_YMD[$i] = $dateYMD[$i]." ".$dateHour[$i];
    array_push($date, $pre_YMD[$i]);
}

rsort($date);
for ($i = 0; $i < sizeof($date)-1; $i++) {
    $counting_equal[$i] = sizeof(array_keys($date, $date[$i], false));
    if ($counting_equal[$i] == 4) {
        $eaq_measures[$i]["date"] = $date[$i];
        $eaq_measures[$i]["value"] = 0;
    } else {
        $eaq_measures[$i]["date"] = $date[$i];
        $eaq_measures[$i]["value"] = 4 - $counting_equal[$i];
    }
    $i+=$counting_equal[$i]-1;
}

$lesser = 0;
foreach ($org_files['size'] as $key => $value) {
    if ($value < 1000000) {
        $lesser++;
    }
}



// for ($i = 0; $i < sizeof($date)-1; $i++) {
//     if (sizeof(array_keys($date, date('d/m/Y H').":00", false)) == 4) {
//         $pre_final_res[$i]["date"] = $date[$i];
//         $pre_final_res[$i]["value"] = 0;
//     } else {
//         $pre_final_res[$i]["date"] = $date[$i];
//         $pre_final_res[$i]["value"] = 4 - sizeof(array_keys($date, date('d/m/Y H').":00", false));
//     }
// }



    // if (date('d/m/Y H').":00" == $date[$i]) {
    //     $eaq_measures[$i][$i]["date"] = $date[$i];
    //     $eaq_measures[$i][$i]["value"] = 1;
    // }





















// for ($i = 0; $i < sizeof($date)-1; $i++) {
//     if ($date[$i] == date('d/m/Y H').":00") {
//         array_push($doc_count, "ok");
//     };
// }
// if (sizeof($doc_count) == 4) {
//     $eaq_measures[$i]["date"] = $date[$i];
//     $eaq_measures[$i]["value"] = 0;
// } else {
//     $eaq_measures[$i]["date"] = $date[$i];
//     $eaq_measures[$i]["value"] = sizeof($doc_count) - 4;
// }










    //WHAT FOLLOWS IS JUST DRAFT IN CASE FOR A FUTURE USE AND RECORD


    // array_push($eaq_measures[$i]['value'], );
    // array_push($eaq_measures[$i]['date'], $date[$i]);

    // // $pre_docs = [];
    // // $file_date = [];
    // // foreach ($org_files as $key => $value) {
    // //     global $pre_docs;
    // //     for ($i = 0; $i < sizeof($org_files); $i++) {
    // //         $pre_docs['size'.$i] = $sftp->size($value);
    // //     }

    // // }


    // // array_push($file_date, explode("_", $value));
    // // foreach ($file_date as $key => $value) {
    // //     var_dump($value);
    // //     // if (strlen($value) == 8) {
    // //     //     for ($i = 0; $i < sizeof($org_files); $i++) {
    // //     //         $pre_docs['date'. $i] = $value;
    // //     //     }
    // //     // } elseif (strlen($value) == 21) {
    // //     //     for ($i = 0; $i < sizeof($org_files); $i++) {
    // //     //         $pre_docs['time'. $i] = $value;
    // //     //     }
    // //     // }
    // // }
    // $dateYMD = [];
    // $yearMonthDay = [];
    // // for ($i = 0; $i < sizeof($org_files); $i++) {
    // //     array_push($dateYMD, $pre_docs['date' . $i]);
    // //     $dateY = str_split($dateYMD[$i], 4);
    // //     $dateMD = str_split($dateY[1], 2);
    // //     array_push($yearMonthDay, "$dateY[0]/$dateMD[0]/$dateMD[1]");
    // // }

    // $separating_time = [];
    // $time = [];


    // for ($i = 0; $i < sizeof($org_files); $i++) {
    //     // var_dump($pre_docs['time' . $i]);
    //     // array_push($separating_time, $pre_docs['time' . $i]);
    //     // $hour = str_split($separating_time[$i], 2);
    //     // array_push($time, "$hour[0]:00");
    // }

    // var_dump($separating_time);

    // files smaller than 1Mb
    // $lesser = 0;
    // foreach ($sizes as $key => $value) {
    //     if ($value < 1000000) {
    //         $lesser++;
    //     }
    // }
    

    // $sftp = ssh2_sftp($connection);

    // $stream = fopen('ssh2.sftp://' . intval($sftp) . '/2019/08/SCM/RAWDATA/IN/', 'r');

    // echo $sftp;
    // // chdir('/home/gabrieloliveira/development');
    // $eaq1 = shell_exec(sprintf('lftp'));
    // $eaq3 = shell_exec(sprintf('ls'));

    // $eaq = strval($eaq2);
    // $eaq_array = explode("\n", $eaq);

    // foreach ($eaq_array as $key => $value) {
    //     echo $value."\n";


?>
