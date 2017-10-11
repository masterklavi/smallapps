<?php

$ships = [
    // size => count
    4 => 1,
    3 => 2,
    2 => 3,
    1 => 4,
];

$map = []; // y => [x => 1]

foreach ($ships as $size => $count)
{
    $placed = 0;
    
    do
    {
        // в длину
        $a = rand(0, 10-$size);
        $b = $a + $size;
        
        $c = rand(0, 9);
        $d = null;
        
        if (rand(0, 1) === 0)
        {
            // ориентация по горизонтали
            $x = &$d;
            $y = &$c;
        }
        else
        {
            $x = &$c;
            $y = &$d;
        }
        
        // выстраиваем в длину
        for ($d = $a; $d < $b; $d++)
        {
            // проверка по окресностям
            foreach ([-1, 0, 1] as $dy)
            {
                foreach ([-1, 0, 1] as $dx)
                {
                    if (isset($map[$y + $dy][$x + $dx]))
                    {
                        continue 4;
                    }
                }
            }
        }
        
        for ($d = $a; $d < $b; $d++)
        {
            $map[$y][$x] = 1;
        }
        
        $placed++;
    }
    while ($placed < $count);
}

// строим в консоли

print '  ';
for ($x = 0; $x < 10; $x++)
{
    print chr(97+$x);
}
print "\n";

print '  '.str_repeat('-', 10)."\n";

for ($y = 0; $y < 10; $y++)
{
    print $y.'|';
    
    for ($x = 0; $x < 10; $x++)
    {
        print isset($map[$y][$x]) ? '#' : '.';
    }
    
    print "\n";
}
