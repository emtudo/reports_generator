<?php
// echo "\n\n\n";
// echo "\n\n\n";
function read($file)
{
    $fp = fopen($file, 'rb');

    while (($line = fgets($fp)) !== false) {
        yield parse_line($line);
    }

    fclose($fp);
}

function parse_file($filename)
{
    // echo "\n\n\n";
    // echo "{$filename}\n";

    $data = [];
    
    foreach (read($filename) as $value) {
        $data = sum_values($data, $value);
    }

    return $data;
}

function sum_values($report, $line)
{
    // print_r($report);
    // print_r($line);
    // die();


    if (!$report) {
        $data = [
            'foods' => [
                $line[1] => 1
            ],
            'users' => [
                $line[0] => $line[2]
            ],
        ];

        // print_r($data);

        // echo "\n\n\n";
        
        return $data;
    }
    // print_r($report);
    // die();

    $users = $report['users'];
    $foods = $report['foods'];

    $id = $line[0];
    // echo "id: $id\n";
    $value = $users[$id] ?? $line[2];
    // echo "value: $value\n";
    // print_r($users);
    
    // echo "\n\n\nxxxx";

    $users[$id] = isset($users[$id]) ? $users[$id] + $line[2] :  $line[2];

    $foods = array_merge($foods, [
        $line[1] => isset($foods[$line[1]]) ? $foods[$line[1]] + 1: 1,
    ]);

    $data =[
        'users' => $users,
        'foods' => $foods
    ];

    // print_r($data);

    return $data;

    // [id, food_name, price], %{"foods" => foods, "users" => users}
//    $users = $
// $users = Map.put($users, id, $users[id] + price)
// $foods = Map.put($foods, food_name, $foods[food_name] + 1)
//
//return build_reports($foods, $users);
}


function build_reports($foods, $users)
{
    return [
        'foods' => $foods,
        'users' => $users,
    ];
}

function merge_maps($map1, $map2)
{
    // Map.merge(map1, map2, fn _key, value1, value2 -> value1 + value2 end)
}

# function merge_maps($map1, $map2) do
#     Map.merge(map1, map2, fn _key, value1, value2 -> value1 + value2 end)
# }

function parse_line($line)
{
    $line = trim($line);
    $data = explode(",", $line);
    $data[2] = (int) $data[2];

    return $data;
}

$filename = __DIR__."/a.csv";

$timeStart = microtime(true);
$data = parse_file($filename);
print_r($data);

$time = microtime(true) - $timeStart;
echo $time;
echo "\n";
echo "Memoria utilizada:" . memory_get_usage(true);

// printf("Processado em: %0.16f segundos", $time/1000000);
